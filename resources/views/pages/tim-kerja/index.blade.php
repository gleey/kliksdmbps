@extends('layouts.app')
@section('title', 'Tim SDM & Hukum')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Tim SDM &amp; Hukum</h1>
    <p class="text-gray-600 mt-2">Anggota tim Sub Bagian SDM dan Hukum BPS Provinsi Sulawesi Utara</p>
</div>
@if($tim->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border p-16 text-center text-gray-400">Belum ada data tim kerja.</div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($tim as $member)
            <div class="bg-white rounded-2xl shadow-sm border p-5 text-center card-hover">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-3 bg-gray-100 border-4 border-blue-100">
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                         class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=1e40af&color=fff'">
                </div>
                <p class="font-bold text-gray-800">{{ $member->name }}</p>
                <p class="text-blue-600 text-sm mt-0.5">{{ $member->position }}</p>
                @if($member->phone)
                    <p class="text-gray-500 text-xs mt-1.5 flex items-center justify-center gap-1">
                        📞 {{ $member->phone }}
                    </p>
                @endif
            </div>
        @endforeach
    </div>
@endif
@endsection
