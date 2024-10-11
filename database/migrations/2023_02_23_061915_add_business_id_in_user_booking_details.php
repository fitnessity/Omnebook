<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\UserBookingDetail;

class AddBusinessIdInUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->integer('business_id')->after('sport');
        });

        $user_booking_details = UserBookingDetail::all();
        foreach($user_booking_details as $user_booking_detail){
            if($user_booking_detail->sport){
                UserBookingDetail::where('id',$user_booking_detail->id)->update([
                    'business_id' => $user_booking_detail->business_services->cid
                ]);   
            }
             
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
