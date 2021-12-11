<?php
/**
 * 文章验证器
 */

namespace app\common\validate;

class ArticleValidate extends CommonBaseValidate
{
    protected $rule = [
            'name|标题' => 'require',
    'user_id|发布人' => 'require',
    'article_category_id|所属分类' => 'require',
    'description|简介' => 'require',
    'content|内容' => 'require',
    'is_top|是否置顶' => 'require',
    'is_hot|是否热门' => 'require',
    'img|缩略图' => 'require',
    'sort_number|排序' => 'require',
    'view_count|浏览数' => 'require',

    ];

    protected $message = [
            'name.required' => '标题不能为空',
    'user_id.required' => '发布人不能为空',
    'article_category_id.required' => '所属分类不能为空',
    'description.required' => '简介不能为空',
    'content.required' => '内容不能为空',
    'is_top.required' => '是否置顶不能为空',
    'is_hot.required' => '是否热门不能为空',
    'img.required' => '缩略图不能为空',
    'sort_number.required' => '排序不能为空',
    'view_count.required' => '浏览数不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'img', 'sort_number', 'view_count', ],
        'admin_edit'    => ['id', 'name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'img', 'sort_number', 'view_count', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'img', 'sort_number', 'view_count', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'img', 'sort_number', 'view_count', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
