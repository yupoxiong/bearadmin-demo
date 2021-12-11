<?php
/**
 * 客户模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Customer extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    // 客户状态列表
const STATUS_LIST= [
0=>'待跟踪',
1=>'已签约',
2=>'维护中',
];


    protected $name = 'customer';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name','mobile',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    
/**
    * [FORM_NAME]获取器
    */
    public function getStatusNameAttr($value ,$data)
    {
        return self::STATUS_LIST[$data['status']];
    }


    

}
