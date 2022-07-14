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
        Schema::create('c_r_f_s', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id');
            $table->integer('user_id');
            $table->integer('session_id');
            $table->string('semester');
            $table->integer('level_id');
            $table->integer('course_id');
            $table->string('type')->default('Regular');
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
        Schema::dropIfExists('c_r_f_s');
    }
};
