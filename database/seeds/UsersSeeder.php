<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name'      => 'Juan Pablo Sosa',
            'email'     => 'info@percu.com.ar',
            'password'  => bcrypt('qwerpoiu15'),
        ]);

    }
}
