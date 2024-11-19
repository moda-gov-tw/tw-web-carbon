<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('link_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->timestamps();
        });

        Schema::create('link', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('link_type_id')->comment('連結分類');
            $table->string('name')->comment('連結名稱');
            $table->string('url')->comment('連結');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_type');
        Schema::dropIfExists('link');
    }
};
