<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Cart extends Migrator
{

    public function change()
    {
        $table = $this->table('cart', ['comment' => '购物车', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table

            ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '用户'])
            ->addColumn('goods_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '商品'])
            ->addColumn('number', 'integer', ['limit' => 10, 'default' => 1, 'comment' => '数量'])
            ->addColumn('attr', 'string', ['limit' => 100, 'default' => '', 'comment' => '规格'])
            ->addColumn('create_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['signed' => false,'limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
