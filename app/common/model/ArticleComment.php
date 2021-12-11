<?php
/**
 * 文章评论模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class ArticleComment extends CommonBaseModel
{
    use SoftDelete;

    // 自定义选择数据


    protected $name = 'article_comment';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];


    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 关联用户
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    /**
     * 关联
     */
    public function father()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

}
