<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'title',
        'content',
        'date',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'date'      => 'datetime',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('date', 'desc');
    }
}
