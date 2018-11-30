<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');//Terrestre,Aereo
            $table->string('r_social');
            $table->string('rif')->nullable();
            $table->string('t_contribuyente')->nullable();//Taxi, bus, avion, automovil
            $table->dateTime('dir')->nullable();
            $table->dateTime('session');
            $table->string('autor')->nullable();
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
        Schema::dropIfExists('proveedores_');
    }
}
