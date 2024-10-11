<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->string('username',255);
            $table->string('password',255);
            $table->string('buddy_key',255);
            $table->string('email',255);
            $table->string('gender',255);
            $table->string('phone_number',255);
            $table->string('profile_pic',255);
            $table->string('website',255);
            $table->string('twitter',255);
            $table->string('insta',255);
            $table->string('facebook',255);
            $table->string('address',255);
            $table->string('city',255);
            $table->string('state',255);
            $table->string('country',255);
            $table->string('zipcode',255);
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
        Schema::dropIfExists('admin');
    }
}
