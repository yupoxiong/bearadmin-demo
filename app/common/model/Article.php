<?php
/**
 * 文章模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Article extends CommonBaseModel
{
    use SoftDelete;

    // 自定义选择数据


    protected $name = 'article';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name', 'description',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    /**
     * 是否置顶获取器
     */
    public function getIsTopTextAttr($value, $data): string
    {
        return self::BOOLEAN_TEXT[$data['is_top']];
    }

    /**
     * 是否热门获取器
     */
    public function getIsHotTextAttr($value, $data): string
    {
        return self::BOOLEAN_TEXT[$data['is_hot']];
    }

    /**
     * 关联文章收藏
     */
    public function articleCollection()
    {
        return $this->hasMany(ArticleCollection::class);
    }

    /**
     * 关联文章标签
     */
    public function articleTag()
    {
        return $this->hasMany(ArticleTag::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class);
    }

    /**
     * 关联文章点赞
     */
    public function articleVote()
    {
        return $this->hasMany(ArticleVote::class);
    }

    /**
     * 关联文章点赞
     */
    public function articleComment()
    {
        return $this->hasMany(ArticleComment::class);
    }

    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 关联文章分类
     */
    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

}
