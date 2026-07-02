@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di KLIK-SDM</h1>
    <p class="text-gray-600 mt-2">Kemudahan Layanan Informasi Kepegawaian</p>
</div>

<!-- Pengumuman -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-7 h-7 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        Pengumuman
    </h2>
    @forelse($pengumuman as $item)
        <div class="border-l-4 border-blue-600 bg-gradient-to-r from-blue-50 to-transparent pl-6 py-4 rounded-r-lg mb-4 card-hover">
            <h3 class="font-bold text-lg text-gray-800">{{ $item->title }}</h3>
            <p class="text-gray-600 mt-2">{{ $item->content }}</p>
            <p class="text-gray-500 text-sm mt-3">📅 {{ $item->date ? $item->date->format('d F Y') : '-' }}</p>
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">Belum ada pengumuman</p>
    @endforelse
</div>

<!-- Akses Cepat Aplikasi -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
        <svg class="w-7 h-7 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
        Akses Cepat Aplikasi
    </h2>
    <p class="text-gray-500 text-sm mb-6">Klik untuk membuka aplikasi di tab baru</p>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
        <a href="https://simpeg.bps.go.id" target="_blank" class="app-card block bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-2xl p-5 text-center">
            <div class="app-icon-wrapper bg-white border border-blue-100" style="padding:6px;">
                <img src="{{ asset('assets/images/logo_bps.png') }}" alt="SIMPEG" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='🏛️'">
            </div>
            <p class="font-bold text-blue-800 text-sm">SIMPEG</p>
        </a>

        <a href="https://kipapp.bps.go.id" target="_blank" class="app-card block bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 rounded-2xl p-5 text-center">
            <div class="app-icon-wrapper bg-white border border-green-100" style="padding:6px;">
                <img src="{{ asset('assets/images/logo_kipapp.png') }}" alt="KipApp" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='💬'">
            </div>
            <p class="font-bold text-green-800 text-sm">KipApp</p>
        </a>

        <a href="https://backoffice.bps.go.id" target="_blank" class="app-card block bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 rounded-2xl p-5 text-center">
            <div class="app-icon-wrapper bg-white border border-purple-100" style="padding:6px;">
                <img src="{{ asset('assets/images/logo_BOS.png') }}" alt="BOS" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='🖥️'">
            </div>
            <p class="font-bold text-purple-800 text-sm">BOS</p>
        </a>

        <a href="https://sipecut.bps.go.id" target="_blank" class="app-card block bg-gradient-to-br from-orange-50 to-orange-100 border-2 border-orange-200 rounded-2xl p-5 text-center">
            <div class="app-icon-wrapper bg-white border border-orange-100" style="padding:6px;">
                <img src="{{ asset('assets/images/logo_sipecut.png') }}" alt="SIPECUT" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='📄'">
            </div>
            <p class="font-bold text-orange-800 text-sm">SIPECUT</p>
        </a>

        <a href="https://gojags-educ.web.bps.go.id/" target="_blank" class="app-card block bg-gradient-to-br from-teal-50 to-teal-100 border-2 border-teal-200 rounded-2xl p-5 text-center">
            <div class="app-icon-wrapper bg-white border border-teal-100" style="padding:6px;">
                <img src="{{ asset('assets/images/logo_gojags.png') }}" alt="Gojags EDU" class="w-full h-full object-contain" onerror="this.parentElement.innerHTML='🎓'">
            </div>
            <p class="font-bold text-teal-800 text-sm">Gojags EDU</p>
        </a>
    </div>
</div>
@endsection
