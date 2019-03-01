<?php
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('codigo_empleado')->unique()->nullable();
            $table->string('ci_usuario')->unique()->nullable();
            $table->string('cargo');
            $table->integer('gerencia');
            $table->string('sede');
            $table->string('password');
            $table->string('avatar')->default('/avats/user-default.png');
            $table->string('status');
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at')->nullable();
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

        $data = User::all();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/UserSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('users');
    }
}
