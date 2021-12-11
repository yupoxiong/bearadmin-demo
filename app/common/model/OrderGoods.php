<?php
/**
 * 订单商品模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class OrderGoods extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'order_goods';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    /**
    * 关联订单
    */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }/**
    * 关联商品
    */
    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

}
