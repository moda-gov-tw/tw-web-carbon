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
        Schema::create('gain_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->timestamps();
        });

        Schema::create('gain', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('gain_type_id')->comment('成果分類');
            $table->string('title')->comment('標題');
            $table->longText('detail')->nullable()->comment('內容');
            $table->date('gain_date')->comment('成果日期');
            $table->text('gain_folder')->nullable()->comment('資料夾');
            $table->json('gain_file')->nullable()->comment('附件');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gain_type');
        Schema::dropIfExists('gain');
    }
};
