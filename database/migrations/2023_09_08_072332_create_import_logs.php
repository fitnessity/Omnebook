<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            $table->string('client_skip_logs_url')->nullable();
            $table->string('client_fail_logs_url')->nullable();
            $table->dateTime('client_imported_at')->nullable();
        });
    }
}
