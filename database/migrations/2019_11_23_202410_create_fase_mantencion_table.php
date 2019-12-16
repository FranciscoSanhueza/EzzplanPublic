<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaseMantencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_mantencion', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('mantencion_id'); // Relación con libros
            $table->foreign('mantencion_id')->references('id')->on('mantencions'); // clave foranea

            $table->unsignedBigInteger('fase_id'); // Relación con libros
            $table->foreign('fase_id')->references('id')->on('fases'); // clave foranea

            $table->unsignedBigInteger('estado_id'); // Relación con libros
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
        Schema::dropIfExists('fase_mantencion');
    }
}
