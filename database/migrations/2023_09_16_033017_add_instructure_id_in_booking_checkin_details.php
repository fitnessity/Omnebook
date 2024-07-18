<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\BookingCheckinDetails;
use App\UserBookingDetail;
use Illuminate\Support\Facades\Log;

class AddInstructureIdInBookingCheckinDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('booking_checkin_details', 'instructor_id')) {
            Schema::table('booking_checkin_details', function (Blueprint $table) {
                $table->integer('instructor_id')->after('customer_id')->nullable();
            });
        }

        // Update existing records
        $chkInDetails = BookingCheckinDetails::all();
        foreach($chkInDetails as $chkd){
            try {
                $userBookingDetail = UserBookingDetail::findOrFail($chkd->booking_detail_id);
                $instructor_id = $userBookingDetail->business_services->instructor_id ?? null;
                
                $chkd->update(['instructor_id' => $instructor_id]);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::error("UserBookingDetail with ID {$chkd->booking_detail_id} not found for BookingCheckinDetails ID {$chkd->id}");
            } catch (\Exception $e) {
                Log::error("Error updating BookingCheckinDetails ID {$chkd->id}: " . $e->getMessage());
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
        if (Schema::hasColumn('booking_checkin_details', 'instructor_id')) {
            Schema::table('booking_checkin_details', function (Blueprint $table) {
                $table->dropColumn('instructor_id');
            });
        }
    }
}
