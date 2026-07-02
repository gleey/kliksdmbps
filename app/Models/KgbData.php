<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KgbData extends Model
{
    protected $table = 'kgb_data';

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'id',
        'kabkota',
        'bulan',
        'nama',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
