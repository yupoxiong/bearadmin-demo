<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Goods extends Migrator
{

    public function change()
    {
        $table = $this->table('goods', ['comment' => '商品', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 500, 'default' => '', 'comment' => '名称'])
            ->addColumn('img', 'string', ['limit' => 255, 'default' => '', 'comment' => '图片'])
            ->addColumn('slide', 'string', ['limit' => 2000, 'default' => '', 'comment' => '轮播'])
            ->addColumn('goods_category_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '所属分类'])
            ->addColumn('brand_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '品牌'])
            ->addColumn('origin_price', 'decimal', ['signed' => false, 'precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '原价'])
            ->addColumn('price', 'decimal', ['signed' => false, 'precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '售价'])
            ->addColumn('attr', 'text', ['comment' => '规格'])
            ->addColumn('detail', 'text', ['comment' => '详情'])
            ->addColumn('weight', 'decimal', ['signed' => false, 'precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '重量'])
            ->addColumn('stock', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '库存'])
            ->addColumn('sort_number', 'integer', ['signed' => false, 'limit' => 10, 'default' => 1000, 'comment' => '排序(升序)'])
            ->addColumn('status', 'boolean', ['signed' => false, 'limit' => 1, 'default' => 1, 'comment' => '是否上架'])
            ->addColumn('create_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
