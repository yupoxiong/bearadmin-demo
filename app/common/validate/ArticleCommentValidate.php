<?php
/**
 * 文章评论验证器
 */

namespace app\common\validate;

class ArticleCommentValidate extends CommonBaseValidate
{
    protected $rule = [
            'user_id|评论用户' => 'require',
    'parent_id|父级评论' => 'require',
    'content|评论内容' => 'require',

    ];

    protected $message = [
            'user_id.required' => '评论用户不能为空',
    'parent_id.required' => '父级评论不能为空',
    'content.required' => '评论内容不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['user_id', 'parent_id', 'content', ],
        'admin_edit'    => ['id', 'user_id', 'parent_id', 'content', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['user_id', 'parent_id', 'content', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'user_id', 'parent_id', 'content', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
