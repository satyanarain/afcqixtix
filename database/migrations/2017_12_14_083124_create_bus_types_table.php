<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_types', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
            $table->string('bus_type');
            $table->string('abbreviation');
            $table->string('order_number');
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
        Schema::dropIfExists('bus_types');
    }
}
