<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'address' => $faker->word,
        'phone' => $faker->word,
        'insuranceid' => $faker->randomDigit,
    ];
});
