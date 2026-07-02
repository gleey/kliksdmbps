<?php

namespace Database\Seeders;

use App\Models\{Pengumuman, KpRequirement, KpJadwal, Peraturan};
use Illuminate\Database\Seeder;

/**
 * Replicates the original sample/demo data seeded in 01_schema.sql,
 * so the migrated app shows the same initial content as the original.
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        Pengumuman::firstOrCreate(
            ['title' => 'Pelaksanaan Kenaikan Pangkat April 2026'],
            [
                'content' => 'Kepada seluruh pegawai yang akan naik pangkat periode April 2026, harap segera melengkapi berkas persyaratan dan mengajukan melalui SIMPEG. Batas waktu pengajuan adalah 28 Februari 2026.',
                'date'    => now(),
                'is_active' => true,
            ]
        );

        Pengumuman::firstOrCreate(
            ['title' => 'Jadwal Kenaikan Gaji Berkala Triwulan I 2026'],
            [
                'content' => 'KGB untuk triwulan pertama tahun 2026 akan diproses pada bulan Januari s.d. Maret 2026. Mohon koordinasikan dengan bagian kepegawaian masing-masing satuan kerja.',
                'date'    => now()->subDays(3),
                'is_active' => true,
            ]
        );

        $requirements = [
            ['text' => 'Semua PAK mulai pengangkatan awal', 'note' => null, 'sub_items' => []],
            ['text' => 'SKP PPK 2 tahun terakhir', 'note' => 'SKP Tahunan terdiri dari 3 dokumen berikut:', 'sub_items' => [
                'Dokumen Sasaran Kinerja (SKP Penentuan)', 'Evaluasi Kinerja (Dokumen Evaluasi)', 'Penilaian Kinerja (SKP Penilaian)',
            ]],
            ['text' => 'Karpeg', 'note' => null, 'sub_items' => []],
            ['text' => 'SK CPNS', 'note' => null, 'sub_items' => []],
            ['text' => 'SK PNS', 'note' => null, 'sub_items' => []],
            ['text' => 'SK KP Terakhir', 'note' => null, 'sub_items' => []],
            ['text' => 'SK Pengangkatan Pertama JF / SK JF', 'note' => null, 'sub_items' => []],
            ['text' => 'Surat Persyaratan Pelantikan (SPP) JF', 'note' => null, 'sub_items' => []],
            ['text' => 'SK Mutasi', 'note' => 'Jika ada', 'sub_items' => []],
        ];
        foreach ($requirements as $i => $req) {
            KpRequirement::firstOrCreate(
                ['text' => $req['text']],
                ['note' => $req['note'], 'sub_items' => $req['sub_items'], 'sort_order' => $i + 1]
            );
        }

        KpJadwal::firstOrCreate(
            ['periode' => 'Periode April 2026'],
            ['tanggal' => '1 Januari – 28 Februari 2026', 'keterangan' => 'Batas waktu pengajuan berkas', 'sort_order' => 1]
        );
        KpJadwal::firstOrCreate(
            ['periode' => 'Periode Oktober 2026'],
            ['tanggal' => '1 Juli – 31 Agustus 2026', 'keterangan' => 'Batas waktu pengajuan berkas', 'sort_order' => 2]
        );

        $peraturan = [
            ['judul' => 'Peraturan Pemerintah tentang Manajemen PNS', 'nomor' => 'PP No. 11 Tahun 2017', 'tahun' => '2017', 'kategori' => 'Manajemen ASN', 'deskripsi' => 'Mengatur manajemen PNS meliputi penyusunan dan penetapan kebutuhan, pengadaan, pangkat dan jabatan, serta pemberhentian.', 'url' => 'https://peraturan.bpk.go.id/Details/39636/pp-no-11-tahun-2017'],
            ['judul' => 'Peraturan Pemerintah tentang Penilaian Kinerja PNS', 'nomor' => 'PP No. 30 Tahun 2019', 'tahun' => '2019', 'kategori' => 'Penilaian Kinerja', 'deskripsi' => 'Mengatur tata cara penilaian kinerja PNS yang berorientasi pada hasil.', 'url' => 'https://peraturan.bpk.go.id/Details/110798'],
            ['judul' => 'Peraturan BPS tentang Jabatan Fungsional Statistisi', 'nomor' => 'Perban BPS No. 3 Tahun 2020', 'tahun' => '2020', 'kategori' => 'Jabatan Fungsional', 'deskripsi' => 'Petunjuk pelaksanaan jabatan fungsional statistisi dan angka kreditnya.', 'url' => null],
            ['judul' => 'Undang-Undang Aparatur Sipil Negara', 'nomor' => 'UU No. 5 Tahun 2014', 'tahun' => '2014', 'kategori' => 'Manajemen ASN', 'deskripsi' => 'Landasan hukum pengaturan ASN untuk mewujudkan birokrasi profesional.', 'url' => 'https://peraturan.bpk.go.id/Details/38580/uu-no-5-tahun-2014'],
        ];
        foreach ($peraturan as $p) {
            Peraturan::firstOrCreate(['judul' => $p['judul']], $p);
        }
    }
}
