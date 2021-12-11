<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Customer extends Migrator
{

    public function change()
    {
        $table = $this->table('customer', ['comment' => '客户', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '名称'])
            ->addColumn('contact', 'string', ['limit' => 50, 'default' => '', 'comment' => '联系人'])
            ->addColumn('mobile', 'string', ['limit' => 11, 'default' => '', 'comment' => '手机号'])
            ->addColumn('email', 'string', ['limit' => 100, 'default' => '', 'comment' => '邮箱'])
            ->addColumn('address', 'string', ['limit' => 255, 'default' => '', 'comment' => '地址'])
            ->addColumn('sort_number', 'integer', ['signed' => false, 'limit' => 10, 'default' => 1000, 'comment' => '排序'])
            ->addColumn('status', 'boolean', ['signed' => false, 'limit' => 1, 'default' => 1, 'comment' => '客户状态'])
            ->addColumn('create_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
