<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'question',
        'answer',
        'is_answered',
        'answered_at',
    ];

    protected $casts = [
        'is_answered' => 'boolean',
        'answered_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $faq) {
            $faq->is_answered = !empty($faq->answer);
            if ($faq->is_answered && !$faq->answered_at) {
                $faq->answered_at = now();
            }
        });
    }
}
