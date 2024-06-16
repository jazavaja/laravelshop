<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('titleSeo')->nullable();
            $table->string('bodySeo')->nullable();
            $table->string('keywordSeo',400)->nullable();
            $table->text('image');
            $table->string('slug');
            $table->smallInteger('count');
            $table->smallInteger('type')->default(0);
            $table->bigInteger('variety')->default(0);
            $table->boolean('inquiry')->default(0);
            $table->string('product_id' , 15);
            $table->string('currency_id' , 15)->default(0);
            $table->string('altImage')->nullable();
            $table->smallInteger('numLottery1')->nullable();
            $table->smallInteger('numLottery2')->nullable();
            $table->string('letterLottery',3)->nullable();
            $table->boolean('lotteryStatus')->default(0);
            $table->boolean('status')->default(0);
            $table->string('suggest',50)->nullable();
            $table->string('score',50)->nullable();
            $table->boolean('showcase')->default(0);
            $table->boolean('original')->default(0);
            $table->boolean('used')->default(0);
            $table->string('off' , 3)->nullable();
            $table->string('weight' , 10)->nullable();
            $table->text('short')->nullable();
            $table->string('user_id' , 10)->default(1);
            $table->integer('price');
            $table->integer('offPrice')->nullable();
            $table->text('rate')->nullable();
            $table->text('specifications')->nullable();
            $table->text('ability')->nullable();
            $table->text('size')->nullable();
            $table->text('colors')->nullable();
            $table->text('body')->nullable();
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
        Schema::dropIfExists('products');
    }
}
