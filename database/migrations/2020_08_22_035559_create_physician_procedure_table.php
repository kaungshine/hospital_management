<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicianProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physician_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physician_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('procedure_id')
                  ->nullable(false)
                  ->constrained()
                  ->onDelete('cascade');
            $table->dateTime('time');
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
        Schema::dropIfExists('physician_procedure');
    }
}
