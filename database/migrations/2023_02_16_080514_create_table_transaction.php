<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type')->comment('user ,customer')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('item_type',255)->nullable();
            $table->string('channel')->default('stripe');            
            $table->string('transaction_id',255)->nullable();
            $table->double('amount')->nullable();
            $table->integer('qty')->nullable();
            $table->enum('status', ['processing', 'complete','refunding','refund_complete'])->nullable();
            $table->double('refund_amount')->nullable();
            $table->longText('payload')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
