<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\UserBookingDetail;
use App\BookingCheckinDetails;

class RenameBookingCheckinDetailsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('booking_checkin_details', function (Blueprint $table) {
            $table->integer('order_detail_id')->nullable()->change();
        });

        Schema::table('booking_checkin_details', function (Blueprint $table) {
            $table->dropColumn('booking_id');
            $table->dropColumn('checkin');
            $table->integer('business_activity_scheduler_id')->after('id');
            $table->integer('customer_id')->after('business_activity_scheduler_id');
            $table->renameColumn('order_detail_id', 'booking_detail_id')->nullable()->change();
            
            $table->datetime('checked_at')->after('order_detail_id')->nullable();
            $table->integer('use_session_amount');
            $table->integer('before_use_session_amount');
            $table->integer('after_use_session_amount');
            $table->integer('no_show_action')->nullable();
            $table->integer('no_show_charged')->nullable();

            $table->index('customer_id');
            $table->index('checked_at');
            $table->index('business_activity_scheduler_id');
            
        });

        $user_booking_details = UserBookingDetail::all();

        foreach($user_booking_details as $user_booking_detail){
            if($user_booking_detail->booking->customer && $user_booking_detail->act_schedule_id){
                BookingCheckinDetails::create([
                    'business_activity_scheduler_id' => $user_booking_detail->act_schedule_id,
                    'customer_id' => $user_booking_detail->booking->customer->id,
                    'booking_detail_id' => $user_booking_detail->id,
                    'checkin_date' => date('Y-m-d',strtotime($user_booking_detail->bookedtime)),
                    'use_session_amount' => 0,
                    'before_use_session_amount' => 0,
                    'after_use_session_amount' => 0
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
        //
        Schema::dropIfExists('booking_checkin_details');

        Schema::create('booking_checkin_details', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('booking_id');  
            $table->integer('order_detail_id');
            $table->boolean('checkin')->default(0);
            $table->date('checkin_date')->nullable();
            $table->timestamps();
        });
    }
}
