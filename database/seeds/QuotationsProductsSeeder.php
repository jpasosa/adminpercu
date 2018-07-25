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
        ]);
        DB::table('admin_quotations_products')->insert([
                'quantity'  => 1,
                'admin_quotation_id'=> 3,
                'admin_product_id'=> 654,
        ]);
        DB::table('admin_quotations_products')->insert([
                'quantity'  => 1,
                'admin_quotation_id'=> 3,
                'admin_product_id'=> 219,
        ]);
    }
}
