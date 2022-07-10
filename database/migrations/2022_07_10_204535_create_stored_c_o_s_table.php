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
        Schema::create('stored_c_o_s', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id');
            $table->integer('level_order');
            $table->string('semester');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('cleared')->nullable();
           
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
        Schema::dropIfExists('stored_c_o_s');
    }
};
