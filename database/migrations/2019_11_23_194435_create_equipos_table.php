<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->text('desc');
            $table->string('qr');

            $table->unsignedBigInteger('tipo_id'); // Relación con tipo
            $table->foreign('tipo_id')->references('id')->on('tipos'); // clave foranea
          
            $table->unsignedBigInteger('departamento_id'); // Relación con departamento
            $table->foreign('departamento_id')->references('id')->on('departamentos'); // clave foranea
            
            $table->unsignedBigInteger('fabricante_id'); // Relación con fabricante
            $table->foreign('fabricante_id')->references('id')->on('fabricantes'); // clave foranea
            
            $table->date('fechaIngreso');

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
        Schema::dropIfExists('equipos');
    }
}
