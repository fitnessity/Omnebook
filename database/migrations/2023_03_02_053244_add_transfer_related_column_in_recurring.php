<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferRelatedColumnInRecurring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recurring', function (Blueprint $table) {
            $table->string('provider_transaction_id')->nullable()->after('status');
            $table->decimal('provider_amount',15,2)->nullable()->default(0.00)->after('provider_transaction_id');
            $table->string('transfer_provider_status')->default('unpaid')->after('provider_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recurring', function (Blueprint $table) {
            Schema::dropIfExists('provider_transaction_id');
            Schema::dropIfExists('provider_amount');
            Schema::dropIfExists('transfer_provider_status');
        });
    }
}
