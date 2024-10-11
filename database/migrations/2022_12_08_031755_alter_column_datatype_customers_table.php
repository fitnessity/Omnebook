<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnDatatypeCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('profile_pic')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->date('birthdate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('profile_pic')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->date('birthdate')->nullable(false)->change();
        });
    }
}
