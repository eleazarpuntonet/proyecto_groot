<?php
use App\Notificationtests;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
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
        $data = Notificationtests::get();
        $newJson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('database/dataseed/NotificationsSeed.json'), stripslashes($newJson));
        Schema::dropIfExists('notifications');
    }
}
