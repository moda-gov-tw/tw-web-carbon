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
        Schema::create('swiper', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('名稱');
            $table->string('pic')->comment('圖片');
            $table->string('url')->nullable()->comment('連結');
            $table->smallInteger('orderNum')->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swiper');
    }
};
