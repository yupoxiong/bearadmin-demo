<?php
/**
 * 快递模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Express extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'express';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    /**
    * 关联订单
    */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
