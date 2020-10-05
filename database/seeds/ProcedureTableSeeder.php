<?php

use Illuminate\Database\Seeder;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Procedure::class, 5)->create();
    }
}
