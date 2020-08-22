<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Prescribe;
use Faker\Generator as Faker;

$factory->define(Prescribe::class, function (Faker $faker) {
    return [
        //
        'physician_id' => factory(App\Physician::class),
        'medication_id' => factory(App\Medication::class),
        'appointment_id' => factory(App\Appointment::class),
        'patient_id' => factory(App\Patient::class),
        'date' => now(),
        'dose' => $faker->word,
    ];
});
