<?php
/**
 * 商品分类验证器
 */

namespace app\common\validate;

class GoodsCategoryValidate extends CommonBaseValidate
{
    protected $rule = [
            'parent_id|上级分类' => 'require',
    'name|名称' => 'require',

    ];

    protected $message = [
            'parent_id.required' => '上级分类不能为空',
    'name.required' => '名称不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['parent_id', 'name', ],
        'admin_edit'    => ['id', 'parent_id', 'name', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['parent_id', 'name', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'parent_id', 'name', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
