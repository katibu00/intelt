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
        Schema::create('stored_points', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id');
            $table->integer('level_order');
            $table->string('semester');
            $table->integer('user_id');
            $table->integer('tcr');
            $table->integer('tce');
            $table->integer('tpe');
            $table->float('gpa');
            $table->float('cgpa')->nullable();
            $table->string('cos')->nullable();
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
        Schema::dropIfExists('stored_points');
    }
};
