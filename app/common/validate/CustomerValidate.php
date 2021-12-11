<?php
/**
 * 客户验证器
 */

namespace app\common\validate;

class CustomerValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',
    'contact|联系人' => 'require',
    'mobile|手机号' => 'require|mobile',
    'email|邮箱' => 'require',
    'address|地址' => 'require',
    'sort_number|排序' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',
    'contact.required' => '联系人不能为空',
    'mobile.required' => '手机号不能为空',
    'mobile.mobile' => '手机号必须为11位手机号码',
    'email.required' => '邮箱不能为空',
    'address.required' => '地址不能为空',
    'sort_number.required' => '排序不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'contact', 'mobile', 'email', 'address', 'sort_number', 'status', ],
        'admin_edit'    => ['id', 'name', 'contact', 'mobile', 'email', 'address', 'sort_number', 'status', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'contact', 'mobile', 'email', 'address', 'sort_number', 'status', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'contact', 'mobile', 'email', 'address', 'sort_number', 'status', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
