<?php
use App\ActionsAuth;
use App\actions_roles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAuthActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action_id');
            $table->string('action_name');
            $table->string('action_desc');
            $table->string('action_permissions');
            $table->timestamps();
        });

        Schema::create('authactions_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action_id');
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
        $data    = ActionsAuth::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/ActionsauthSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/ActionsauthSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));

        $data    = actions_roles::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/ActionsrolesSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/ActionsrolesSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));

        Schema::dropIfExists('auth_actions');
        Schema::dropIfExists('authactions_roles');
    }
}
