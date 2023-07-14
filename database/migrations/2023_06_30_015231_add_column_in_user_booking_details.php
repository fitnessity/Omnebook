<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddColumnInUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->string('booking_from')->after('activity_days')->nullable();
            $table->integer('booking_from_id')->after('booking_from')->nullable();
            $table->string('order_from')->after('booking_from_id')->nullable();
            $table->string('calendar_booking_time')->after('order_from')->nullable();
        });

        
        $userBookingDetails =  App\UserBookingDetail::all();
        foreach($userBookingDetails as $ubd){
            $order_type = '';
            $statusData = $ubd->userBookingStatus;
            $order_type = $statusData != '' ? ($statusData->user_type == 'customer' ? 'Checkout Register' : 'Instant Hire') : '';
        
            $service = $ubd->business_services;
            $booking_from_id = @$service->instructor_id != '' ? @$service->instructor_id : @$statusData->user_id;
            $booking_from =  @$service->instructor_id != '' ? 'Staff Member': 'Provider';

            App\UserBookingDetail::where('id',$ubd->id)->update(['order_from' => $order_type , 'booking_from_id' => $booking_from_id , 'booking_from' =>$booking_from]); 
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
