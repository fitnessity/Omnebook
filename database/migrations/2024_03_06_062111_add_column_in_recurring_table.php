<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInRecurringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recurring', function (Blueprint $table) {
            if (!Schema::hasColumn('recurring', 'error_msg')) {
                $table->text('error_msg')->nullable()->after('stripe_payment_id');
            }
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
            $table->dropColumn('error_msg');
        });
    }
}
