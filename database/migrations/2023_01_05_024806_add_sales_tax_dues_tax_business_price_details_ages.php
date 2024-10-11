<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalesTaxDuesTaxBusinessPriceDetailsAges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details_ages',function(Blueprint $table){
            $table->string('sales_tax')->nullable()->after('category_title');
            $table->string('dues_tax')->nullable()->after('category_title');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_price_details_ages',function(Blueprint $table){
            Schema::dropIfExists('sales_tax');
            Schema::dropIfExists('dues_tax');
        });
    }
}
