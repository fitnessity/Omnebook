<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWebsiteIntegrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('website_integrations', function (Blueprint $table) {
            //
            $table->string('reg_back_color')->nullable();
            $table->string('schedule_back_color')->nullable();
            $table->string('schedule_label_color')->nullable();
            $table->string('date_color')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_integration', function (Blueprint $table) {
            //
        });
    }
}
