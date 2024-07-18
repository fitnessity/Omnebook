<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiredDurationContractDateUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->string('expired_duration')->index('expired_duration')->nullable();
            $table->date('contract_date')->index('contract_date')->nullable();
            $table->date('bookedtime')->nullable()->change();
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
            $table->dropColumn('expired_duration');
            $table->dropColumn('contract_date');
            $table->dropColumn('bookedtime');
        });
    }
}
