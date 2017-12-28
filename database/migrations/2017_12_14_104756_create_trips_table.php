<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes');
            $table->integer('duty_id')->unsigned();
            $table->foreign('duty_id')->references('id')->on('duties');
            $table->integer('shift_id')->unsigned();
            $table->foreign('shift_id')->references('id')->on('routes');
            $table->string('devited_route');
            $table->string('devited_path');
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
        Schema::dropIfExists('trips');
    }
}
