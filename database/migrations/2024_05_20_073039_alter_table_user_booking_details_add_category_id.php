<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserBookingDetailsAddCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->integer('category_id')->after('user_type')->default(0);
        });

        $userDetails = App\UserBookingDetail::all();

        foreach($userDetails as $detail){
            if($detail->business_price_detail_with_trashed){
                if($detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed){
                    $detail->category_id = $detail->business_price_detail_with_trashed->business_price_details_ages_with_trashed->id;
                    $detail->save();
                } 
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
    }
}
