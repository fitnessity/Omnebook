<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id')->unsigned();
            $table->string('fname',255);
            $table->string('lname',255);
            $table->string('username',255);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('email',100);
            $table->string('phone_number',20);
            $table->string('profile_pic',255);
            $table->string('address',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('zipcode',255)->nullable();
            $table->string('password',255)->nullable();
            $table->boolean('status')->default(0);
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
         Schema::dropIfExists('customers');
    }
}
