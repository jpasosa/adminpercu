<?php

use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('admin_clients')->insert([
                'name'  => 'Fede',
                'last_name'=> 'el mono',
                'user_ml'=> null,
                'user_whatsapp'=> 'mono percu',
                'email' => 'mono@mono.com',
                'dni'   => '27861982',
                'phone' => '',
                'face' => null,
                'friends' => true,
                'ya_nos_compro' => true,
                'marketing' => 2,
                'admin_state_residence_id'  => 4107,
                'admin_state_shipping_id'   => 4107,
                'admin_comparsas_id' => 1,
                'observations'  => 'el mono de san martin',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            DB::table('admin_clients')->insert([
                'name'  => 'Curly',
                'last_name'=> 'de moreno',
                'user_ml'=> null,
                'user_whatsapp'=> 'curlu percu',
                'email' => 'curly@mono.com',
                'dni'   => '27876474',
                'phone' => '',
                'face' => null,
                'friends' => true,
                'ya_nos_compro' => true,
                'marketing' => 2,
                'admin_state_residence_id'  => 16529,
                'admin_state_shipping_id'   => 16529,
                'admin_comparsas_id' => 1,
                'observations'  => 'curly de moreno',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            DB::table('admin_clients')->insert([
                'name'  => 'Juampa',
                'last_name'=> 'Sosa',
                'user_ml'=> null,
                'user_whatsapp'=> 'YO',
                'email' => 'info@percu.com.ar',
                'dni'   => '27861007',
                'phone' => '',
                'face' => null,
                'friends' => true,
                'ya_nos_compro' => true,
                'marketing' => 2,
                'admin_state_residence_id'  => 16493,
                'admin_state_shipping_id'   => 16493,
                'admin_comparsas_id' => 1,
                'observations'  => 'curly de moreno',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);


    }
}
