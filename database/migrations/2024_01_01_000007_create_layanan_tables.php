<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Layanan tables share the same structure: (title, description, url, sort_order).
 * Covers: tugas_belajar, karis_karsu, perkawinan_pertama, pensiun — each with
 * separate persyaratan and dokumen tables.
 */
return new class extends Migration
{
    private array $tables = [
        'tugas_belajar_persyaratan',
        'tugas_belajar_dokumen',
        'karis_karsu_persyaratan',
        'karis_karsu_dokumen',
        'perkawinan_pertama_persyaratan',
        'perkawinan_pertama_dokumen',
        'pensiun_persyaratan',
        'pensiun_dokumen',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('url');
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        foreach (array_reverse($this->tables) as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
