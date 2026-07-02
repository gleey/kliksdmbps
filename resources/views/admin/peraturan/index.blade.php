@extends('layouts.admin')
@section('title', 'Peraturan')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Peraturan</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">+ Tambah Peraturan</button>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-gray-600">
                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                <th class="px-4 py-3 text-left font-semibold">Tahun</th>
                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peraturan as $item)
                <tr class="border-t border-gray-100">
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-800">{{ $item->judul }}</p>
                        @if($item->nomor)<p class="text-xs text-gray-400">{{ $item->nomor }}</p>@endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $item->kategori ?: '-' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $item->tahun ?: '-' }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="document.getElementById('editModal{{ $item->id }}').classList.add('active')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                            <form id="delPer{{ $item->id }}" action="{{ route('admin.peraturan.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                            </form>
                            <button onclick="confirmDelete('delPer{{ $item->id }}')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>

                <div id="editModal{{ $item->id }}" class="modal-overlay">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Peraturan</h3>
                        <form action="{{ route('admin.peraturan.update', $item) }}" method="POST" class="space-y-3">
                            @csrf @method('PUT')
                            <input type="text" name="judul" value="{{ $item->judul }}" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="nomor" value="{{ $item->nomor }}" placeholder="Nomor" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <div class="grid grid-cols-2 gap-2">
                                <input type="text" name="tahun" value="{{ $item->tahun }}" placeholder="Tahun" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <input type="text" name="kategori" value="{{ $item->kategori }}" placeholder="Kategori" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            </div>
                            <textarea name="deskripsi" placeholder="Deskripsi" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">{{ $item->deskripsi }}</textarea>
                            <input type="url" name="url" value="{{ $item->url }}" placeholder="Link dokumen" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" onclick="document.getElementById('editModal{{ $item->id }}').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr><td colspan="4" class="text-center py-10 text-gray-400">Belum ada peraturan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Peraturan</h3>
        <form action="{{ route('admin.peraturan.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="judul" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="nomor" placeholder="Nomor" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="grid grid-cols-2 gap-2">
                <input type="text" name="tahun" placeholder="Tahun" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <input type="text" name="kategori" placeholder="Kategori" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            </div>
            <textarea name="deskripsi" placeholder="Deskripsi" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="url" placeholder="Link dokumen" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
