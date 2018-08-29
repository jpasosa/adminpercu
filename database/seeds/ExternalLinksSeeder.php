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
                'code'=> 'djhu39kj4hd4yh2qmnd9',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_external_links')->insert([
                'rel_id'  => 2,
                'type'=> 'orden',
                'code'=> '87jh4hgpowt37h47fh7e',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
