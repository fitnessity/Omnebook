<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserBookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_booking_details', function (Blueprint $table) {
            $table->text('productIds')->nullable()->after('addOnservice_qty');
            $table->text('productQtys')->nullable()->after('productIds');
            $table->text('productTypes')->nullable()->after('productQtys');
            $table->text('productSize')->nullable()->after('productTypes');
            $table->text('productColor')->nullable()->after('productSize');
            $table->text('productTotalPrices')->nullable()->after('productColor');
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
