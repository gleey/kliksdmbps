@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Website</h1>

<div class="bg-white rounded-2xl shadow-sm border p-6 max-w-2xl">
    <h3 class="font-bold text-lg text-gray-800 mb-4">Teks Berjalan (Running Text)</h3>
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-3">
        @csrf @method('PUT')
        <textarea name="scrolling_text" rows="3" required
                  class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">{{ $scrollingText }}</textarea>
        <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">Simpan Pengaturan</button>
    </form>
</div>
@endsection
