<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantencionTrabajadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantencion_trabajador', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('mantencion_id'); // Relación con libros
            $table->foreign('mantencion_id')->references('id')->on('mantencions'); // clave foranea

            $table->unsignedBigInteger('trabajador_id'); // Relación con libros
            $table->foreign('trabajador_id')->references('id')->on('trabajadors'); // clave foranea
           
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
        Schema::dropIfExists('mantencion_trabajador');
    }
}
