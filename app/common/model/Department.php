<?php
/**
 * 部门模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Department extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'department';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    /**
    * 关联员工
    */
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }/**
    * 关联上级
    */
    public function father()
    {
        return $this->belongsTo(self::class);
    }

}
