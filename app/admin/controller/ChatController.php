<?php
/**
 *
 * @author yupoxiong<i@yupoxiong.com>
 */

declare (strict_types=1);


namespace app\admin\controller;


use app\admin\data\RoomData;
use Exception;

class ChatController extends AdminBaseController
{

    /**
     * @throws Exception
     */
    public function index(): string
    {

        $this->assign([
            'room_list'=>RoomData::ROOM_LIST,
        ]);
        return $this->fetch();
    }
}