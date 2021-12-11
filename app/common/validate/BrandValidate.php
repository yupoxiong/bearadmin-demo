<?php
/**
 * 品牌验证器
 */

namespace app\common\validate;

class BrandValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',
    'img|图片' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',
    'img.required' => '图片不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'img', ],
        'admin_edit'    => ['id', 'name', 'img', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'img', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'img', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
