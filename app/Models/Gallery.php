<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = ['title', 'image_path'];

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }
        return asset('storage/' . $this->image_path);
    }
}
