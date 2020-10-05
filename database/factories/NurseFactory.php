<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Nurse;
use Faker\Generator as Faker;

$factory->define(Nurse::class, function (Faker $faker) {
    return [
        //
        'position' => $faker->word,
        'security_number' => $faker->randomDigit,
    ];
});
