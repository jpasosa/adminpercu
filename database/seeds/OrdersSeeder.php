<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_orders')->insert([
                'admin_client_id'  => 1,
                'number'=> 6765,
                'total_cash_fixed'=> 7500,
                'total_mp_fixed'=> 8123,
                'total_ml_fixed'=> 9546,
                'abonado_cash'=> 7654,
                'abonado_mp'=> 0,
                'abonado_ml'=> 0,
                'date_cash'=> date('Y-m-d H:i:s'),
                'date_mp'=> '',
                'date_ml'=> '',
                'empresa_send'=> 'via cargo',
                'codetrack_send'=> '543-7653',
                'cash_send'=> 234,
                'observations'=> 'las observaciones unicas de la orden',
                'status'=> 'abierta-abonada-en-viaje',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders')->insert([
                'admin_client_id'  => 2,
                'number'=> 6766,
                'total_cash_fixed'=> 950,
                'total_mp_fixed'=> 1050,
                'total_ml_fixed'=> 1200,
                'abonado_cash'=> 950,
                'abonado_mp'=> 0,
                'abonado_ml'=> 0,
                'date_cash'=> date('Y-m-d H:i:s'),
                'date_mp'=> '',
                'date_ml'=> '',
                'observations'=> 'ya están pedidos a fabrica',
                'status'=> 'abierta-abonada-esperando-instrumentos',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders')->insert([
                'admin_client_id'  => 2,
                'number'=> 6767,
                'total_cash_fixed'=> 2600,
                'total_mp_fixed'=> 2700,
                'total_ml_fixed'=> 2900,
                'abonado_cash'=> 0,
                'abonado_mp'=> 0,
                'abonado_ml'=> 2900,
                'idcobro_ml'=> '87873663726622',
                'date_ml'=> date('Y-m-d H:i:s'),
                'observations'=> 'ya están pedidos a fabrica',
                'status'=> 'ML-esperando-intrumentos',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('admin_orders')->insert([
                'admin_client_id'  => 1,
                'number'=> 6767,
                'total_cash_fixed'=> 2600,
                'total_mp_fixed'=> 2700,
                'total_ml_fixed'=> 2900,
                'abonado_cash'=> 0,
                'abonado_mp'=> 0,
                'abonado_ml'=> 2900,
                'idcobro_ml'=> '87873663726622',
                'date_ml'=> date('Y-m-d H:i:s'),
                'observations'=> 'ya están pedidos a fabrica',
                'status'=> 'ML-cerrada',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
