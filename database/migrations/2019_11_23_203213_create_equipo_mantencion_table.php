<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoMantencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_mantencion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('mantencion_id'); // Relación con libros
            $table->foreign('mantencion_id')->references('id')->on('mantencions'); // clave foranea

            $table->unsignedBigInteger('equipo_id'); // Relación con libros
            $table->foreign('equipo_id')->references('id')->on('equipos'); // clave foranea
          
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
        Schema::dropIfExists('equipo_mantencion');
    }
}
