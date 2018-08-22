<?php

use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admin_providers')->insert([
                'number'=> 8765,
                'status' => 'viajando-caseros',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
         DB::table('admin_providers')->insert([
                'number'=> 8766,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
         DB::table('admin_providers')->insert([
                'number'=> 8767,
                'status' => 'en-frontera',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
