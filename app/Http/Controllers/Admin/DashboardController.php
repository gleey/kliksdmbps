<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Pengumuman, Gallery, TimKerja, Faq, KpData, KgbData, UjiKompetensi, Peraturan};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pengumuman'      => Pengumuman::count(),
            'gallery'         => Gallery::count(),
            'tim_kerja'       => TimKerja::count(),
            'faq_belum'       => Faq::where('is_answered', false)->count(),
            'faq_total'       => Faq::count(),
            'kp_total'        => KpData::count(),
            'kgb_total'       => KgbData::count(),
            'uji_total'       => UjiKompetensi::count(),
            'peraturan_total' => Peraturan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
