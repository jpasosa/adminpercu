<?php

use Illuminate\Database\Seeder;

class StockProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_stock_products')->insert([
                'quantity'  => 10,
                'admin_product_id'=> 876,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_stock_products')->insert([
                'quantity'  => 5,
                'admin_product_id'=> 165,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_stock_products')->insert([
                'quantity'  => 2,
                'admin_product_id'=> 322,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
