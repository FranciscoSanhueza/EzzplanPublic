<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajador_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('usuario_id'); // Relación con users
            $table->foreign('usuario_id')->references('id')->on('users'); // clave foranea

            $table->unsignedBigInteger('trabajador_id'); // Relación con trabajadors
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
        Schema::dropIfExists('trabajador_usuario');
    }
}
