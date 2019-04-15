<?php
use App\Tableauthrole;
use App\Tableassgnauthrole;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAuthRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('path_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pathitem_id');
            $table->string('pathitem_name');
            $table->string('pathitem_desc');
            $table->timestamps();
        });

        Schema::create('pathitems_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pathitem_id');
            $table->string('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $data    = Tableauthrole::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/PathItemSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/PathItemSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));

        $data    = Tableassgnauthrole::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/PathAssignSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/PathAssignSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));

        Schema::dropIfExists('path_items');
        Schema::dropIfExists('pathitems_roles');
    }
}
