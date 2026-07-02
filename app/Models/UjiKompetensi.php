<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjiKompetensi extends Model
{
    protected $table = 'uji_kompetensi';

    protected $fillable = [
        'jenis',
        'periode',
        'name',
        'nip',
        'tanggal',
        'status',
        'keterangan',
    ];

    public static function jenisOptions(): array
    {
        return ['Uji Kompetensi Kenaikan Jenjang', 'Uji Kompetensi Perpindahan'];
    }

    public static function statusOptions(): array
    {
        return ['Lulus', 'Tidak Lulus', 'Belum'];
    }
}
