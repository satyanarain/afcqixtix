<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concessions', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
             $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('concession_provider');
            $table->string('concession');
            $table->text('description');
            $table->integer('order_number');
            $table->string('percentage');
            $table->string('pass_type');
            $table->string('print_ticket');
            $table->string('etm_hot_key');
            $table->date('concession_allowed_on');
            $table->string('flat_fare');
            $table->string('flat_fare_ammount');
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
        Schema::dropIfExists('concessions');
    }
}
