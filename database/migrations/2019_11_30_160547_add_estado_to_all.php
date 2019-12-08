<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoToAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('fases', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('insumos', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('departamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });

        Schema::table('fabricantes', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id'); // Relación con estado
            $table->foreign('estado_id')->references('id')->on('estados'); // clave foranea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('fases', function (Blueprint $table) {
            $table->dropForeign('fases_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->dropForeign('cargos_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->dropForeign('trabajadors_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('insumos', function (Blueprint $table) {
            $table->dropForeign('insumos_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign('departamentos_estado_id_foreign');
            $table->dropColumn('estado_id');
        });

        Schema::table('fabricantes', function (Blueprint $table) {
            $table->dropForeign('fabricantes_estado_id_foreign');
            $table->dropColumn('estado_id');
        });
    }
}
