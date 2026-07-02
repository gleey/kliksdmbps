@extends('layouts.app')
@section('title', 'Peraturan')
@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Peraturan</h1>
    <form method="GET" action="{{ route('peraturan') }}">
        <select name="kategori" onchange="this.form.submit()"
                class="border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)
                <option value="{{ $k }}" {{ $kategori === $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
    </form>
</div>

@if($peraturan->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border p-16 text-center text-gray-400">Belum ada peraturan.</div>
@else
    <div class="space-y-4">
        @foreach($peraturan as $item)
            <div class="bg-white rounded-xl shadow-sm border p-5 card-hover">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            @if($item->kategori)
                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $item->kategori }}</span>
                            @endif
                            @if($item->tahun)
                                <span class="text-gray-400 text-xs">{{ $item->tahun }}</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-gray-800 mb-0.5">{{ $item->judul }}</h3>
                        @if($item->nomor)
                            <p class="text-sm text-gray-500 mb-1">{{ $item->nomor }}</p>
                        @endif
                        @if($item->deskripsi)
                            <p class="text-sm text-gray-600">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                    @if($item->url)
                        <a href="{{ $item->url }}" target="_blank"
                           class="flex-shrink-0 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center gap-1">
                            🔗 Buka
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
