<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('amount');
            $table->string('name');
            $table->string('disc_type');
            $table->date('expiry_date');
            $table->integer('min_spend')->nullable();
            $table->boolean('ind_use')->nullable();
            $table->integer('max_spend')->nullable();
            $table->integer('limit_user')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('item_limit')->nullable();
            $table->text('categories')->nullable();
            $table->text('categoriesx')->nullable();
            $table->text('products')->nullable();
            $table->text('productsx')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
