<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_integrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('business_id');
            $table->string('log_textcolor')->nullable();
            $table->string('log_bg_color')->nullable();
            $table->string('logo')->nullable();
            $table->string('reg_textcolor')->nullable();
            $table->string('reg_bg_color')->nullable();
            $table->string('background_img')->nullable();
            $table->string('default_country')->nullable();
            $table->string('default_state')->nullable();
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
        Schema::dropIfExists('website_integrations');
    }
}
