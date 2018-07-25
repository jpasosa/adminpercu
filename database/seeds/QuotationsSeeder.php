<?php

use Illuminate\Database\Seeder;

class QuotationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_quotations')->insert([
                'admin_client_id'  => 1,
                'number'=> 6765,
        ]);
        DB::table('admin_quotations')->insert([
                'admin_client_id'  => 2,
                'number'=> 6766,
        ]);
        DB::table('admin_quotations')->insert([
                'admin_client_id'  => 2,
                'number'=> 6767,
        ]);
    }
}


