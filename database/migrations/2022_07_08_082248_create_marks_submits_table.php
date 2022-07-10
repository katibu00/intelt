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
        Schema::create('marks_submits', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id');
            $table->integer('session_id');
            $table->string('semester');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->string('marks_category');
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
        Schema::dropIfExists('marks_submits');
    }
};
