<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBusinessSubscriptionPlanColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_subscription_plan', function (Blueprint $table) {
            $table->integer('service_fee')->change();
            $table->decimal('site_tax', 8, 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_subscription_plan', function (Blueprint $table) {
            $table->string('service_fee')->change();
            $table->string('site_tax')->change();
        });
    }
}
