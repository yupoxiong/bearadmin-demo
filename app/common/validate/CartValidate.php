<?php
/**
 * 购物车验证器
 */

namespace app\common\validate;

class CartValidate extends CommonBaseValidate
{
    protected $rule = [
            'user_id|用户' => 'require',
    'goods_id|商品' => 'require',
    'number|数量' => 'require',
    'attr|规格' => 'require',

    ];

    protected $message = [
            'user_id.required' => '用户不能为空',
    'goods_id.required' => '商品不能为空',
    'number.required' => '数量不能为空',
    'attr.required' => '规格不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['user_id', 'goods_id', 'number', 'attr', ],
        'admin_edit'    => ['id', 'user_id', 'goods_id', 'number', 'attr', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['user_id', 'goods_id', 'number', 'attr', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'user_id', 'goods_id', 'number', 'attr', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
