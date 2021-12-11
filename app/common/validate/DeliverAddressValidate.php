<?php
/**
 * 收货地址验证器
 */

namespace app\common\validate;

class DeliverAddressValidate extends CommonBaseValidate
{
    protected $rule = [
            'user_id|用户' => 'require',
    'name|姓名' => 'require',
    'mobile|手机号' => 'require',
    'province_id|省' => 'require',
    'city_id|市' => 'require',
    'district_id|区' => 'require',
    'street_id|街道' => 'require',
    'detail|详细地址' => 'require',
    'is_default|是否默认' => 'require',

    ];

    protected $message = [
            'user_id.required' => '用户不能为空',
    'name.required' => '姓名不能为空',
    'mobile.required' => '手机号不能为空',
    'province_id.required' => '省不能为空',
    'city_id.required' => '市不能为空',
    'district_id.required' => '区不能为空',
    'street_id.required' => '街道不能为空',
    'detail.required' => '详细地址不能为空',
    'is_default.required' => '是否默认不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default', ],
        'admin_edit'    => ['id', 'user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
