<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableCustomersFamilyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_family_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cus_id')->unsigned();
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',100)->nullable();
            $table->string('mobile',255)->nullable();
            $table->string('emergency_contact',255)->nullable();
            $table->string('emergency_contact_name',255)->nullable();
            $table->string('relationship',255)->nullable();
            $table->string('gender',255)->nullable();
            $table->date('birthday')->nullable();
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
        Schema::dropIfExists('customers_family_details');
    }
}
