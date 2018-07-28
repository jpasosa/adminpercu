<?php

use Illuminate\Database\Seeder;

class OrdersProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_orders_products')->insert([
                'quantity'  => 2,
                'admin_order_id'=> 1,
                'admin_product_id'=> 576,
                'clarifications'=> 'color robo/blanco',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 1,
                'admin_product_id'=> 126,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 1,
                'admin_product_id'=> 432,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 2,
                'admin_product_id'=> 765,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 2,
                'admin_product_id'=> 587,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 3,
                'admin_product_id'=> 476,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders_products')->insert([
                'quantity'  => 1,
                'admin_order_id'=> 4,
                'admin_product_id'=> 676,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
