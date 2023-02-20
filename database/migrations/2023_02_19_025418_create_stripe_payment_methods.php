<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripePaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_payment_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type');
            $table->integer('user_id');
            $table->string('pay_type');
            $table->string('payment_id');
            $table->string('exp_month');
            $table->string('exp_year');
            $table->string('last4');
            $table->boolean('primary')->default(false);
            $table->index('user_type', 'user_id');
            $table->index('pay_type');
            $table->index('payment_id');
            $table->index('primary');

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
        Schema::dropIfExists('stripe_payment_methods');
    }
}
