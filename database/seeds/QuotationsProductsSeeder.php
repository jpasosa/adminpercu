<?php

use Illuminate\Database\Seeder;

class QuotationsProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_quotations_products')->insert([
                'quantity'  => 2,
                'admin_quotation_id'=> 3,
                'admin_product_id'=> 576,
                'clarifications'=> 'color robo/blanco',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_quotations_products')->insert([
                'quantity'  => 1,
                'admin_quotation_id'=> 3,
                'admin_product_id'=> 654,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_quotations_products')->insert([
                'quantity'  => 1,
                'admin_quotation_id'=> 3,
                'admin_product_id'=> 219,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
