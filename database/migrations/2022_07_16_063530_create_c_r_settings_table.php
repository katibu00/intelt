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
        Schema::create('c_r_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('institution_id')->unique();
            $table->tinyInteger('allow_unpaid')->default(0);
            $table->string('register_style')->default('sessional');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('approve_manually')->default('0');
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
        Schema::dropIfExists('c_r_settings');
    }
};
