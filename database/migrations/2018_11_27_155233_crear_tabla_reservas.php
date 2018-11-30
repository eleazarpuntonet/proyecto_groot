<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('alcance');
            $table->string('origen_a');
            $table->string('origen_b');
            $table->string('origen_det');
            $table->dateTime('fecha_partida');
            $table->dateTime('fecha_retorno');
            $table->string('destino_a');
            $table->string('destino_b');
            $table->string('destino_det');
            $table->string('motivo');
            $table->string('agenda');
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
        Schema::dropIfExists('reservas');
    }
}
