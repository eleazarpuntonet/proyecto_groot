<?php
use App\Databasket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabasketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_databasket', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('tobasket');
            $table->string('key');
            $table->text('data');
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
        $data = Databasket::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        // file_put_contents(base_path('database/dataseed/DatabasketSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('_databasket');
    }
}
