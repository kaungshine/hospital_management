<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        //
        'roomtype' => $faker->name,
        'blockfloor' => $faker->randomDigit,
        'blockcode' => $faker->randomDigit,
        'unavailable' => $faker->numberBetween(0, 1) 
    ];
});
