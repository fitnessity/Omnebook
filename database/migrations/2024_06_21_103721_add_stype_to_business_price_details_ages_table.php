<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStypeToBusinessPriceDetailsAgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_price_details_ages', function (Blueprint $table) {
            //
            $table->integer('stype')->default(0)->after('service_description');

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
            $table->dropColumn('stype');

        });
    }
}


