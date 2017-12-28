<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route');
            $table->string('path');
            $table->string('direction');
            $table->string('default_path');
            $table->text('stops');
            $table->integer('stop_id')->unsigned();
            $table->foreign('stop_id')->references('id')->on('stops');
            $table->integer('stage_number');
            $table->float('distance');
            $table->integer('hot_key');
            $table->boolean('is_this_by');
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
        Schema::dropIfExists('routes');
    }
}
