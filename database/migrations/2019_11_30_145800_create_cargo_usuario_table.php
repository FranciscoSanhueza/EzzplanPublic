<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('usuario_id'); // Relación con users
            $table->foreign('usuario_id')->references('id')->on('users'); // clave foranea

            $table->unsignedBigInteger('cargo_id'); // Relación con cargos
            $table->foreign('cargo_id')->references('id')->on('cargos'); // clave foranea

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
        Schema::dropIfExists('cargo_usuario');
    }
}
