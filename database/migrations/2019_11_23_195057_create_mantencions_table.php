<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantencions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->text('desc');
            $table->dateTime('fechai');
            $table->dateTime('fechaf');
            $table->unsignedBigInteger('responsable_id'); // Relación con tipo
            $table->foreign('responsable_id')->references('id')->on('trabajadors'); // clave foranea

            $table->unsignedBigInteger('planificador_id'); // Relación con tipo
            $table->foreign('planificador_id')->references('id')->on('users'); // clave foranea

            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea

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
        Schema::dropIfExists('mantencions');
    }
}
