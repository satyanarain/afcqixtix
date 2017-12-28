<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('passprovider');
            $table->string('passtype');
            $table->text('description');
            $table->text('short_description');
            $table->string('ammount');
            $table->string('validity_message');
            $table->string('accept_gender');
            $table->integer('accept_age');
            $table->date('accept_age_from');
            $table->date('accept_age_to');
            $table->integer('accept_spouse_age');
            $table->date('accept_spouse_age_from');
            $table->date('accept_spouse_age_to');
            $table->boolean('accept_id_number');
            $table->integer('order_number');
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
        Schema::dropIfExists('pass_types');
    }
}
