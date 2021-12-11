<?php
/**
 * 文章收藏模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class ArticleCollection extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'article_collection';
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
    }/**
    * 关联文章
    */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
