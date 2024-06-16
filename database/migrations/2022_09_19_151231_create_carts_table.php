<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('price')->nullable();
            $table->tinyInteger('inquiry')->default(0);
            $table->tinyInteger('number')->default(0);
            $table->string('discount')->nullable();
            $table->string('time')->nullable();
            $table->string('guarantee_id', 10)->nullable();
            $table->string('product_id', 10)->nullable();
            $table->bigInteger('count')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
