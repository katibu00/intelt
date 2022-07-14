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
        Schema::create('result_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id')->unique();
            $table->tinyInteger('withhold')->default(0);
            $table->tinyInteger('show_marks')->default(0);
            $table->tinyInteger('check_ca')->default(1);
            $table->tinyInteger('disable_result_check')->default(1);
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
        Schema::dropIfExists('result_settings');
    }
};
