<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('motto')->nullable();
            $table->string('username');
            $table->string('type');
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->string('email')->default('support@intellisas.com.ng');
            $table->string('website')->default('intellisas.com.ng');
            $table->string('logo')->nullable()->default('default.png');   
            $table->string('state')->nullable();  
            $table->string('address')->nullable(); 
            $table->integer('session_id')->nullable();
            $table->string('semester')->default('First');
            $table->string('form_price')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('service_fee')->nullable();
            $table->integer('applicant_fee')->nullable();
            $table->string('first_acct_name')->nullable();
            $table->integer('first_acct_no')->nullable();
            $table->string('first_bank_name')->nullable();
            $table->string('second_acct_name')->nullable();
            $table->integer('second_acct_number')->nullable();
            $table->string('second_bank_name')->nullable();
            $table->integer('minimun_payable')->nullable();
            $table->string('reg_type')->default('on');
            $table->string('start_reg')->nullable();
            $table->string('end_reg')->nullable();
            $table->string('allow_application')->default('on');
            $table->string('start_application')->nullable();
            $table->string('end_application')->nullable();
            $table->string('allow_result')->nullable();
            $table->string('heading')->default('h2');
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
        Schema::dropIfExists('institutions');
    }
};
