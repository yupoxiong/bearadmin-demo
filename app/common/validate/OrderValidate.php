<?php
/**
 * 订单验证器
 */

namespace app\common\validate;

class OrderValidate extends CommonBaseValidate
{
    protected $rule = [
            'order_no|订单编号' => 'require',
    'user_id|下单用户' => 'require',
    'order_price|订单金额' => 'require',
    'pay_price|支付金额' => 'require',
    'goods_price|商品总额' => 'require',
    'express_price|运费' => 'require',
    'name|姓名' => 'require',
    'mobile|手机号' => 'require',
    'province_id|省' => 'require',
    'city_id|市' => 'require',
    'district_id|区县' => 'require',
    'street_id|街道' => 'require',
    'address|收货地址' => 'require',
    'full_address|完整收货地址' => 'require',
    'express_id|快递公司' => 'require',
    'express_no|快递单号' => 'require',
    'payment_id|支付方式' => 'require',
    'pay_status|支付状态' => 'require',
    'pay_time|付款时间' => 'require',
    'deliver_status|发货状态' => 'require',
    'deliver_time|发货时间' => 'require',
    'receive_time|收货时间' => 'require',

    ];

    protected $message = [
            'order_no.required' => '订单编号不能为空',
    'user_id.required' => '下单用户不能为空',
    'order_price.required' => '订单金额不能为空',
    'pay_price.required' => '支付金额不能为空',
    'goods_price.required' => '商品总额不能为空',
    'express_price.required' => '运费不能为空',
    'name.required' => '姓名不能为空',
    'mobile.required' => '手机号不能为空',
    'province_id.required' => '省不能为空',
    'city_id.required' => '市不能为空',
    'district_id.required' => '区县不能为空',
    'street_id.required' => '街道不能为空',
    'address.required' => '收货地址不能为空',
    'full_address.required' => '完整收货地址不能为空',
    'express_id.required' => '快递公司不能为空',
    'express_no.required' => '快递单号不能为空',
    'payment_id.required' => '支付方式不能为空',
    'pay_status.required' => '支付状态不能为空',
    'pay_time.required' => '付款时间不能为空',
    'deliver_status.required' => '发货状态不能为空',
    'deliver_time.required' => '发货时间不能为空',
    'receive_time.required' => '收货时间不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'address', 'full_address', 'express_id', 'express_no', 'payment_id', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time', ],
        'admin_edit'    => ['id', 'order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'address', 'full_address', 'express_id', 'express_no', 'payment_id', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'address', 'full_address', 'express_id', 'express_no', 'payment_id', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'address', 'full_address', 'express_id', 'express_no', 'payment_id', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
