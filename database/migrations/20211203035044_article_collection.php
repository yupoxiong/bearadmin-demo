<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ArticleCollection extends Migrator
{

    public function change()
    {
        $table = $this->table('article_collection', ['comment'=>'文章收藏','engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('user_id', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '用户'])
            ->addColumn('article_id', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '文章'])
            ->addColumn('collection_status', 'boolean', ['signed' => false, 'limit' => 1, 'default' => 1, 'comment' => '收藏状态'])
            ->addColumn('create_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
