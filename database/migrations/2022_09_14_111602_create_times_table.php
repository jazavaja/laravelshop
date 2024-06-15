<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nameEn')->nullable();
            $table->smallInteger('from');
            $table->smallInteger('to');
            $table->smallInteger('day');
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
        Schema::create('timables', function (Blueprint $table) {
            $table->integer('time_id');
            $table->integer('timables_id');
            $table->string('timables_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
