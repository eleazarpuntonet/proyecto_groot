<?php
use App\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->text('description')->nullable();
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
        $data = Role::all();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/RoleSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('roles');
    }
}