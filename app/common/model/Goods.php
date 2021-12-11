<?php
/**
 * 商品模型
 */

namespace app\common\model;

use JsonException;
use think\model\concern\SoftDelete;
use think\model\relation\BelongsTo;
use think\model\relation\HasMany;

class Goods extends CommonBaseModel
{
    use SoftDelete;

    // 自定义选择数据


    protected $name = 'goods';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    /**
     * 是否上架获取器
     */
    public function getStatusTextAttr($value, $data): string
    {
        return self::BOOLEAN_TEXT[$data['status']];
    }

    /**
     * 关联购物车
     */
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * 关联商品分类
     */
    public function goodsCategory(): BelongsTo
    {
        return $this->belongsTo(GoodsCategory::class);
    }

    /**
     * 关联品牌
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    /**
     * 规格获取器
     * @throws JsonException
     */
    public function getAttrAttr($value)
    {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * 规格修改器
     * @param $value
     * @return false|string
     * @throws JsonException
     */
    public function setAttrAttr($value)
    {
        return json_encode($value, JSON_THROW_ON_ERROR);
    }


    /**
     * 获取当前总库存
     * @param $value
     * @return int|mixed
     */
    public function getStockAttr($value)
    {
        $stock = 0;
        if ($this->use_attr === 0) {
            $stock = $value;
        } else {
            foreach ($this->attr as $item) {
                $stock += $item['number'];
            }
        }
        return $stock;
    }


    /**
     * @throws JsonException
     */
    public function getAttrGroupListAttr($value, $data): array
    {
        $attr_group_list = [];

        $attr_list = json_decode($data['attr'], true, 512, JSON_THROW_ON_ERROR);

        foreach ($attr_list as $val) {

            foreach ($val['attr_info'] as $attr_value) {

                $attr_id = $attr_value['attr_id'];
                $attr = (new Attr)->where('id', '=', $attr_id)->findOrEmpty();
                if ($attr->isEmpty()) {
                    continue;
                }
                $in_list = false;

                foreach ($attr_group_list as $group_key => $item_group) {
                    if ($item_group['attr_group_id'] === $attr->attr_group_id) {
                        $attr_arr = [
                            'attr_id'   => $attr->id,
                            'attr_name' => $attr->name,
                        ];

                        if (!in_array($attr->id, array_column($item_group['attr_list'], 'attr_id'),false)) {
                            $attr_group_list[$group_key]['attr_list'][] = $attr_arr;
                        }
                        $in_list = true;
                    }
                }

                if (!$in_list) {
                    $attr_group = (new AttrGroup)->where('id', '=', $attr->attr_group_id)->findOrEmpty();
                    if (!$attr_group->isEmpty()) {
                        $attr_group_list[] = [
                            'attr_group_id'   => $attr_group->id,
                            'attr_group_name' => $attr_group->name,
                            'attr_list'       => [
                                [
                                    'attr_id'   => $attr->id,
                                    'attr_name' => $attr->name,
                                ],
                            ],
                        ];
                    }
                }
            }
        }

        return $attr_group_list;
    }
}
