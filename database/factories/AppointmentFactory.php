<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        //
        'physician_id' => factory(App\Physician::class),
        'nurse_id' => factory(App\Nurse::class),
        'patient_id' => factory(App\Patient::class),
        'start_dt_time' => date('Y-m-d'),
        'end_dt_time' => date('Y-m-d'),
        'examinationroom' => $faker->word(),
    ];
});
