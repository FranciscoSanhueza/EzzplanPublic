<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumoMantencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_mantencion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('mantencion_id'); // Relación con libros
            $table->foreign('mantencion_id')->references('id')->on('mantencions'); // clave foranea

            $table->unsignedBigInteger('insumo_id'); // Relación con libros
            $table->foreign('insumo_id')->references('id')->on('insumos'); // clave foranea

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
        Schema::dropIfExists('insumo_mantencion');
    }
}
