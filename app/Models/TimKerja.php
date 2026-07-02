<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimKerja extends Model
{
    protected $table = 'tim_kerja';

    protected $fillable = [
        'name',
        'position',
        'phone',
        'photo_path',
        'sort_order',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo_path) {
            return asset('assets/images/default-avatar.png');
        }
        if (str_starts_with($this->photo_path, 'http')) {
            return $this->photo_path;
        }
        return asset('storage/' . $this->photo_path);
    }
}
