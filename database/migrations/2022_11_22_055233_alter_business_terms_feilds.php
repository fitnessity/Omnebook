<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBusinessTermsFeilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_terms', function (Blueprint $table) {
            $table->longText('houserules')->change();
            $table->longText('cancelation')->change();
            $table->longText('cleaning')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('business_terms', function (Blueprint $table) {
            $table->string('houserules')->change();
            $table->string('cancelation')->change();
            $table->string('cleaning')->change();
             
        });*/
    }
}
