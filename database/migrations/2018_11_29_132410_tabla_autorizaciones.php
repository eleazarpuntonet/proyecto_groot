<?php
use App\Autorizaciones;
use App\Reservas;

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
            $table->string('recurso')->nullable();
            $table->string('valor')->nullable();
            $table->string('date_auth')->nullable();
            $table->string('depto_id')->nullable();
            $table->string('reserva_id')->nullable();
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
        $data = Reservas::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/ReservasSeed.json'), stripslashes($newJson));

        $data = Autorizaciones::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/AutorizacionesSeed.json'), stripslashes($newJson));
        
        Schema::dropIfExists('autorizaciones');
    }
}
