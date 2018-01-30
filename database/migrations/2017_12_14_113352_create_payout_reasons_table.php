<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_reasons', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
            $table->string('payout_reason');
            $table->string('short_reason');
            $table->text('reason_description');
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
        Schema::dropIfExists('payout_reasons');
    }
}
