<?php
/**
 * 标签模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Tag extends CommonBaseModel
{
    use SoftDelete;
    // 自定义选择数据
    

    protected $name = 'tag';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = ['name',];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    public function article()
    {
        return $this->belongsToMany(Article::class, ArticleTag::class);
    }

    /**
    * 关联文章标签
    */
    public function articleTag()
    {
        return $this->hasMany(ArticleTag::class);
    }

}
