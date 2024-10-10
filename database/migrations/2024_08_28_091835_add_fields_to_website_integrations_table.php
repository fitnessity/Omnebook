<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWebsiteIntegrationsTable extends Migration
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
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('font')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_style')->nullable();
            $table->string('filters')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_integrations', function (Blueprint $table) {
            //
        });
    }
}
