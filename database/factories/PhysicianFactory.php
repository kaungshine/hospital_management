<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Physician;
use Faker\Generator as Faker;

$factory->define(Physician::class, function (Faker $faker) {
    return [
        'position' => $faker->word,
        'security_number' => $faker->randomDigit,
    ];
});
