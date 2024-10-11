<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('business_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('product_image')->nullable();
            $table->text('gallery')->nullable();
            $table->string('product_type')->nullable();
            $table->double('sale_price')->default(0);
            $table->double('rental_price')->default(0);
            $table->double('on_sale_price')->default(0);
            $table->double('business_cost')->default(0);
            $table->double('sales_tax')->default(0);
            $table->double('shipping_cost')->default(0);
            $table->string('rental_duration')->nullable();
            $table->string('require_deposit')->nullable();
            $table->string('require_ID_to_rent')->nullable();
            $table->double('deposit_amount')->default(0);
            $table->string('delivery_method')->nullable();
            $table->string('agreement_info')->nullable();
            $table->string('agreement_img')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('low_quantity_alert')->default(0);
            $table->string('vendor_id')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('size')->nullable();
            $table->string('category')->nullable();
            $table->string('great_for')->nullable();
            $table->string('activity_is_for')->nullable();
            $table->string('material')->nullable();
            $table->text('policy_returning')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
