<?php
/**
 * 收货地址模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class DeliverAddress extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'deliver_address';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name','mobile',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    /**
 * 是否默认获取器
*/
public function getIsDefaultTextAttr($value, $data): string
{
    return self::BOOLEAN_TEXT[$data['is_default']];
}

    /**
    * 关联用户
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }/**
    * 关联
    */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }/**
    * 关联
    */
    public function city()
    {
        return $this->belongsTo(City::class);
    }/**
    * 关联
    */
    public function district()
    {
        return $this->belongsTo(District::class);
    }/**
    * 关联
    */
    public function street()
    {
        return $this->belongsTo(Street::class);
    }

}
