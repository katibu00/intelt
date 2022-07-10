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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable()->unique();
            $table->string('usertype')->default('student');
            $table->string('institution_id');   
            $table->string('admission_session_id')->nullable();
            $table->string('reg_number')->nullable()->unique();
            $table->integer('faculty_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('combination_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->string('student_type')->default('Fresh');
            $table->string('image')->default('default.png');
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('gender')->nullable();
            $table->string('applicant_login')->nullable()->unique();
            $table->tinyInteger('status')->default(1)->comment('1=current, 2=deffered, 3=graduated, 4=rusticated, 5=expelled');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
