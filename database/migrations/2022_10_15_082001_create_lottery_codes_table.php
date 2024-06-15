<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code' , 10)->default(0);
            $table->string('letter',2)->nullable();
            $table->bigInteger('number')->nullable();
            $table->bigInteger('round')->nullable();
            $table->boolean('active')->default(0);
            $table->bigInteger('product_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('lottery_id')->default(0);
            $table->bigInteger('pay_id')->default(0);
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
        Schema::dropIfExists('lottery_codes');
    }
}
