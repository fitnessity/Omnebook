<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSourceTypeBookingCheckinDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table){
            $table->string('source_type')->after('checkin_date');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_checkin_details', function(Blueprint $table){
            Schema::dropIfExists('source_type');
        });
    }
}
