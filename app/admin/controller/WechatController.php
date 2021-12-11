<?php
/**
 *
 * @author yupoxiong<i@yupoxiong.com>
 */

declare (strict_types=1);


namespace app\admin\controller;


use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\BadRequestException;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class WechatController extends AdminBaseController
{

    /**
     * @throws Exception
     */
    public function index(): string
    {
        return $this->fetch();
    }


    //服务端验证
    public function server()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        // 将响应输出
        try {
            return $app->server->serve()->send();
        } catch (BadRequestException | InvalidArgumentException | InvalidConfigException $e) {
            return  $e->getMessage();
        }
    }

    //接收 & 回复用户消息
    public function msg()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            return "你好哇";
        });

        try {
            return $app->server->serve()->send();
        } catch (BadRequestException | InvalidArgumentException | InvalidConfigException $e) {
            return  $e->getMessage();
        }
    }

    //获取用户信息
    public function user()
    {
        $config = config('wechat.');

        $app  = Factory::officialAccount($config);
        try {
            $user = $app->user->get('用户的openID');
        } catch (InvalidConfigException $e) {
            $user = [];
        }
        return $user;

    }


    //发送模版消息
    public function templateMsg()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        try {
            $app->template_message->send([
                'touser'      => 'user-openid',
                'template_id' => 'template-id',
                'url'         => 'https://easywechat.org',
                'miniprogram' => [
                    'appid'    => 'appId',
                    'pagepath' => 'pages/xxx',
                ],
                'data'        => [
                    'key1' => 'VALUE',
                    'key2' => 'VALUE2',
                ],
            ]);
            return  'success';
        } catch (InvalidArgumentException | InvalidConfigException | GuzzleException $e) {
            return $e->getMessage();
        }
    }


    //拉黑用户
    public function block()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        try {
            $app->user->block('openid');
            // 或者多个用户
            $app->user->block(['openid1', 'openid2', 'openid3',]);

        } catch (InvalidConfigException | GuzzleException $e) {
        }
    }


    //统一下单
    public function pay()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        try {
            $result = $app->order->unify([
                'body'             => '腾讯充值中心-QQ会员充值',
                'out_trade_no'     => '20150806125346',
                'total_fee'        => 88,
                'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
                'notify_url'       => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'trade_type'       => 'JSAPI', // 请对应换成你的支付方式对应的值类型
                'openid'           => 'oUpF8uMuAJO_M2pxb1Q9zNjWeS6o',
            ]);
            return  $result;
        } catch (InvalidArgumentException | GuzzleException | InvalidConfigException $e) {

            return $e->getMessage();
        }
    }


    //根据微信订单号退款
    public function refundByTransactionId()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        try {
            $result = $app->refund->byTransactionId('transaction-id-xxx', 'refund-no-xxx', 10000, 10000, [
                // 可在此处传入其他参数，详细参数见微信支付文档
                'refund_desc' => '商品已售完',
            ]);
            return  $result;
        } catch (InvalidConfigException $e) {
            return $e->getMessage();
        }
    }


    //根据商户订单号退款
    public function refundByOutTradeNo()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        try {
            return $app->refund->byOutTradeNumber('out-trade-no-xxx', 'refund-no-xxx', 20000, 1000, [
                // 可在此处传入其他参数，详细参数见微信支付文档
                'refund_desc' => '退运费',
            ]);
        } catch (InvalidConfigException $e) {
            return $e->getMessage();
        }
    }


    //发送普通红包
    public function redPacket()
    {
        $config      = config('wechat.');
        $app         = Factory::payment($config);
        $red_pack     = $app->redpack;
        $redPackData = [
            'mch_billno'   => 'xy123456',
            'send_name'    => '测试红包',
            're_openid'    => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'    => 1,  //固定为1，可不传
            'total_amount' => 100,  //单位为分，不小于100
            'wishing'      => '祝福语',
            'client_ip'    => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name'     => '测试活动',
            'remark'       => '测试备注',
            // ...
        ];

        try {
            $result = $red_pack->sendNormal($redPackData);
        } catch (InvalidArgumentException | InvalidConfigException | GuzzleException $e) {
            $result = [];
        }

        return $result;
    }

}