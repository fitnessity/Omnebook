<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultOfUserTypeToUserBookingStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_status', function (Blueprint $table) {
            $table->string('user_type')->default('user')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_booking_status', function (Blueprint $table) {
             $table->string('user_type')->default('user')->after('user_id');
        });
    }
}
