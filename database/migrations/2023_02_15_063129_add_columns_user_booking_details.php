<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->date('refund_date')->nullable();
            $table->double('refund_amount')->nullable();
            $table->string('refund_method',255)->nullable();
            $table->longText('refund_comment')->nullable();

            $table->date('suspend_started')->nullable();
            $table->date('suspend_ended')->nullable();
            $table->double('suspend_fee')->nullable();
            $table->longText('suspend_reason')->nullable();
            $table->longText('suspend_comment')->nullable();

            $table->double('terminate_fee')->nullable();
            $table->date('terminated_at')->nullable();
            $table->longText('terminate_reason')->nullable();
            $table->longText('terminate_comment')->nullable();
        });
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
