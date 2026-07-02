<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpData extends Model
{
    protected $table = 'kp_data';

    protected $fillable = [
        'month',
        'name',
        'nip',
        'old_rank',
        'new_rank',
        'tanggal_usulan',
        'drive_url',
    ];

    protected $casts = [
        'tanggal_usulan' => 'date:Y-m-d',
    ];

    /**
     * Extract golongan prefix from rank string (e.g. "III/a" → "III")
     */
    public function getGolonganAttribute(): string
    {
        preg_match('/^([IVX]+)/', $this->new_rank, $m);
        return $m[1] ?? '-';
    }
}
