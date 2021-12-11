<?php
/**
 * 订单商品验证器
 */

namespace app\common\validate;

class OrderGoodsValidate extends CommonBaseValidate
{
    protected $rule = [
            'order_id|所属订单' => 'require',
    'goods_id|商品' => 'require',
    'number|数量' => 'require',
    'attr|规格' => 'require',
    'price|单价' => 'require',
    'total_price|总价' => 'require',

    ];

    protected $message = [
            'order_id.required' => '所属订单不能为空',
    'goods_id.required' => '商品不能为空',
    'number.required' => '数量不能为空',
    'attr.required' => '规格不能为空',
    'price.required' => '单价不能为空',
    'total_price.required' => '总价不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['order_id', 'goods_id', 'number', 'attr', 'price', 'total_price', ],
        'admin_edit'    => ['id', 'order_id', 'goods_id', 'number', 'attr', 'price', 'total_price', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['order_id', 'goods_id', 'number', 'attr', 'price', 'total_price', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'order_id', 'goods_id', 'number', 'attr', 'price', 'total_price', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
