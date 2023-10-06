<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductsFitness extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_fitness', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id');
			$table->integer('business_id')->default('0');
			$table->string('name')->default('null');
			$table->text('description');
			$table->text('gallery');
			$table->string('product_type')->default('null');
			$table->double('sale_price')->default('0');
			$table->double('on_sale_price')->default('0');
			$table->double('business_cost')->default('0');
			$table->double('sales_tax')->default('0');
			$table->double('shipping_cost')->default('0');
			$table->integer('quantity')->default('0');
			$table->integer('low_quantity_alert')->default('0');
			$table->string('vendor_id')->default('null');
			$table->string('color')->default('null');
			$table->string('brand')->default('null');
			$table->string('size')->default('null');
			$table->string('category')->default('null');
			$table->string('great_for')->default('null');
			$table->string('activity_is_for')->default('null');
			$table->string('material')->default('null');
			$table->text('policy_returning');
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
        Schema::dropIfExists('table_products_fitness');
    }
}
