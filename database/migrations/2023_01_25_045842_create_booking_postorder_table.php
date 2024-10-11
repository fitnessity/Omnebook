<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPostorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_postorders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_activity_scheduler_id');
            $table->integer('customer_id');
            $table->datetime('booked_at');

            $table->timestamps();
            $table->index('business_activity_scheduler_id');
            $table->index('customer_id');
            $table->index('booked_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_postorders');
    }
}
