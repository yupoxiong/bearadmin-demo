<?php
/**
 * 规格组模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;
use think\model\relation\HasMany;

class AttrGroup extends CommonBaseModel
{
    use SoftDelete;

    protected $name = 'attr_group';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    public function attr(): HasMany
    {
        return $this->hasMany(Attr::class,'attr_group_id');
    }
    
}
