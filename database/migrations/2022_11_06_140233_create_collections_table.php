<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('titleSeo');
            $table->string('image' , 400);
            $table->text('body');
            $table->text('bodySeo');
            $table->string('keyword');
            $table->tinyInteger('off');
            $table->bigInteger('offPrice');
            $table->bigInteger('price');
            $table->bigInteger('count');
            $table->bigInteger('user_id')->default(0);
            $table->timestamps();
        });
        Schema::create('collectables', function (Blueprint $table) {
            $table->integer('collection_id');
            $table->integer('collectables_id');
            $table->string('collectables_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
