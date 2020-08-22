<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Physician;
use Faker\Generator as Faker;

$factory->define(Physician::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position' => $faker->word,
        'ssn' => $faker->randomDigit
    ];
});
