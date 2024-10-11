<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAnnouncementAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('announcement', function (Blueprint $table) {
            $table->text('sms_text')->after('announcement')->nullable();
            $table->string('delivery_timeline',255)->after('sms_text')->nullable();
            $table->string('delivery_method')->after('delivery_timeline')->nullable();
            $table->integer('delivery_method_sms')->default(0)->after('delivery_method');
            $table->integer('delivery_method_email')->default(0)->after('delivery_method_sms');
            $table->integer('delivery_method_push_notification')->default(0)->after('delivery_method_email');
            $table->integer('send_sms_push_not_available')->default(0)->after('delivery_method_push_notification');
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
