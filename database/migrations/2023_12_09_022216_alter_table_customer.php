<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('terms_sign_path',255)->nullable()->after('terms_contract');
            $table->string('contract_sign_path',255)->nullable()->after('terms_sign_path');
            $table->string('liability_sign_path',255)->nullable()->after('contract_sign_path');
            $table->string('covid_sign_path',255)->nullable()->after('liability_sign_path');
            $table->string('refund_sign_path',255)->nullable()->after('covid_sign_path');
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
