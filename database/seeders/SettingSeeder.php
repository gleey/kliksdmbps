<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set(
            'scrolling_text',
            'Selamat Datang di KLIK-SDM — Kemudahan Layanan Informasi Kepegawaian BPS Provinsi Sulawesi Utara'
        );
    }
}
