<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCompanyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            $table->string('sales_tax',255)->after('user_id')->nullable();
            $table->string('dues_tax',255)->after('sales_tax')->nullable();
            $table->text('born')->nullable();
            $table->text('about_host')->nullable();
            $table->string('years_of_experience',45)->nullable();
            $table->string('years_of_hosting',45)->nullable();
            $table->string('owner_pic',255)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
