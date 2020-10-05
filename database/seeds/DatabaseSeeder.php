<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // factory(App\Patient::class, 3)->create()->each(function ($patient){$patient->appointments()->createMany(factory(App\Appointment::class, 3)->make()->toArray()); $patient->});
        // factory(App\Appointment::class, 3)->create()->each(function ($appointment){$appointment->patient()->save(factory(App\Patient::class)->make());$appointment->nurse()->save(factory(App\Nurse::class)->make());$appointment->physician()->save(factory(App\Physician::class)->make());});

        $this->call(RoomTableSeeder::class);
        $this->call(MedicationTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(ProcedureTableSeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserSeederTable::class);
    }
}
