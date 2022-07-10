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
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id');
            $table->integer('user_id');
            $table->integer('session_id');
            $table->integer('semester');
            $table->integer('progress')->default(0);
            $table->integer('profile')->nullable();
            $table->integer('payment_slip')->nullable();
            $table->integer('payment')->nullable();
            $table->integer('payment_receipt')->nullable();
            $table->integer('courses')->nullable();
            $table->integer('result')->nullable();
            $table->integer('ras')->nullable();
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
        Schema::dropIfExists('student_progress');
    }
};
