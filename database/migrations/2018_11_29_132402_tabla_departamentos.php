<?php
use App\Departamentos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDepartamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('disp_name');
            $table->string('descripcion')->nullable();
            $table->string('ceco')->nullable();
            $table->string('gerente_id')->nullable();
            $table->string('coordinador_id')->nullable();
            $table->string('dependencia')->nullable();
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
        $data    = Departamentos::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/DepartamentoSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/DepartamentoSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('departamentos');
    }
}
