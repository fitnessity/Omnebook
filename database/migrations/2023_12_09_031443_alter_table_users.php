<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('website',255)->nullable()->after('profile_pic');
            $table->string('twitter',255)->nullable()->after('website');
            $table->string('insta',255)->nullable()->after('twitter');
            $table->string('facebook',255)->nullable()->after('insta');
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
