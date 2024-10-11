<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeInBusinessPriceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details', function (Blueprint $table) {
           $table->string('recurring_price_adult')->default('0')->change();
           $table->string('recurring_price_child')->default('0')->change();
           $table->string('recurring_price_infant')->default('0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_price_details', function (Blueprint $table) {
            //
        });
    }
}
