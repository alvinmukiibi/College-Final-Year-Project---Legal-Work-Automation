<?php

use Faker\Generator as Faker;

$factory->define(App\Firms::class, function (Faker $faker) {
    return [
        
            'firm_id' => $faker->word,
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'contact1' => $faker->phoneNumber,
            'contact2' => $faker->phoneNumber,
            'password' => $faker->password,
            'country' => $faker->country,
            'area' => $faker->country,
            'city' => $faker->city,
            'street_address' => $faker->streetAddress,
            'practice_groups' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'avatar' => $faker->imageUrl($width = 640, $height = 480),
            'website' => $faker->url,
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'activity_flag' => $faker->city,
            'verification_flag' => $faker->city
    ];
});
