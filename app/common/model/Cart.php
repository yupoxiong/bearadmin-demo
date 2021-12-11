<?php
/**
 * 购物车模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Cart extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'cart';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    /**
    * 关联用户
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }/**
    * 关联商品
    */
    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

}
