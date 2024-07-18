<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripeConnectionFeildInCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
             $table->string('card_stripe_id',255)->nullable();
            $table->string('card_token_id',255)->nullable();
            $table->string('stripe_customer_id',255)->nullable();
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
             $table->string('card_stripe_id',255)->nullable();
            $table->string('card_token_id',255)->nullable();
            $table->string('stripe_customer_id',255)->nullable();
        });
    }
}
