<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUserBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->string('transfer_provider_status', 30)->nullable()->after('payment_number');
			$table->double('provider_amount', 15,2)->nullable()->after('transfer_provider_status');
			$table->string('provider_transaction_id', 30)->nullable()->after('provider_amount');
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
            $table->dropColumn('transfer_provider_status');
			$table->dropColumn('provider_amount');
			$table->dropColumn('provider_transaction_id');
			
        });
    }
}
