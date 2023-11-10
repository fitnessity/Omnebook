    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableMembershipPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            $table->dropColumn('quote_per_month');
            $table->float('price_per_year',8,2)->nullable()->after('price_per_month');
            $table->string('image')->nullable()->after('price_per_year');
            $table->string('feature_ids')->nullable()->after('image');
            $table->string('heading')->nullable()->after('feature_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            //
        });
    }
}
