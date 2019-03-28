<?php

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
        Schema::dropIfExists('path_items');
        Schema::dropIfExists('pathitems_roles');
    }
}
