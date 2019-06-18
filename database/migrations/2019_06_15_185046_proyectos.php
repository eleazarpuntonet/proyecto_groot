<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('nombre');
                    $table->string('status');
                    $table->string('presupuesto_bsf');
                    $table->string('presupuesto_usd');
                    $table->string('precio_venta_sb');
                    $table->string('precio_venta_usd');
                    $table->string('factibilidad');
                    $table->string('descripcion');
                    $table->text('value');
                    $table->timestamps();
                });

        Schema::create('proy_participantes', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('proy_id');
                    $table->string('user_id');
                    $table->string('rol_proyecto');
                    $table->timestamps();
                });

        Schema::create('proy_contact', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('proy_id');
                    $table->string('contacto_id');
                    $table->timestamps();
                });

        Schema::create('proy_empresa', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('proy_id');
                    $table->string('empresa_id');
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
        Schema::dropIfExists('proyectos');
        Schema::dropIfExists('proy_participantes');
        Schema::dropIfExists('proy_contact');
        Schema::dropIfExists('proy_empresa');
    }
}
