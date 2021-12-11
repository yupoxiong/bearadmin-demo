<?php
/**
 * 文章点赞模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class ArticleVote extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据

    public const VOTE_STATUS = [
        0=>'已取消',
        1=>'正常',
    ];

    protected $name = 'article_vote';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    public function getVoteStatusTextAttr($value,$data): string
    {
        return self::VOTE_STATUS[$data['vote_status']];
    }

    /**
    * 关联用户
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }/**
    * 关联文章
    */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
