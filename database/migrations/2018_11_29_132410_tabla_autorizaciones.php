<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAutorizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autorizable_id')->nullable();
            $table->string('autorizable_type')->nullable();
            $table->string('tipo');
            $table->string('date_auth');
            $table->string('depto_id');
            $table->string('reserva_id');
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
        Schema::dropIfExists('autorizaciones');
    }
}
