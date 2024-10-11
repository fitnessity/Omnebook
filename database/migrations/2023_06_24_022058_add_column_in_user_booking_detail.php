<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUserBookingDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->string('repeateTimeType')->nullable()->after('fitnessity_fee');
            $table->integer('everyWeeks')->nullable()->after('repeateTimeType');
            $table->integer('monthDays')->nullable()->after('everyWeeks');
            $table->date('enddate')->nullable()->after('monthDays');
            $table->string('activity_days')->nullable()->after('enddate');
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
        });
    }
}
