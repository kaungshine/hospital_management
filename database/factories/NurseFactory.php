<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Nurse;
use Faker\Generator as Faker;

$factory->define(Nurse::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'position' => $faker->word,
        'ssn' => $faker->randomDigit,
    ];
});
