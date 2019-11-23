<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('run', 12);
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono');
            $table->unsignedBigInteger('cargo_id'); // Relación con cargo
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
        Schema::dropIfExists('trabajadors');
    }
}
