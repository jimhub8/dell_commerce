<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductimgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productimgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->string('image');
            $table->string('mimetype');
            $table->string('ext');
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
        Schema::dropIfExists('productimgs');
    }
}
