<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    protected $table = 'peraturan';

    protected $fillable = [
        'judul',
        'nomor',
        'tahun',
        'kategori',
        'deskripsi',
        'url',
    ];

    public static function kategoriOptions(): array
    {
        return ['Manajemen ASN', 'Penilaian Kinerja', 'Jabatan Fungsional', 'Pengembangan Kompetensi', 'Lainnya'];
    }
}
