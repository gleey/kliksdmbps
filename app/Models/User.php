<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function isPengelola(): bool
    {
        return $this->role === 'admin_pengelola';
    }

    public function isKepegawaian(): bool
    {
        return $this->role === 'admin_kepegawaian';
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin_pengelola'    => 'Admin Pengelola',
            'admin_kepegawaian'  => 'Admin Kepegawaian',
            default              => $this->role,
        };
    }
}
