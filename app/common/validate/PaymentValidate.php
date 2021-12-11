<?php
/**
 * 支付方式验证器
 */

namespace app\common\validate;

class PaymentValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|名称' => 'require',
    'img|图片' => 'require',
    'code|代码' => 'require',
    'app_key|AppKey' => 'require',
    'app_secret|AppSecret' => 'require',

    ];

    protected $message = [
            'name.required' => '名称不能为空',
    'img.required' => '图片不能为空',
    'code.required' => '代码不能为空',
    'app_key.required' => 'AppKey不能为空',
    'app_secret.required' => 'AppSecret不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'img', 'code', 'app_key', 'app_secret', ],
        'admin_edit'    => ['id', 'name', 'img', 'code', 'app_key', 'app_secret', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'img', 'code', 'app_key', 'app_secret', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'img', 'code', 'app_key', 'app_secret', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
