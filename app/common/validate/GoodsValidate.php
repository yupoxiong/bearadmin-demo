<?php
/**
 * 商品验证器
 */

namespace app\common\validate;

class GoodsValidate extends CommonBaseValidate
{
    protected $rule = [
        'name|名称'                => 'require',
        'img|图片'                 => 'require',
        'slide|轮播'               => 'require',
        'goods_category_id|所属分类' => 'require',
        'brand_id|品牌'            => 'require',
        'origin_price|原价'        => 'require',
        'price|售价'               => 'require',
        'use_attr|是否使用规格'        => 'require',
        'attr|规格'                => 'require',
        'detail|详情'              => 'require',
        'weight|重量'              => 'require',
        'stock|库存'               => 'require',
        'sort_number|排序(升序)'     => 'require',
        'status|是否上架'            => 'require',

    ];

    protected $message = [
        'name.required'              => '名称不能为空',
        'img.required'               => '图片不能为空',
        'slide.required'             => '轮播不能为空',
        'goods_category_id.required' => '所属分类不能为空',
        'brand_id.required'          => '品牌不能为空',
        'origin_price.required'      => '原价不能为空',
        'price.required'             => '售价不能为空',
        'use_attr.required'          => '是否使用规格不能为空',
        'attr.required'              => '规格不能为空',
        'detail.required'            => '详情不能为空',
        'weight.required'            => '重量不能为空',
        'stock.required'             => '库存不能为空',
        'sort_number.required'       => '排序(升序)不能为空',
        'status.required'            => '是否上架不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'img', 'slide', 'goods_category_id', 'brand_id', 'origin_price', 'price', 'use_attr', 'detail', 'weight', 'stock', 'sort_number', 'status',],
        'admin_edit'    => ['id', 'name', 'img', 'slide', 'goods_category_id', 'brand_id', 'origin_price', 'price', 'use_attr', 'detail', 'weight', 'stock', 'sort_number', 'status',],
        'admin_del'     => ['id',],
        'admin_disable' => ['id',],
        'admin_enable'  => ['id',],
        'api_add'       => ['name', 'img', 'slide', 'goods_category_id', 'brand_id', 'origin_price', 'price', 'use_attr', 'detail', 'weight', 'stock', 'sort_number', 'status',],
        'api_info'      => ['id',],
        'api_edit'      => ['id', 'name', 'img', 'slide', 'goods_category_id', 'brand_id', 'origin_price', 'price', 'detail', 'weight', 'stock', 'sort_number', 'status',],
        'api_del'       => ['id',],
        'api_disable'   => ['id',],
        'api_enable'    => ['id',],
    ];
}
