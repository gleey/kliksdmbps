@extends('layouts.admin')
@section('title', 'Kenaikan Pangkat')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Kenaikan Pangkat</h1>

<!-- Tabs -->
<div class="flex bg-gray-100 p-1 rounded-xl mb-6 w-fit gap-1">
    <button onclick="showTab('data')" id="tabBtn-data" class="px-5 py-2.5 text-sm font-semibold rounded-lg bg-white text-indigo-700 shadow-sm transition-all">
        📋 Data Pegawai
    </button>
    <button onclick="showTab('req')" id="tabBtn-req" class="px-5 py-2.5 text-sm font-semibold rounded-lg text-gray-500 hover:text-gray-700 transition-all">
        📜 Persyaratan
    </button>
    <button onclick="showTab('jadwal')" id="tabBtn-jadwal" class="px-5 py-2.5 text-sm font-semibold rounded-lg text-gray-500 hover:text-gray-700 transition-all">
        📅 Jadwal
    </button>
</div>

<!-- TAB: Data Pegawai -->
<div id="tab-data">
    <div class="flex items-center justify-between mb-4">
        <button onclick="document.getElementById('addDataModal').classList.add('active')"
                class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">+ Tambah Data</button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm">
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">NIP</th>
                    <th class="px-4 py-3 text-left font-semibold">Pangkat Lama</th>
                    <th class="px-4 py-3 text-left font-semibold">Pangkat Baru</th>
                    <th class="px-4 py-3 text-left font-semibold">Tgl Usulan</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kpData as $item)
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-3 font-semibold text-gray-800">{{ $item->name }}</td>
                        <td class="px-4 py-3 text-gray-600 font-mono text-xs">{{ $item->nip }}</td>
                        <td class="px-4 py-3">{{ $item->old_rank }}</td>
                        <td class="px-4 py-3">{{ $item->new_rank }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $item->tanggal_usulan?->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <button onclick="document.getElementById('editKp{{ $item->id }}').classList.add('active')"
                                    class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">
                                    ✏️ Edit
                                </button>
                                <button onclick="confirmDelete('delKp{{ $item->id }}')"
                                    class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-100 transition">
                                    🗑️ Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div id="editKp{{ $item->id }}" class="modal-overlay">
                        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Data Pegawai</h3>
                            <form action="{{ route('admin.kp.data.update', $item) }}" method="POST" class="space-y-3">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-2 gap-2">
                                    <select onchange="this.parentElement.nextElementSibling.value = this.nextElementSibling.value + '-' + this.value" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                        @php $mItem = substr($item->month, 5, 2); @endphp
                                        @foreach(['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $num => $nama)
                                            <option value="{{ $num }}" {{ $mItem == $num ? 'selected' : '' }}>{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    <select onchange="this.parentElement.nextElementSibling.value = this.value + '-' + this.previousElementSibling.value" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                        @php $yItem = substr($item->month, 0, 4); @endphp
                                        @for($y = now()->year - 2; $y <= now()->year + 5; $y++)
                                            <option value="{{ $y }}" {{ $y == $yItem ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <input type="hidden" name="month" value="{{ $item->month }}">
                                <input type="text" name="name" value="{{ $item->name }}" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <input type="text" name="nip" value="{{ $item->nip }}" required placeholder="NIP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="old_rank" value="{{ $item->old_rank }}" required placeholder="Pangkat Lama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                    <input type="text" name="new_rank" value="{{ $item->new_rank }}" required placeholder="Pangkat Baru" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                </div>
                                <input type="date" name="tanggal_usulan" value="{{ $item->tanggal_usulan?->format('Y-m-d') }}" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <input type="url" name="drive_url" value="{{ $item->drive_url }}" placeholder="Link Google Drive" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" onclick="document.getElementById('editKp{{ $item->id }}').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada data untuk bulan ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- TAB: Requirements -->
<div id="tab-req" class="hidden">
    <div class="bg-indigo-50 border-2 border-indigo-200 rounded-xl p-6 mb-6">
        <h4 class="font-bold text-lg text-indigo-800 mb-1">Isi Persyaratan</h4>
        <p class="text-sm text-gray-500 mb-4">Tulis semua persyaratan sekaligus — <strong>satu baris = satu persyaratan</strong>. Klik "Simpan Semua" untuk mengganti seluruh daftar.</p>
        <form action="{{ route('admin.kp.req.bulk') }}" method="POST">
            @csrf
            <textarea name="lines" rows="10" placeholder="Contoh:&#10;Semua PAK mulai pengangkatan awal&#10;SKP PPK 2 tahun terakhir&#10;Karpeg&#10;SK CPNS&#10;SK PNS"
                      class="w-full p-4 border-2 border-gray-300 rounded-xl outline-none focus:border-indigo-400 font-mono text-sm resize-y leading-relaxed">{{ $requirements->pluck('text')->implode("\n") }}</textarea>
            <p class="text-xs text-gray-400 mt-1 mb-4">Setiap baris akan menjadi satu item persyaratan terpisah. Menyimpan akan mengganti seluruh daftar persyaratan.</p>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">💾 Simpan Semua</button>
        </form>
    </div>

    <h4 class="font-bold text-lg text-gray-700 mb-3">Preview Persyaratan Saat Ini <span class="text-indigo-600">({{ $requirements->count() }} item)</span></h4>
    <div class="space-y-2">
        @forelse($requirements as $i => $item)
            <div class="flex items-start justify-between gap-4 bg-white rounded-xl border p-4">
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 rounded-full bg-indigo-600 text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">{{ $i + 1 }}</span>
                    <div>
                        <p class="font-medium text-gray-800 text-sm">{{ $item->text }}</p>
                        @if($item->note)<p class="text-xs text-gray-400 mt-1">{{ $item->note }}</p>@endif
                        @if(!empty($item->sub_items))
                            <ul class="text-xs text-gray-500 mt-1 list-disc list-inside">
                                @foreach($item->sub_items as $sub)<li>{{ $sub }}</li>@endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <form id="delReq{{ $item->id }}" action="{{ route('admin.kp.req.destroy', $item) }}" method="POST">
                    @csrf @method('DELETE')
                </form>
                <button onclick="confirmDelete('delReq{{ $item->id }}')" class="text-red-600 hover:underline text-xs font-semibold flex-shrink-0">Hapus</button>
            </div>
        @empty
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Belum ada persyaratan.</div>
        @endforelse
    </div>
    <p class="text-xs text-gray-400 mt-4">
        Catatan: item dengan sub-poin atau keterangan tambahan (seperti contoh data awal) hanya dapat ditambahkan satu per satu melalui tombol di bawah, karena editor massal di atas hanya mendukung teks polos per baris.
    </p>
    <button onclick="document.getElementById('addReqModal').classList.add('active')"
            class="mt-2 bg-white border-2 border-indigo-200 text-indigo-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-indigo-50">+ Tambah Item dengan Catatan/Sub-poin</button>
</div>

<!-- TAB: Jadwal -->
<div id="tab-jadwal" class="hidden">
    <button onclick="document.getElementById('addJadwalModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 mb-4">+ Tambah Jadwal</button>
    <div class="space-y-3">
        @forelse($jadwal as $item)
            <div class="bg-white rounded-xl shadow-sm border p-4 flex items-start justify-between gap-4">
                <div>
                    <p class="font-bold text-gray-800">{{ $item->periode }}</p>
                    <p class="text-xs text-gray-500">{{ $item->tanggal }}</p>
                    @if($item->keterangan)<p class="text-xs text-gray-400 mt-1">{{ $item->keterangan }}</p>@endif
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <button onclick="document.getElementById('editJadwal{{ $item->id }}').classList.add('active')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                    <form id="delJadwal{{ $item->id }}" action="{{ route('admin.kp.jadwal.destroy', $item) }}" method="POST">
                        @csrf @method('DELETE')
                    </form>
                    <button onclick="confirmDelete('delJadwal{{ $item->id }}')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                </div>
            </div>

            <div id="editJadwal{{ $item->id }}" class="modal-overlay">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
                    <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Jadwal</h3>
                    <form action="{{ route('admin.kp.jadwal.update', $item) }}" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <input type="text" name="periode" value="{{ $item->periode }}" required placeholder="Periode" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <input type="text" name="tanggal" value="{{ $item->tanggal }}" placeholder="Tanggal" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <textarea name="keterangan" placeholder="Keterangan" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">{{ $item->keterangan }}</textarea>
                        <input type="url" name="pdf_url" value="{{ $item->pdf_url }}" placeholder="Link PDF (opsional)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" onclick="document.getElementById('editJadwal{{ $item->id }}').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Belum ada jadwal.</div>
        @endforelse
    </div>
</div>

<!-- Modals -->
<div id="addDataModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Data Pegawai</h3>
        <form action="{{ route('admin.kp.data.store') }}" method="POST" class="space-y-3">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <select onchange="this.parentElement.nextElementSibling.value = this.nextElementSibling.value + '-' + this.value" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                    @php $addM = substr($month, 5, 2); @endphp
                    @foreach(['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $num => $nama)
                        <option value="{{ $num }}" {{ $addM == $num ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
                <select onchange="this.parentElement.nextElementSibling.value = this.value + '-' + this.previousElementSibling.value" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                    @php $addY = substr($month, 0, 4); @endphp
                    @for($y = now()->year - 2; $y <= now()->year + 5; $y++)
                        <option value="{{ $y }}" {{ $y == $addY ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="text" name="name" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="nip" required placeholder="NIP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="grid grid-cols-2 gap-2">
                <input type="text" name="old_rank" required placeholder="Pangkat Lama (cth: III/a)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <input type="text" name="new_rank" required placeholder="Pangkat Baru (cth: III/b)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            </div>
            <input type="date" name="tanggal_usulan" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="url" name="drive_url" placeholder="Link Google Drive (opsional)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addDataModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="addReqModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Persyaratan</h3>
        <form action="{{ route('admin.kp.req.store') }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="text" required placeholder="Teks persyaratan" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="text" name="note" placeholder="Catatan tambahan (opsional)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addReqModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="addJadwalModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Jadwal</h3>
        <form action="{{ route('admin.kp.jadwal.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="periode" required placeholder="Periode (cth: Periode I 2026)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="tanggal" placeholder="Tanggal" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <textarea name="keterangan" placeholder="Keterangan" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="pdf_url" placeholder="Link PDF (opsional)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addJadwalModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showTab(name) {
    ['data','req','jadwal'].forEach(t => {
        document.getElementById('tab-'+t).classList.toggle('hidden', t !== name);
        const btn = document.getElementById('tabBtn-'+t);
        
        // Reset all tabs
        btn.classList.remove('bg-white', 'text-indigo-700', 'shadow-sm', 'text-gray-500', 'hover:text-gray-700');
        
        if (t === name) {
            btn.classList.add('bg-white', 'text-indigo-700', 'shadow-sm');
        } else {
            btn.classList.add('text-gray-500', 'hover:text-gray-700');
        }
    });
}
</script>
@endpush
@endsection
