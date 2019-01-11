<?php
use App\Reservas;
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
            $table->string('origen_a',60);
            $table->string('origen_b',60);
            $table->string('origen_det',200);
            $table->dateTime('fecha_partida');
            $table->dateTime('fecha_retorno');
            $table->string('destino_a',50);
            $table->string('destino_b',50);
            $table->string('destino_det',200);
            $table->string('motivo',500);
            $table->string('agenda',500);
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

        // $data = Reservas::all();
        // $newJson = json_encode($data, JSON_PRETTY_PRINT);
        // file_put_contents(base_path('database/dataseed/ReservasSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('reservas');
    }
}
