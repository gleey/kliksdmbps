@extends('layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="mb-6"><h1 class="text-3xl font-bold text-gray-800">FAQ</h1></div>

<!-- Answered FAQs -->
<div class="space-y-4 mb-8">
    @forelse($faq->where('is_answered', true) as $item)
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <p class="font-bold text-gray-800 mb-3 flex items-start gap-2">
                <span class="text-blue-500 mt-0.5">❓</span> {{ $item->question }}
            </p>
            <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                <p class="text-gray-700 text-sm flex items-start gap-2">
                    <span class="text-green-500 mt-0.5">✅</span> {{ $item->answer }}
                </p>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
            Belum ada pertanyaan yang terjawab.
        </div>
    @endforelse
</div>

<!-- Submit question -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="font-bold text-xl mb-4">Ajukan Pertanyaan</h3>
    <form action="{{ route('faq.store') }}" method="POST">
        @csrf
        <textarea name="question" rows="3" required placeholder="Tulis pertanyaan Anda di sini..."
                  class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 resize-none"></textarea>
        @error('question')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors">
            Kirim Pertanyaan
        </button>
    </form>
</div>
@endsection
