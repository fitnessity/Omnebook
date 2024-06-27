<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_checkin_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(0);
            $table->integer('business_id')->default(0);
            $table->string('welcome_screen_color',255)->default('#ea1515');
            $table->string('digit_screen_color',255)->default('#ea1515');
            $table->string('alert_screen_color',255)->default('#ea1515');
            $table->string('logo',255)->nullable();
            $table->string('customer_return_back_time',255)->nullable();
            $table->string('welcome_cover_photo',255)->nullable();
            $table->string('passcode_cover_photo',255)->nullable();
            $table->string('alerts_photo',255)->nullable();
            $table->integer('membership_option',255)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('business_checkin_settings');
    }
}
