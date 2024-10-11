<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCompanyRevenueGoalTraacker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_revenue_goal_tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('company_informations')->onDelete('cascade');
            $table->string('year',255);
            $table->double('jan_goal')->default(0);
            $table->double('feb_goal')->default(0);
            $table->double('mar_goal')->default(0);
            $table->double('apr_goal')->default(0);
            $table->double('may_goal')->default(0);
            $table->double('jun_goal')->default(0);
            $table->double('jul_goal')->default(0);
            $table->double('aug_goal')->default(0);
            $table->double('sep_goal')->default(0);
            $table->double('oct_goal')->default(0);
            $table->double('nov_goal')->default(0);
            $table->double('dec_goal')->default(0);
            $table->double('yearly_total_goal')->default(0);
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
        Schema::dropIfExists('company_revenue_goal_tracker');
    }
}
