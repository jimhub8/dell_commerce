<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('variant_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('subCategory_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('list_price')->nullable();
            $table->integer('retail_price')->nullable();
            $table->integer('whole_price')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('best_sell')->default(0);
            $table->boolean('new_product')->default(0);
            $table->string('image')->nullable();
            $table->string('tags')->nullable();
            $table->string('sku_no')->nullable();
            $table->string('initial_stock')->nullable();
            $table->boolean('carousel')->default(0);
            $table->text('details')->nullable();


            $table->integer('user_id');
            $table->integer('client_id')->nullable();
            $table->string('product_name');
            $table->integer('qty')->unsigned()->default(0);
            $table->string('bar_code')->nullable();
            $table->string('status')->nullable();
            $table->string('weight')->nullable();
            $table->integer('suplier_id')->nullable();
            $table->integer('product_type')->nullable();
            $table->integer('brand')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('box_id')->nullable();
            $table->integer('classification_id')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('dangerous')->nullable();
            $table->boolean('lot')->nullable();
            $table->integer('reorder_point')->unsigned()->default(0);
            $table->decimal('length')->unsigned()->default(0);
            $table->decimal('width')->unsigned()->default(0);
            $table->integer('onhand')->unsigned()->default(0);
            $table->decimal('height')->unsigned()->default(0);
            $table->string('tariff_code')->nullable();
            $table->string('attribute')->nullable();
            $table->string('location')->nullable();
            $table->integer('value')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('shipping_label')->default(false);
            $table->boolean('has_serial')->default(false);
            $table->boolean('has_variants')->default(false);
            $table->boolean('digital')->default(false);
            $table->integer('uro_id')->unsigned()->nullable();
            $table->integer('fulfillmentcenter_id')->unsigned()->nullable();
            $table->integer('boxes_no')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('tracking')->nullable();
            $table->string('wro')->nullable();
            $table->string('pallet')->nullable();
            $table->string('label_image')->nullable();
            $table->string('item_image')->nullable();
            $table->text('reason')->nullable();
            $table->text('instructions')->nullable();
            $table->text('comment')->nullable();
            $table->date('linked_on')->nullable();
            $table->integer('group_id')->nullable();
			$table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
