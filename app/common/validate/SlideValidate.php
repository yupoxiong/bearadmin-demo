<?php
/**
 * 轮播验证器
 */

namespace app\common\validate;

class SlideValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',
    'img|图片' => 'require',
    'jump_type|跳转类型' => 'require',
    'jump_target|跳转目标' => 'require',
    'sort_number|排序' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',
    'img.required' => '图片不能为空',
    'jump_type.required' => '跳转类型不能为空',
    'jump_target.required' => '跳转目标不能为空',
    'sort_number.required' => '排序不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'img', 'jump_type', 'jump_target', 'sort_number', ],
        'admin_edit'    => ['id', 'name', 'img', 'jump_type', 'jump_target', 'sort_number', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'img', 'jump_type', 'jump_target', 'sort_number', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'img', 'jump_type', 'jump_target', 'sort_number', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
