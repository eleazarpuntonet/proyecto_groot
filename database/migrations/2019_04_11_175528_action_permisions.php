<?php
use App\Permisos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActionPermisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_permisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_id');
            $table->string('ruta_id');
            $table->string('action_id');
            $table->string('lee');
            $table->string('escribe');
            $table->string('modifica');
            $table->string('borra');
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
        $data    = Permisos::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        $nameFile = 'PermisosSeed';
        file_put_contents(base_path('database/dataseed/'.$nameFile.'.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/'.$nameFile.'-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('action_permisions');
    }
}