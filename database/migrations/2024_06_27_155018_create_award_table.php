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
        Schema::create('award', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('標題');
            $table->longText('detail')->nullable()->comment('內容');
            $table->date('award_date')->comment('成果日期');
            $table->text('award_folder')->nullable()->comment('資料夾');
            $table->json('award_file')->nullable()->comment('附件');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('award');
    }
};
