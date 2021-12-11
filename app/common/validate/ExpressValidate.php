<?php
/**
 * 快递验证器
 */

namespace app\common\validate;

class ExpressValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',
    'code|编码' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',
    'code.required' => '编码不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'code', ],
        'admin_edit'    => ['id', 'name', 'code', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'code', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'code', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
