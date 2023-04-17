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
        Schema::create('author_profile_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('path')->unique();
            $table->unique(['author_id', 'path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_profile_photos');
    }
};
