<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('business_service_id')->nullable(); // To relate to the service
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->integer('adult')->default(0);
            $table->integer('child')->default(0);
            $table->integer('infant')->default(0);
            $table->integer('actscheduleid');
            $table->string('session_date')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->integer('priceid')->default(0);     
            $table->integer('participate')->nullable(); // Store participants info
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tip', 10, 2)->default(0);
            $table->string('notes')->nullable();
            $table->string('participate_from_checkout_regi')->nullable();
            $table->string('chk')->nullable();
            $table->integer('categoryid')->nullable();
            $table->integer('p_session')->nullable();
            $table->string('repeateTimeType')->nullable();
            $table->integer('everyWeeks')->default(0); // Added field
            $table->integer('monthDays')->default(0); // Added field
            $table->date('enddate')->nullable();
            $table->integer('activity_days')->nullable();
            $table->integer('addOnServicesId')->nullable();
            $table->integer('addOnServicesQty')->nullable();
            $table->integer('addOnServicesTotalPrice')->nullable();
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
        Schema::dropIfExists('cart_widgets');
    }
}
