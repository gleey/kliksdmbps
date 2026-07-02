<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpJadwal extends Model
{
    protected $table = 'kp_jadwal';

    protected $fillable = [
        'periode',
        'tanggal',
        'keterangan',
        'pdf_url',
        'sort_order',
    ];
}
