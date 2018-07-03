<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(ComparsasSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(TmpIvsomSeeder::class);
        $this->call(GopeProductsSeeder::class);
        $this->call(KingProductsSeeder::class);
    }
}
