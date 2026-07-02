<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('tim_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('phone')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer')->nullable();
            $table->boolean('is_answered')->default(false);
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq');
        Schema::dropIfExists('tim_kerja');
        Schema::dropIfExists('gallery');
    }
};
