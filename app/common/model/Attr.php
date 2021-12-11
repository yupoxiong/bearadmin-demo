<?php
/**
 * 规格模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;
use think\model\relation\BelongsTo;

class Attr extends CommonBaseModel
{
    use SoftDelete;

    protected $name = 'attr';
    protected $autoWriteTimestamp = true;

    // 可搜索字段
    public array $searchField = [];

    // 可作为条件的字段
    public array $whereField = [];

    // 可做为时间
    public array $timeField = [];

    public function attrGroup(): BelongsTo
    {
        return $this->belongsTo(AttrGroup::class,'attr_group_id');
    }
}
