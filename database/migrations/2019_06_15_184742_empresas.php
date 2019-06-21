<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terceros', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('razon_social');
                    $table->string('nombre');
                    $table->string('rif');
                    $table->string('ciudad');
                    $table->string('pais');
                    $table->timestamps();
                });
        Schema::create('terceros_tipo', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('nombre');
                    $table->string('descripcion');
                    $table->timestamps();
                });
        Schema::create('terc_tipopivot', function (Blueprint $table) {
                    $table->integer('id_terceros');
                    $table->integer('id_terceros_tipo');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terceros');
        Schema::dropIfExists('terceros_tipo');
        Schema::dropIfExists('terc_tipopivot');
    }
}
