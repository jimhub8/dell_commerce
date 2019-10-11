<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_id')->nullable();
            $table->text('cart')->nullable();
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->boolean('delivered')->default(0);
            $table->text('paypal')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
