<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_details', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
            $table->integer('depot_id')->unsigned();
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('crew');
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
        Schema::dropIfExists('crew_details');
    }
}
