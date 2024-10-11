<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurringFeeToUserBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {

            $table->decimal('subtotal', 8, 2);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('tip', 8, 2)->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('fitnessity_fee', 8, 2)->default(0);
        });
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
            $table->dropColumn('subtotal');
            $table->dropColumn('tax');
            $table->dropColumn('tip');
            $table->dropColumn('discount');
            $table->dropColumn('fitnessity_fee');
        });
    }
}
