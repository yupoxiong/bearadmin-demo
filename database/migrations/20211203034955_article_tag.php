<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ArticleTag extends Migrator
{

    public function change()
    {
        $table = $this->table('article_tag', ['comment' => '文章标签', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('article_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '文章'])
            ->addColumn('tag_id', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '标签'])
            ->addColumn('tag_status', 'boolean', ['signed' => false, 'limit' => 1, 'default' => 1, 'comment' => '标签状态'])
            ->addColumn('create_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
