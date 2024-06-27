<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAnnouncementContactCustomerListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('announcement_contact_customer_list', function (Blueprint $table) {
            $table->boolean('is_sent')->after('contact_list_id')->default(false);
            $table->boolean('is_opened_email')->after('is_sent')->default(false);
            $table->boolean('is_opened_sms')->after('is_opened_email')->default(false);
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
