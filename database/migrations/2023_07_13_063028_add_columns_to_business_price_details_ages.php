<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBusinessPriceDetailsAges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details_ages', function (Blueprint $table) {
            $table->string('service_name')->nullable()->after('visibility_to_public');
            $table->double('service_price',2)->nullable()->after('service_name');
            $table->text('service_description')->nullable()->after('service_price');
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
