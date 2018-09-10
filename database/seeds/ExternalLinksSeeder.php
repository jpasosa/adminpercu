<?php

use Illuminate\Database\Seeder;

class ExternalLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_external_links')->insert([
                'rel_id'  => 1,
                'type'=> 'orden',
                'code'=> str_random(32),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_external_links')->insert([
                'rel_id'  => 2,
                'type'=> 'orden',
                'code'=> str_random(32),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
