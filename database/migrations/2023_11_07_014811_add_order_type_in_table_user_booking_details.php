<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\UserBookingDetail;

class AddOrderTypeInTableUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->string('order_type',255)->nullabel()->after('qty');
        });

        $user_booking_details = UserBookingDetail::all();
        foreach($user_booking_details as $user_booking_detail){
            $user_booking_detail->update(['order_type' => 'Membership']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            //
        });
    }
}
