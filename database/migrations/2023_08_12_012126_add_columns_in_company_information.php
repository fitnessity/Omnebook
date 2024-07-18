<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInCompanyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            $table->integer('customer_uploading')->after('business_added_by_cust_name')->default(0);
            $table->integer('membership_uploading')->after('customer_uploading')->default(0);
            $table->integer('attendance_uploading')->after('membership_uploading')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            //
        });
    }
}
