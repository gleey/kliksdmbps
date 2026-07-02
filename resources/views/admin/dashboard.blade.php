@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @php
    $cards = [
        ['label' => 'Pengumuman',     'value' => $stats['pengumuman'],      'icon' => '📢', 'bg' => 'bg-blue-50',   'color' => 'text-blue-600'],
        ['label' => 'Galeri SDM',     'value' => $stats['gallery'],         'icon' => '🖼️', 'bg' => 'bg-purple-50', 'color' => 'text-purple-600'],
        ['label' => 'Tim SDM & Hukum','value' => $stats['tim_kerja'],       'icon' => '👥', 'bg' => 'bg-green-50',  'color' => 'text-green-600'],
        ['label' => 'FAQ Belum Jawab','value' => $stats['faq_belum'],       'icon' => '❓', 'bg' => 'bg-orange-50', 'color' => 'text-orange-600'],
        ['label' => 'Data KP',        'value' => $stats['kp_total'],        'icon' => '📈', 'bg' => 'bg-indigo-50', 'color' => 'text-indigo-600'],
        ['label' => 'Data KGB',       'value' => $stats['kgb_total'],       'icon' => '💰', 'bg' => 'bg-emerald-50','color' => 'text-emerald-600'],
        ['label' => 'Uji Kompetensi', 'value' => $stats['uji_total'],       'icon' => '📋', 'bg' => 'bg-pink-50',   'color' => 'text-pink-600'],
        ['label' => 'Peraturan',      'value' => $stats['peraturan_total'], 'icon' => '📜', 'bg' => 'bg-amber-50',  'color' => 'text-amber-600'],
    ];
    @endphp
    @foreach($cards as $c)
        <div class="bg-white rounded-2xl shadow-sm border p-5">
            <div class="flex items-center gap-3">
                <div class="{{ $c['bg'] }} {{ $c['color'] }} rounded-xl p-3 text-2xl">{{ $c['icon'] }}</div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $c['value'] }}</p>
                    <p class="text-gray-500 text-xs">{{ $c['label'] }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="bg-white rounded-2xl shadow-sm border p-6">
    <h3 class="font-bold text-lg text-gray-800 mb-4">Selamat datang, {{ auth()->user()->username }} 👋</h3>
    <p class="text-gray-500 text-sm">
        Gunakan menu di samping untuk mengelola konten website KLIK-SDM. Anda login sebagai
        <span class="font-semibold">{{ auth()->user()->role_label }}</span>.
    </p>
</div>
@endsection
