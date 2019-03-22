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
            $table->string('cargo')->nullable();
            $table->string('gerencia')->nullable();
            $table->string('sede')->nullable();
            $table->string('sexo')->nullable();
            $table->date('fecha_ing')->nullable();
            $table->string('password');
            $table->string('avatar')->default('/avats/user-default.png');
            $table->string('status')->nullable();
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
        $data    = User::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/UserSeed.json'), stripslashes($newJson));
        file_put_contents(base_path('database/jsondumps/UserSeed-'.date('d_m_Y-H:i').'.json'), stripslashes($newJson));
        Schema::dropIfExists('users');
    }
}
