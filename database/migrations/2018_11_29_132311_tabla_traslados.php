<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaTraslados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservas_id');
            $table->integer('localidad')->nullable();//Origen //Destino
            $table->string('tipo');//Terrestre,Aereo
            $table->string('origen');
            $table->string('destino');
            $table->string('servicio');//Taxi, bus, avion, automovil
            $table->integer('proveedor');
            $table->integer('session');
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
        Schema::dropIfExists('traslados');
    }
}
