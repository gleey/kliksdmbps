<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Default accounts, matching the original Supabase schema's seed values
     * (originally stored as plaintext; now properly hashed per Laravel best practice).
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('Admin@2024'), 'role' => 'admin_pengelola']
        );

        User::updateOrCreate(
            ['username' => 'kepegawaian'],
            ['password' => Hash::make('Kepeg@2024'), 'role' => 'admin_kepegawaian']
        );
    }
}
