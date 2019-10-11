<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('list_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->nullable();
            $table->string('payment')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_country')->nullable();
            $table->string('client_city')->nullable();
            $table->text('cart')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
