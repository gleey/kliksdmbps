<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kgb_data', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(\Illuminate\Support\Facades\DB::raw('(UUID())'));
            $table->string('kabkota');
            $table->string('bulan');   // format: YYYY-MM
            $table->string('nama');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();

            $table->index('kabkota');
            $table->index('bulan');
        });

        Schema::create('uji_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('periode');
            $table->string('name');
            $table->string('nip');
            $table->string('tanggal')->nullable();
            $table->enum('status', ['Lulus', 'Tidak Lulus', 'Belum'])->default('Belum');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('jenis');
            $table->index('periode');
        });

        Schema::create('peraturan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nomor')->nullable();
            $table->string('tahun')->nullable();
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peraturan');
        Schema::dropIfExists('uji_kompetensi');
        Schema::dropIfExists('kgb_data');
    }
};
