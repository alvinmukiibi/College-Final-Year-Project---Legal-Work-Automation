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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    return [
        'email' => 'ulc@gmail.com',
        'password' => $password?:$password = bcrypt('123456789'),
        'profile_pic' => 'default_user.jpg',
        'user_role' => "ulc",
        'account_status' => "active",
    ];
});
