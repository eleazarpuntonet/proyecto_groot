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
        $data    = Autorizaciones::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/AutorizacionSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/AutorizacionSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('autorizaciones');
    }
}
