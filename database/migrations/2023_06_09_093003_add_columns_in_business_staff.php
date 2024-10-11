<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInBusinessStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_staff', function (Blueprint $table) {
            $table->string('gender')->after('password')->nullable();
            $table->text('address')->after('gender')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->string('postcode')->after('state')->nullable();
            $table->date('birthdate')->after('postcode')->nullable();
            $table->string('status')->after('birthdate')->default('active');
            $table->text('bio')->change();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_staff', function (Blueprint $table) {
            //
        });
    }
}
