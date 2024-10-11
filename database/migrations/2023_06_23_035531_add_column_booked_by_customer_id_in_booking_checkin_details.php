<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\{BookingCheckinDetails,Customer};

class AddColumnBookedByCustomerIdInBookingCheckinDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table) {
            $table->integer('booked_by_customer_id')->after('business_activity_scheduler_id');
        });
        $chkInDetails =  BookingCheckinDetails::all();
        foreach($chkInDetails as $chkd){
            if($chkd->booking_detail_id && $chkd->UserBookingDetail != ''){
                $statusData = $chkd->UserBookingDetail->userBookingStatus;
                if($statusData != ''){
                    if($statusData->user_type == 'customer'){
                        $customer = Customer::where(['business_id'=>$chkd->UserBookingDetail->business_id, 'user_id'=>$statusData->user_id])->first();
                        $id = @$customer->id;
                    }else{
                        $id= $chkd->UserBookingDetail->user_id;
                    }
                }
            }
            $id = $id != '' ? $id : 0;
            BookingCheckinDetails::where('id',$chkd->id)->update(['booked_by_customer_id' => $id]);    
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table) {
            //
        });
    }
}
