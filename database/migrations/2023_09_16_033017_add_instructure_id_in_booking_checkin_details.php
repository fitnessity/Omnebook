<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\BookingCheckinDetails;
use App\UserBookingDetail;

class AddInstructureIdInBookingCheckinDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table) {
             $table->integer('instructor_id')->after('customer_id')->nullable();
        });

        $chkInDetails = BookingCheckinDetails::all();
        foreach($chkInDetails as $chkd){
            $userBookingDetail = UserBookingDetail::find($chkd->booking_detail_id);
            $instructor_id = @$userBookingDetail->business_services != '' ? @$userBookingDetail->business_services->instructor_id : NULL;
            
            $chkd->update(['instructor_id' => $instructor_id]);
        }
        exit;
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
