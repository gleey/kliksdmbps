<?php $__env->startSection('title', 'Uji Kompetensi'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Uji Kompetensi</h1>
    <p class="text-gray-600 mt-2">Rekap dan informasi Uji Kompetensi pegawai per periode</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border p-5 mb-6">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jenis Uji Kompetensi</label>
            <select id="filterJenis" onchange="loadUjiKompetensi()"
                    class="w-full border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                <option value="">Semua Jenis</option>
                <?php $__currentLoopData = $jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($j); ?>"><?php echo e($j); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Periode</label>
            <select id="filterPeriode" onchange="loadUjiKompetensi()"
                    class="w-full border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                <option value="">Semua Periode</option>
                <?php $__currentLoopData = $periodeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p); ?>"><?php echo e($p); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Status</label>
            <select id="filterStatus" onchange="loadUjiKompetensi()"
                    class="w-full border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="Lulus">Lulus</option>
                <option value="Tidak Lulus">Tidak Lulus</option>
                <option value="Belum">Belum</option>
            </select>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg text-gray-800">Hasil Uji Kompetensi <span id="ukCount" class="text-gray-400 font-normal text-sm"></span></h3>
        <button onclick="exportUKExcel()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
            📊 Export Excel
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600">
                    <th class="px-4 py-3 text-left font-semibold">No</th>
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">NIP</th>
                    <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                    <th class="px-4 py-3 text-left font-semibold">Periode</th>
                    <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                </tr>
            </thead>
            <tbody id="ukTableBody">
                <tr><td colspan="7" class="text-center py-10"><div class="spinner mx-auto"></div></td></tr>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let ukData = [];

async function loadUjiKompetensi() {
    const jenis   = document.getElementById('filterJenis').value;
    const periode = document.getElementById('filterPeriode').value;
    const status  = document.getElementById('filterStatus').value;
    const params  = new URLSearchParams({ jenis, periode, status });

    const res = await fetch(`<?php echo e(route('api.uji-kompetensi')); ?>?${params}`);
    ukData    = await res.json();
    renderUKTable(ukData);
}

function statusBadge(status) {
    const map = { Lulus:'bg-green-100 text-green-700', 'Tidak Lulus':'bg-red-100 text-red-700', Belum:'bg-gray-100 text-gray-600' };
    return `<span class="${map[status]||''} px-2 py-1 rounded-full text-xs font-semibold">${status}</span>`;
}

function renderUKTable(data) {
    const tbody = document.getElementById('ukTableBody');
    document.getElementById('ukCount').textContent = `(${data.length} peserta)`;
    if (!data.length) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-10 text-gray-400">Tidak ada data ditemukan.</td></tr>';
        return;
    }
    tbody.innerHTML = data.map((r,i) => `
        <tr class="border-t border-gray-100 hover:bg-gray-50">
            <td class="px-4 py-2.5 text-gray-500">${i+1}</td>
            <td class="px-4 py-2.5 font-medium text-gray-800">${r.name}</td>
            <td class="px-4 py-2.5 text-gray-600 font-mono text-xs">${r.nip}</td>
            <td class="px-4 py-2.5 text-gray-600">${r.jenis}</td>
            <td class="px-4 py-2.5 text-gray-500">${r.periode}</td>
            <td class="px-4 py-2.5 text-gray-500">${r.tanggal||'-'}</td>
            <td class="px-4 py-2.5">${statusBadge(r.status)}</td>
        </tr>`).join('');
}

function exportUKExcel() {
    if (!ukData.length) { alert('Tidak ada data.'); return; }
    const rows = ukData.map((r,i) => ({ No:i+1, Nama:r.name, NIP:r.nip, Jenis:r.jenis, Periode:r.periode, Tanggal:r.tanggal||'', Status:r.status }));
    const ws   = XLSX.utils.json_to_sheet(rows);
    const wb   = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Uji Kompetensi');
    XLSX.writeFile(wb, 'uji_kompetensi.xlsx');
}

loadUjiKompetensi();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/uji-kompetensi/index.blade.php ENDPATH**/ ?>