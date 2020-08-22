<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescribes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physician_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('patient_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('medication_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->date('date');
            $table->foreignId('appointment_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->text('dose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescribes');
    }
}
