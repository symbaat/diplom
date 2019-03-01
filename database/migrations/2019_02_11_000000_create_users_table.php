<?php

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
            $table->unsignedInteger('role_id');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('surname');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->boolean('gender');                  // 1 => male, 2 => female
            $table->string('address');
            $table->string('image')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone_number')->nullable();

            $table->unsignedInteger('group_id')->nullable();
            $table->string('parent_name')->nullable();

            $table->string('device_token')->nullable();

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
