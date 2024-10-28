<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('business_price_details', function (Blueprint $table) {
            //
            $table->integer('visibility_to_public')->default(1)->after('serviceid');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_price_details', function (Blueprint $table) {
            //
            $table->dropColumn('visibility_to_public');

        });
    }
};
