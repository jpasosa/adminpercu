<?php

use Illuminate\Database\Seeder;

class ProvidersProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_providers_products')->insert([
                'quantity'  => 2,
                'admin_provider_id'=> 1,
                'admin_product_id'=> 579,
                'list_price'=> 750,
                'subt_price'=> 2*750,
                'discount_price'=> 240,
                'total_price'=> 1240,
                'clarifications'=> 'color robo/blanco',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_providers_products')->insert([
                'quantity'  => 10,
                'admin_provider_id'=> 1,
                'admin_product_id'=> 876,
                'clarifications'=> '',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_providers_products')->insert([
                'quantity'  => 3,
                'admin_provider_id'=> 2,
                'admin_product_id'=> 328,
                'clarifications'=> '',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
