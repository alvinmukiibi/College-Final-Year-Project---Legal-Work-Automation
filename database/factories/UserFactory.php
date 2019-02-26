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
        'fname' => $faker->firstNameMale,
        'mname' => $faker->lastName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password?:$password = bcrypt('123456789'),
        'contact' => $faker->e164PhoneNumber,
        'date_of_birth' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'profile_pic' => $faker->word,
        'gender' => "Male",
        'department' => null,
        'user_role' => "ulc",
        'account_status' => "active",
        'firm_id' => null,
        


       
    ];
});