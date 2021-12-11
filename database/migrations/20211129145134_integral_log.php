<?php

use think\migration\Migrator;
use think\migration\db\Column;

class IntegralLog extends Migrator
{

    public function change()
    {
        $table = $this->table('integral_log', ['comment' => '积分记录', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('user_id', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '用户'])
            ->addColumn('type', 'boolean', ['signed' => false,'limit' => 1, 'default' => 1, 'comment' => '类型'])// 1增加，2减少
            ->addColumn('number', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '数量'])
            ->addColumn('channel_id', 'boolean', ['signed' => false,'limit' => 2, 'default' => 0, 'comment' => '所属渠道'])
            ->addColumn('channel_data_id', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '关联记录'])
            ->addColumn('create_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
