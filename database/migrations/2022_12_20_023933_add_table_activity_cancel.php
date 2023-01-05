<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableActivityCancel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_cancel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schedule_id')->unsigned();
            $table->date('cancel_date')->nullable();
            $table->boolean('show_cancel_on_schedule')->default(0);
            $table->boolean('hide_cancel_on_schedule')->default(0);
            $table->boolean('email_Instructor')->default(0);
            $table->boolean('email_clients')->default(0);
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
        Schema::dropIfExists('activity_cancel');
    }
}
