<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('nombre');
                    $table->string('descripcion');
                    $table->string('user_from');
                    $table->string('user_to');
                    $table->string('tipo');
                    $table->string('fecha_ejecucion');
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
        Schema::dropIfExists('tareas');
    }
}
