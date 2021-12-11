<?php
/**
 * 文章点赞验证器
 */

namespace app\common\validate;

class ArticleVoteValidate extends CommonBaseValidate
{
    protected $rule = [
            'user_id|用户' => 'require',
    'article_id|文章' => 'require',
    'vote_status|点赞状态' => 'require',

    ];

    protected $message = [
            'user_id.required' => '用户不能为空',
    'article_id.required' => '文章不能为空',
    'vote_status.required' => '点赞状态不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['user_id', 'article_id', 'vote_status', ],
        'admin_edit'    => ['id', 'user_id', 'article_id', 'vote_status', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['user_id', 'article_id', 'vote_status', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'user_id', 'article_id', 'vote_status', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
