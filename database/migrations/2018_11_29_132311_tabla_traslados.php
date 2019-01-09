<?php
use App\Traslados;
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
            $table->string('localidad')->nullable();//Origen //Destino
            $table->string('tipo')->nullable();//Terrestre,Aereo
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->string('hora')->nullable();
            $table->string('descripcion')->nullable();//Taxi, bus, avion, automovil
            $table->integer('proveedor')->nullable();
            $table->integer('session')->nullable();
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
        $data = Traslados::all();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/TrasladoSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('traslados');
    }
}
