<?php
use App\Viaticos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViaticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viaticos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_reserva')->nullable();
            $table->string('rubro')->nullable();
            $table->integer('cantidad')->nullable();
            $table->float('val_unit')->nullable();
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
        $data    = Viaticos::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/ViaticoSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/ViaticoSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('viaticos');
    }
}
