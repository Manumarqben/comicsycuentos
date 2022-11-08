<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('synopsis')->unique();
            $table->string('front_page', 2048);
            $table->timestamps();
            $table->foreignId('age_id')->constrained();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('state_id')->constrained();
            $table->foreignId('type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
};
