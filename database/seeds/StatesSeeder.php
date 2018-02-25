<?php

use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Eloquent::unguard();

        $path = 'resources/external_files/states.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('States table seeded!');

    }
}
