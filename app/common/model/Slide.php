<?php
/**
 * 轮播模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Slide extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'slide';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    

}
