<?php
/**
 * 标签验证器
 */

namespace app\common\validate;

class TagValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', ],
        'admin_edit'    => ['id', 'name', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
