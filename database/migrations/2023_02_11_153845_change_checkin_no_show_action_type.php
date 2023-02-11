<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCheckinNoShowActionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table) {
            $table->text('no_show_action')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_checkin_details', function (Blueprint $table) {
            $table->integer('no_show_action')->change();
        });
    }
}
