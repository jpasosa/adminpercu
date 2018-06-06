<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\AdminComparsas::class, function (Faker $faker) {


    return [
        'name_comparsa' => $faker->sentence(2),
        'name_bateria'  => $faker->sentence(2),
        'admin_state_id'=> 4107,
        'facebook_page' => 'fecabook.com/' . $faker->userName,
        'members_cant'  => $faker->randomNumber(4),
        'can_publish'   => $faker->randomElement([true, false]),
        'observations'  => $faker->sentence(15),
    ];

});







