<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpRequirement extends Model
{
    protected $table = 'kp_requirements';

    protected $fillable = [
        'text',
        'note',
        'sub_items',
        'sort_order',
    ];

    protected $casts = [
        'sub_items' => 'array',
    ];
}
