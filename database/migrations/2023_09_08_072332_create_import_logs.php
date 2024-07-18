<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportLogs extends Migration
{
    public function up()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            if (!Schema::hasColumn('company_informations', 'client_skip_logs_url')) {
                $table->string('client_skip_logs_url')->nullable();
            }
            if (!Schema::hasColumn('company_informations', 'client_fail_logs_url')) {
                $table->string('client_fail_logs_url')->nullable();
            }
            if (!Schema::hasColumn('company_informations', 'client_imported_at')) {
                $table->dateTime('client_imported_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('company_informations', function (Blueprint $table) {
            $table->dropColumn(['client_skip_logs_url', 'client_fail_logs_url', 'client_imported_at']);
        });
    }
}