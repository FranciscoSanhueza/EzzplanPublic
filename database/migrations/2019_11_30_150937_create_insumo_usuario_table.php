<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('usuario_id'); // Relación con users
            $table->foreign('usuario_id')->references('id')->on('users'); // clave foranea

            $table->unsignedBigInteger('insumo_id'); // Relación con insumos
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
        Schema::dropIfExists('insumo_usuario');
    }
}
