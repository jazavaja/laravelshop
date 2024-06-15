<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('percent')->nullable();
            $table->bigInteger('cat_id')->nullable();
            $table->bigInteger('pay_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('meta_id')->nullable();
            $table->bigInteger('price')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('type')->default(0)->nullable();
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
        Schema::dropIfExists('cooperations');
    }
}
