<?php
use App\AssignedTableRoles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssignedRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->integer('role_id');
            // $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $data    = AssignedTableRoles::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/AssignedTableRolesSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/AssignedTableRolesSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('assigned_roles');
    }
}
