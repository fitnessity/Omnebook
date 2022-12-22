<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildToActivityCancel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_cancel', function (Blueprint $table) {
            $table->boolean('cancel_date_chk')->default(0);
            $table->boolean('act_cancel_chk')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_cancel', function (Blueprint $table) {
            $table->boolean('cancel_date_chk')->default(0);
            $table->boolean('act_cancel_chk')->default(1);
        });
    }
}
