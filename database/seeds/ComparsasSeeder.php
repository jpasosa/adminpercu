<?php

use Illuminate\Database\Seeder;

class ComparsasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('admin_comparsas')->insert([
            'admin_state_id'=> 4107,
            'facebook_page' => 'https://www.facebook.com/profile.php?id=100010586884175',
            'members_cant'  => 4999,
            'can_publish'   => true,
            'observations'  => 'José de San Martin',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_comparsas')->insert([
            'admin_state_id'=> 16529,
            'facebook_page' => 'https://www.facebook.com/batucada.p.samba',
            'members_cant'  => 2.466,
            'can_publish'   => true,
            'observations'  => 'Curly de moreno',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
    }
}

