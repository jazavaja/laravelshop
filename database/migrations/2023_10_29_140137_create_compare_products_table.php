<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compare_products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('link')->nullable();
            $table->string('text1')->nullable();
            $table->string('text2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compare_products');
    }
};