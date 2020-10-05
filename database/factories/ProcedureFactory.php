<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Procedure;
use Faker\Generator as Faker;

$factory->define(Procedure::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'cost' => $faker->randomNumber(null, false),
    ];
});
