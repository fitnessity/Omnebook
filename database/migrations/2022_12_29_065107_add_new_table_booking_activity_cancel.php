<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableBookingActivityCancel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_activity_cancel', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('booking_id');  
            $table->integer('order_detail_id');
            $table->string('cancel_charge_action');
            $table->string('cancel_charge_amt')->nullable();
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
        Schema::create('booking_activity_cancel', function (Blueprint $table){
            Schema::dropIfExists('booking_activity_cancel');
        });
    }
}
