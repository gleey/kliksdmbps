<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kp_data', function (Blueprint $table) {
            $table->id();
            $table->string('month');        // format: YYYY-MM
            $table->string('name');
            $table->string('nip');
            $table->string('old_rank');
            $table->string('new_rank');
            $table->date('tanggal_usulan')->nullable();
            $table->string('drive_url')->nullable();
            $table->timestamps();

            $table->index('month');
        });

        Schema::create('kp_requirements', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->text('note')->nullable();
            $table->json('sub_items')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('kp_jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->string('tanggal')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('pdf_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kp_jadwal');
        Schema::dropIfExists('kp_requirements');
        Schema::dropIfExists('kp_data');
    }
};
