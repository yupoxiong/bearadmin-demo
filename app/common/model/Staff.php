<?php
/**
 * 员工模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Staff extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'staff';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name','mobile',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    /**
 * 是否为老板获取器
*/
public function getIsBossTextAttr($value, $data): string
{
    return self::BOOLEAN_TEXT[$data['is_boss']];
}/**
 * 是否所属部门领导获取器
*/
public function getIsLeaderTextAttr($value, $data): string
{
    return self::BOOLEAN_TEXT[$data['is_leader']];
}/**
 * 是否启用获取器
*/
public function getStatusTextAttr($value, $data): string
{
    return self::BOOLEAN_TEXT[$data['status']];
}

    /**
    * 关联部门
    */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }/**
    * 关联职位
    */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}
