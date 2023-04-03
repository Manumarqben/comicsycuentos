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
        Schema::create('chapter_images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('order');
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->unique(['chapter_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_images');
    }
};
