<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Payment extends Migrator
{

    public function change()
    {
        $table = $this->table('payment', ['comment' => '支付方式', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '名称'])
            ->addColumn('img', 'string', ['limit' => 255, 'default' => '', 'comment' => '图片'])
            ->addColumn('code', 'string', ['limit' => 100, 'default' => '', 'comment' => '代码'])
            ->addColumn('app_id', 'string', ['limit' => 100, 'default' => '', 'comment' => 'AppID'])
            ->addColumn('app_key', 'string', ['limit' => 100, 'default' => '', 'comment' => 'AppKey'])
            ->addColumn('app_secret', 'string', ['limit' => 100, 'default' => '', 'comment' => 'AppSecret'])
            ->addColumn('create_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false, 'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
