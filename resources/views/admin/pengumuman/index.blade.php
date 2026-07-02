@extends('layouts.admin')
@section('title', 'Pengumuman')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Pengumuman</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">
        + Tambah Pengumuman
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-gray-600">
                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengumuman as $item)
                <tr class="border-t border-gray-100">
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                        <p class="text-gray-500 text-xs mt-0.5 line-clamp-1">{{ $item->content }}</p>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $item->date?->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.pengumuman.toggle', $item) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-2 py-1 rounded-full text-xs font-semibold {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="editPengumuman({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->content) }}', '{{ $item->date?->format('Y-m-d') }}')"
                                    class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                            <form id="delForm{{ $item->id }}" action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                            </form>
                            <button onclick="confirmDelete('delForm{{ $item->id }}')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-10 text-gray-400">Belum ada pengumuman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Pengumuman</h3>
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Judul</label>
                <input type="text" name="title" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Isi</label>
                <textarea name="content" rows="4" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Tanggal</label>
                <input type="date" name="date" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
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
        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Pengumuman</h3>
        <form id="editForm" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Judul</label>
                <input type="text" name="title" id="editTitle" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Isi</label>
                <textarea name="content" id="editContent" rows="4" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Tanggal</label>
                <input type="date" name="date" id="editDate" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('editModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function editPengumuman(id, title, content, date) {
    document.getElementById('editForm').action = `/admin/pengumuman/${id}`;
    document.getElementById('editTitle').value = title;
    document.getElementById('editContent').value = content;
    document.getElementById('editDate').value = date;
    document.getElementById('editModal').classList.add('active');
}
</script>
@endpush
@endsection
