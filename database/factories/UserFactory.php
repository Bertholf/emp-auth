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

// User
$factory->define(App\Models\Common\User\User::class, function (Faker $faker) {
    static $password;
    return [
        'name_first' => $faker->name_first,
        'name_last' => $faker->name_last,
        'name_slug' => $faker->user_name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
