<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripCollectionReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_collection_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->text('trip_cancel_reason');
            $table->text('short_reason');
            $table->text('reason_description');
            $table->string('trip_cancel_reason_category');
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
        Schema::dropIfExists('trip_collection_reasons');
    }
}
