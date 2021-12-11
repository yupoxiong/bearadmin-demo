<?php
/**
 *
 * @author yupoxiong<i@yupoxiong.com>
 */

declare (strict_types=1);

namespace app\command\event;

use app\admin\data\RoomData;
use GatewayWorker\Lib\Gateway;
use JsonException;
use Redis;
use think\facade\Log;
use think\validate\ValidateRule;
use Workerman\Lib\Timer;

class ChatEvent
{

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        Log::write("客户端连接错误，错误信息： $code $msg\n");
    }


    /**
     * 当客户端连接时触发
     * @param $client_id
     * @param $data
     */
    public static function onWebSocketConnect($client_id, $data)
    {
        // 未传入房间ID/用户ID，直接断开
        if (!isset($data['get']['username'])) {
            Gateway::closeClient($client_id, '401');
        }

        // 连接到来后，定时10秒关闭这个链接，需要10秒内发认证并删除定时器阻止关闭连接的执行
        $auth_timer_id = Timer::add(10, function ($client_id) {
            Gateway::closeClient($client_id);
        }, array($client_id), false);
        Gateway::updateSession($client_id, array('auth_timer_id' => $auth_timer_id));

        Gateway::updateSession($client_id, [
            'username' => $data['get']['username'],
        ]);
    }


    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {

        if ((string)$message === '1') {
            // ping，如果
            $is_auth = $_SESSION['is_auth'];
            if (!$is_auth) {
                Gateway::closeClient($client_id, '401');
            }
        } else {
            try {
                $arr = json_decode($message, true, 512, JSON_THROW_ON_ERROR);
                if (!isset($arr['type'])) {
                    Gateway::closeClient($client_id, '400');
                } else {
                    $type = $arr['type'];
                    switch ($type) {
                        default:
                            // 未鉴权，直接关闭
                            $is_auth = $_SESSION['is_auth'];
                            if (!$is_auth) {
                                Gateway::closeClient($client_id, '401');
                            }
                            break;
                        // 鉴权
                        case 'auth':

                            // 用户
                            $username = $_SESSION['username'];

                            if (!$username) {
                                Gateway::closeClient($client_id, '401');
                            }

                            // 鉴权成功后保存状态及删除定时器
                            Gateway::updateSession($client_id, ['is_auth' => true]);
                            Timer::del($_SESSION['auth_timer_id']);

                            break;
                        case 'join':
                            if (!isset($arr['room'])) {
                                Gateway::closeClient($client_id, '400');
                            } else {
                                $session = Gateway::getSession($client_id);

                                if (isset($session['room'])) {
                                    Gateway::leaveGroup($client_id, $session['room']);
                                }

                                $room = $arr['room'];
                                Gateway::joinGroup($client_id, $room);
                                Gateway::updateSession($client_id, ['room' => $room]);
                            }

                            break;

                        case 'msg':
                            if (!isset($arr['room'])) {
                                Gateway::closeClient($client_id, '400');
                            } else {
                                $session = Gateway::getSession($client_id);
                                if (isset($session['room']) && $session['room'] === $arr['room']) {
                                    $data = [
                                        'type'     => 'msg',
                                        'data'     => $arr['data'],
                                        'username' => $session['username'],
                                        'msg_time' => date('Y-m-d H:i:s')
                                    ];
                                    Gateway::sendToGroup($arr['room'], json_encode($data, JSON_THROW_ON_ERROR));
                                } else {
                                    Gateway::closeClient($client_id, '400');
                                }
                            }
                            break;
                    }
                }
            } catch (JsonException $e) {
                Gateway::closeClient($client_id, '400');
            }

        }
    }


    /**
     * 当用户断开连接时触发
     * @param $client_id
     * @throws JsonException
     */
    public static function onClose($client_id)
    {
        $session = Gateway::getSession($client_id);

        if (isset($session['room'], $session['username'])) {
            $room     = $session['room'];
            $username = $session['username'];

            $data = [
                'type'     => 'leave',
                'username' => $username,
            ];

            Gateway::sendToGroup($room, json_encode($data, JSON_THROW_ON_ERROR));
        }
    }

    /**
     *
     * @param $businessWorker
     */
    public static function onWorkerStart($businessWorker)
    {
        if ($businessWorker->id === 0) {

            Timer::add(2, function () {

                $room_list = RoomData::ROOM_LIST;
                foreach ($room_list as $key => $room) {
                    $room_list[$key]['number'] = Gateway::getClientCountByGroup($room['code']);

                    $data = [
                        'type' => 'data',
                        'data' => $room_list,
                    ];
                    Gateway::sendToGroup($room['code'], json_encode($data, JSON_THROW_ON_ERROR));
                }
            });


        }
    }
}