<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomersDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers_documents', function (Blueprint $table) {
            $table->integer('status')->default(0)->after('path')->comment('0: Not Request,1: Requested, 2: Signed');
            $table->Date('sign_requested_date')->nullable()->after('status');
            $table->string('sign_path',255)->nullable()->after('requested_dates');
            $table->Date('sign_date',255)->nullable()->after('sign_path');
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
