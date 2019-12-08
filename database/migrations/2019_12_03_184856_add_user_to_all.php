<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });

        Schema::table('fases', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });

        Schema::table('fabricantes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });

        Schema::table('equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->dropForeign('insumos_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->dropForeign('cargos_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('trabajadors', function (Blueprint $table) {
            $table->dropForeign('trabajadors_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('fases', function (Blueprint $table) {
            $table->dropForeign('fases_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('fabricantes', function (Blueprint $table) {
            $table->dropForeign('fabricantes_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('equipos', function (Blueprint $table) {
            $table->dropForeign('equipos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
