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
        Schema::table('customer_notes', function (Blueprint $table) {
            //
            $table->string('type', 255)->after('display_chk')->default('')->nullable(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_notes', function (Blueprint $table) {
            //
            $table->dropColumn('type');

        });
    }
};
