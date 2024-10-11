<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementContactList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_contact_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id')->default(0);
            $table->unsignedBigInteger('announcement_id')->default(0);
            $table->string('list_name')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->foreign('announcement_id')->references('id')->on('announcement')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_contact_list');
    }
}
