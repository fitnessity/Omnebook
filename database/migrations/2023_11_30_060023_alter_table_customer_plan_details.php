<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCustomerPlanDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_plan_details', function (Blueprint $table) {
            $table->string('invoice_no',255)->nullable()->after('id');
            $table->string('payment_for',255)->nullable()->after('expire_date');
            $table->double('price')->default(0)->after('payment_for');
            $table->double('discount')->default(0)->after('price');
            $table->string('promo_code_id')->nullable()->after('discount');
            $table->string('promo_code_name')->nullable()->after('promo_code_id');
            $table->string('payment_id',255)->nullable()->after('promo_code_name');
            $table->text('payload')->nullable()->after('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_plan_details', function (Blueprint $table) {
            //
        });
    }
}
