<?php
/**
 * 订单模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;
use yupoxiong\region\model\Region;

class Order extends CommonBaseModel
{
    use SoftDelete;

    // 自定义选择数据
    const PAY_STATUS = [
        0 => '未支付',
        1 => '已支付',
    ];

    const DELIVER_STATUS = [
        0 => '未发货',
        1 => '运输中',
        2 => '已收货',
    ];

    protected $name = 'order';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name', 'mobile',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    /**
     * 付款时间获取器
     */
    public function getPayTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 付款时间修改器
     */
    public function setPayTimeAttr($value)
    {
        return strtotime($value);
    }

    /**
     * 发货时间获取器
     */
    public function getDeliverTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 发货时间修改器
     */
    public function setDeliverTimeAttr($value)
    {
        return strtotime($value);
    }

    /**
     * 收货时间获取器
     */
    public function getReceiveTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 收货时间修改器
     */
    public function setReceiveTimeAttr($value)
    {
        return strtotime($value);
    }

    public function getPayStatusTextAttr($value, $data)
    {
        return self::PAY_STATUS[$data['pay_status']];
    }

    public function getDeliverStatusTextAttr($value, $data)
    {
        return self::DELIVER_STATUS[$data['deliver_status']];
    }


    /**
     * 关联订单商品
     */
    public function orderGoods()
    {
        return $this->hasMany(OrderGoods::class);
    }

    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 关联
     */
    public function province()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * 关联
     */
    public function city()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * 关联
     */
    public function district()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * 关联
     */
    public function street()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * 关联快递
     */
    public function express()
    {
        return $this->belongsTo(Express::class);
    }

    /**
     * 关联快递
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
