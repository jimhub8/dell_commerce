<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('logo')->default('/storage/logo/logo.png');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address')->nullable();
            $table->string('branch')->nullable();
            $table->string('company_businessno')->nullable();
            $table->string('company_website')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_name')->nullable();
            $table->string('mpesa_name')->nullable();
            $table->string('location')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank')->nullable();
            $table->string('mpesa_phone')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
