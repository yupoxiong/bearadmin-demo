<?php
/**
 * 商品分类模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class GoodsCategory extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'goods_category';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    

    /**
    * 关联商品
    */
    public function goods()
    {
        return $this->hasMany(Goods::class);
    }/**
    * 关联上级
    */
    public function father()
    {
        return $this->belongsTo(self::class);
    }

}
