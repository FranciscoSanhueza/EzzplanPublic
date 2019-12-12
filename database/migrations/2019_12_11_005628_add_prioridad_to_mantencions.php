<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrioridadToMantencions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantencions', function (Blueprint $table) {
            $table->unsignedBigInteger('prioridad_id'); // Relación con usuario
            $table->foreign('prioridad_id')->references('id')->on('prioridads'); // clave foranea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mantencions', function (Blueprint $table) {
            $table->dropForeign('mantencions_prioridad_id_foreign');
            $table->dropColumn('prioridad_id');
        });
    }
}
