{{-- Shared admin CRUD for layanan items (persyaratan + dokumen) --}}
@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola {{ $title }}</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">+ Tambah Item</button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Persyaratan -->
    <div class="bg-white rounded-2xl shadow-sm border p-5">
        <h3 class="font-bold text-gray-800 mb-3">📋 Persyaratan</h3>
        <div class="space-y-2">
            @forelse($persyaratan as $item)
                <div class="flex items-start justify-between gap-3 bg-gray-50 rounded-lg p-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">{{ $item->title }}</p>
                        @if($item->description)<p class="text-xs text-gray-500 mt-0.5">{{ $item->description }}</p>@endif
                        <a href="{{ $item->url }}" target="_blank" class="text-xs text-blue-600 hover:underline">{{ $item->url }}</a>
                    </div>
                    <div class="flex flex-col gap-1 flex-shrink-0">
                        <button onclick="editItem('persyaratan', {{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ addslashes($item->url) }}')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                        <button onclick="deleteItem('persyaratan', {{ $item->id }})" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm text-center py-6">Belum ada persyaratan.</p>
            @endforelse
        </div>
    </div>

    <!-- Dokumen -->
    <div class="bg-white rounded-2xl shadow-sm border p-5">
        <h3 class="font-bold text-gray-800 mb-3">📁 Dokumen</h3>
        <div class="space-y-2">
            @forelse($dokumen as $item)
                <div class="flex items-start justify-between gap-3 bg-indigo-50 rounded-lg p-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">{{ $item->title }}</p>
                        @if($item->description)<p class="text-xs text-gray-500 mt-0.5">{{ $item->description }}</p>@endif
                        <a href="{{ $item->url }}" target="_blank" class="text-xs text-indigo-600 hover:underline">{{ $item->url }}</a>
                    </div>
                    <div class="flex flex-col gap-1 flex-shrink-0">
                        <button onclick="editItem('dokumen', {{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ addslashes($item->url) }}')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                        <button onclick="deleteItem('dokumen', {{ $item->id }})" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm text-center py-6">Belum ada dokumen.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Item</h3>
        <form action="{{ route('admin.layanan.store', $type) }}" method="POST" class="space-y-3">
            @csrf
            <select name="kategori" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option value="persyaratan">Persyaratan</option>
                <option value="dokumen">Dokumen</option>
            </select>
            <input type="text" name="title" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <textarea name="description" placeholder="Deskripsi (opsional)" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="url" required placeholder="URL dokumen/link" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Item</h3>
        <form id="editForm" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <input type="hidden" name="kategori" id="editKategori">
            <input type="text" name="title" id="editTitle" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <textarea name="description" id="editDescription" placeholder="Deskripsi (opsional)" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="url" id="editUrl" required placeholder="URL dokumen/link" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('editModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Hidden delete form -->
<form id="deleteForm" method="POST" class="hidden">
    @csrf @method('DELETE')
    <input type="hidden" name="kategori" id="deleteKategori">
</form>

@push('scripts')
<script>
const layananType = @json($type);

function editItem(kategori, id, title, description, url) {
    document.getElementById('editForm').action = `/admin/layanan/${layananType}/${id}`;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;
    document.getElementById('editUrl').value = url;
    document.getElementById('editModal').classList.add('active');
}

function deleteItem(kategori, id) {
    if (!confirm('Yakin ingin menghapus item ini?')) return;
    document.getElementById('deleteForm').action = `/admin/layanan/${layananType}/${id}`;
    document.getElementById('deleteKategori').value = kategori;
    document.getElementById('deleteForm').submit();
}
</script>
@endpush
@endsection
