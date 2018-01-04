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
             $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('password');
            $table->bigInteger('mobile');
            $table->date('date_of_birth');
            $table->string('image_path');
            
            $table->string('set_password_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
