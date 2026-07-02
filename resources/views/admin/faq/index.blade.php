@extends('layouts.admin')
@section('title', 'FAQ')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola FAQ</h1>

<div class="mb-8">
    <h3 class="font-bold text-lg text-gray-700 mb-3">⏳ Belum Dijawab ({{ $faqBelum->count() }})</h3>
    <div class="space-y-3">
        @forelse($faqBelum as $item)
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="font-semibold text-gray-800 mb-3">{{ $item->question }}</p>
                <form action="{{ route('admin.faq.answer', $item) }}" method="POST" class="flex gap-2">
                    @csrf @method('PUT')
                    <input type="text" name="answer" required placeholder="Tulis jawaban..."
                           class="flex-1 border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">Jawab</button>
                </form>
            </div>
        @empty
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Tidak ada pertanyaan yang menunggu jawaban.</div>
        @endforelse
    </div>
</div>

<div>
    <h3 class="font-bold text-lg text-gray-700 mb-3">✅ Sudah Dijawab ({{ $faqTerjawab->count() }})</h3>
    <div class="space-y-3">
        @forelse($faqTerjawab as $item)
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="font-semibold text-gray-800 mb-2">{{ $item->question }}</p>
                <p class="text-gray-600 text-sm bg-blue-50 rounded-lg p-3">{{ $item->answer }}</p>
                <form id="delFaq{{ $item->id }}" action="{{ route('admin.faq.destroy', $item) }}" method="POST" class="mt-2">
                    @csrf @method('DELETE')
                </form>
                <button onclick="confirmDelete('delFaq{{ $item->id }}')" class="text-red-600 hover:underline text-xs font-semibold mt-1">Hapus</button>
            </div>
        @empty
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Belum ada pertanyaan terjawab.</div>
        @endforelse
    </div>
</div>
@endsection
