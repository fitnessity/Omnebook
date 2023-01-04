<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableBookingCheckinDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_checkin_details', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('booking_id');  
            $table->integer('order_detail_id');
            $table->boolean('checkin')->default(0);
            $table->date('checkin_date')->nullable();
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
        Schema::create('booking_checkin_details', function (Blueprint $table){
            Schema::dropIfExists('booking_checkin_details');
        });
    }
}
