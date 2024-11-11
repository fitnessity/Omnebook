<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToBusinessTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_terms', function (Blueprint $table) {
            //
            $table->tinyInteger('cancellation_delete')->default(0)->comment('1: deleted, 0: not deleted')->nullable();
            $table->tinyInteger('liability_delete')->default(0)->comment('1: deleted, 0: not deleted')->nullable();
            $table->tinyInteger('refund_delete')->default(0)->comment('1: deleted, 0: not deleted')->nullable();
            $table->tinyInteger('terms_delete')->default(0)->comment('1: deleted, 0: not deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_terms', function (Blueprint $table) {
            //
            $table->dropColumn('cancellation_delete');
            $table->dropColumn('liability_delete');
            $table->dropColumn('refund_delete');
            $table->dropColumn('terms_delete');
        });
    }
}
