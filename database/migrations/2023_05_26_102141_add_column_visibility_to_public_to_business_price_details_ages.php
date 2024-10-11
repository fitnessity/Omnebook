<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVisibilityToPublicToBusinessPriceDetailsAges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details_ages', function (Blueprint $table) {
             $table->integer('visibility_to_public')->default(1)->after('sales_tax');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_price_details_ages', function (Blueprint $table) {
            //
        });
    }
}
