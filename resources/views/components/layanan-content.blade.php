{{-- Shared partial for layanan pages: persyaratan + dokumen card grid --}}
@props(['persyaratan', 'dokumen', 'title'])

<div class="mb-6"><h1 class="text-3xl font-bold text-gray-800">{{ $title }}</h1></div>

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="font-bold text-xl mb-4">Persyaratan</h3>
    @if($persyaratan->isEmpty())
        <p class="text-gray-400 text-center py-4">Belum ada data</p>
    @else
        @foreach($persyaratan as $item)
            <div class="pdf-card border border-gray-200 rounded-xl p-4 mb-3 flex items-center justify-between">
                <div>
                    <p class="font-bold">{{ $item->title }}</p>
                    @if($item->description)
                        <p class="text-sm text-gray-500">{{ $item->description }}</p>
                    @endif
                </div>
                <a href="{{ $item->url }}" target="_blank" class="text-blue-600 hover:underline text-sm font-semibold flex-shrink-0 ml-4">Buka PDF</a>
            </div>
        @endforeach
    @endif
</div>

<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="font-bold text-xl mb-4">Dokumen</h3>
    @if($dokumen->isEmpty())
        <p class="text-gray-400 text-center py-4">Belum ada data</p>
    @else
        @foreach($dokumen as $item)
            <div class="pdf-card border border-gray-200 rounded-xl p-4 mb-3 flex items-center justify-between">
                <div>
                    <p class="font-bold">{{ $item->title }}</p>
                    @if($item->description)
                        <p class="text-sm text-gray-500">{{ $item->description }}</p>
                    @endif
                </div>
                <a href="{{ $item->url }}" target="_blank" class="text-blue-600 hover:underline text-sm font-semibold flex-shrink-0 ml-4">Buka PDF</a>
            </div>
        @endforeach
    @endif
</div>
