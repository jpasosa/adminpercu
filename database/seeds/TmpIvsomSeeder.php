<?php

use Illuminate\Database\Seeder;

use App\Http\Controllers\ImportPriceListController;


class TmpIvsomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doble_com = '"';


        $table = 'tmp_ivsom';
        $q = 'LOAD DATA LOCAL INFILE "/var/www/html/adminpercu/resources/external_files/ivsom.csv" INTO TABLE ' . $table . ' CHARACTER SET UTF8 FIELDS TERMINATED BY "," ENCLOSED BY ' . "'" . $doble_com . "'";




        // inserto los registros en tabla temporal.
        try {
            $seed_tmp = DB::connection()->getPdo()->exec($q);

        } catch (\Exception $e) {
            $this->command->error('ERROR!');
            $this->command->error($e->getMessage());
            exit(1);
        }

        $this->command->info('Registros insertados en tabla ' . $table . ' [OK] ');
        $this->command->info('Se insertaron ' . $seed_tmp . ' registros.');

        $ins_products_ivsom = ImportPriceListController::importIvsom();

        if ($ins_products_ivsom)
        {
            $this->command->info('Se insertaron los productos IVSOM en tabla definitiva. [OK] ');
        } else {
            $this->command->error('No se pudieron insertar los productos IVSOM en la tabla definitiva');
        }


    }
}
