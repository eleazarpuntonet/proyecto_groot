<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requisiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisiciones', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('nombre');
                    $table->string('gerencia');
                    $table->string('sede');
                    $table->string('subservicio');
                    $table->string('ceco');
                    $table->string('prioridad');
                    $table->string('fecha_est_entrega');
                    $table->string('motivo');
                    $table->string('dire_entrega');
                    $table->string('status');
                    $table->text('value');
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
        Schema::dropIfExists('requisiciones');
    }
}
