<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSomeColumnFromBusinessActivityScheduler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_activity_scheduler', function (Blueprint $table) {
            $table->dropColumn(['schedule_until','sales_tax','sales_tax_percent','dues_tax','dues_tax_percent']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_activity_scheduler', function (Blueprint $table) {
            //
        });
    }
}
