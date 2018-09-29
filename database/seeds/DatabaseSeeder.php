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
        $this->call(TimbraProductsSeeder::class);
        $this->call(ContemporaneaProductsSeeder::class);
        $this->call(RoziniProductsSeeder::class);
        $this->call(QuotationsSeeder::class);
        $this->call(QuotationsProductsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrdersProductsSeeder::class);
        $this->call(ProvidersSeeder::class);
        $this->call(ProvidersProductsSeeder::class);
        $this->call(StockProductsSeeder::class);
        $this->call(ExternalLinksSeeder::class);
    }
}
