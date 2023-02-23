<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInBusinessPriceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details', function (Blueprint $table) {
            $table->string('recurring_customer_chage_by_adult',255)->nullable()->after('recurring_total_contract_revenue_adult');
            $table->string('recurring_customer_chage_by_child',255)->nullable()->after('recurring_total_contract_revenue_child');
            $table->string('recurring_customer_chage_by_infant',255)->nullable()->after('recurring_total_contract_revenue_infant');
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
