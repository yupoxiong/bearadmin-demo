<?php
/**
 * 文章收藏验证器
 */

namespace app\common\validate;

class ArticleCollectionValidate extends CommonBaseValidate
{
    protected $rule = [
            'user_id|用户' => 'require',
    'article_id|文章' => 'require',
    'collection_status|收藏状态' => 'require',

    ];

    protected $message = [
            'user_id.required' => '用户不能为空',
    'article_id.required' => '文章不能为空',
    'collection_status.required' => '收藏状态不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['user_id', 'article_id', 'collection_status', ],
        'admin_edit'    => ['id', 'user_id', 'article_id', 'collection_status', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['user_id', 'article_id', 'collection_status', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'user_id', 'article_id', 'collection_status', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
