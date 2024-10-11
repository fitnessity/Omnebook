<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToUserbookingstatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_status', function (Blueprint $table) {
            $table->string('pmt_method',255)->nullable();
            $table->longText('pmt_json')->nullable();
            $table->string('retrun_cash',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_booking_status', function (Blueprint $table) {
            $table->dropColumn('pmt_method');
            $table->dropColumn('pmt_json');
            $table->dropColumn('retrun_cash');
        });
    }
}
