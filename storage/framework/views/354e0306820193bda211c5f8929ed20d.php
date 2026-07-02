<?php $__env->startSection('title', 'Kenaikan Gaji Berkala'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
        <span class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-2 rounded-xl">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </span>
        Kenaikan Gaji Berkala
    </h1>
    <p class="text-gray-600 mt-2 ml-14">Rekap pegawai KGB per Kabupaten/Kota dan per Bulan</p>
</div>

<!-- Dashboard Panel -->
<div id="kgbDashboardPanel">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl p-5 text-white shadow-lg"><p class="text-3xl font-bold" id="kgbStatTotal">0</p><p class="text-indigo-200 text-sm mt-1">Total Pegawai</p></div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl p-5 text-white shadow-lg"><p class="text-3xl font-bold" id="kgbStatKabkota">0</p><p class="text-purple-200 text-sm mt-1">Kab/Kota</p></div>
        <div class="bg-gradient-to-br from-sky-500 to-sky-700 rounded-2xl p-5 text-white shadow-lg"><p class="text-3xl font-bold" id="kgbStatBulan">0</p><p class="text-sky-200 text-sm mt-1">Bulan Tersedia</p></div>
        <div class="bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl p-5 text-white shadow-lg"><p class="text-3xl font-bold" id="kgbStatAvg">0</p><p class="text-teal-200 text-sm mt-1">Rata-rata/Kab</p></div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-5 mb-6">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="min-w-36">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Filter Bulan</label>
                <select id="kgbFilterBulanNama" onchange="renderKGBDashboard()" class="w-full p-3 border-2 border-gray-300 rounded-xl bg-white">
                    <option value="">Semua Bulan</option>
                    <?php $__currentLoopData = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m); ?>"><?php echo e($m); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="min-w-32">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Filter Tahun</label>
                <div class="flex gap-1">
                    <select id="kgbFilterTahunSel" onchange="toggleKGBFilterCustomTahun(); renderKGBDashboard();" class="flex-1 p-3 border-2 border-gray-300 rounded-xl bg-white">
                        <option value="">Semua</option>
                        <?php for($y = now()->year - 1; $y <= now()->year + 4; $y++): ?>
                            <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                        <?php endfor; ?>
                        <option value="lainnya">Lainnya...</option>
                    </select>
                    <input id="kgbFilterTahunCustom" type="number" placeholder="Tahun" min="2000" max="2099"
                        class="hidden w-20 p-3 border-2 border-gray-300 rounded-xl" oninput="renderKGBDashboard()">
                </div>
            </div>
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Filter Kab/Kota</label>
                <select id="kgbFilterKabkota" onchange="renderKGBDashboard()" class="w-full p-3 border-2 border-gray-300 rounded-xl bg-white">
                    <option value="">Semua</option>
                </select>
            </div>
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Cari Nama</label>
                <input type="text" id="kgbSearch" oninput="renderKGBDashboard()" placeholder="Ketik nama..." class="w-full p-3 border-2 border-gray-300 rounded-xl">
            </div>
            <button onclick="exportKGBExcel()" class="bg-green-600 text-white px-5 py-3 rounded-xl font-bold hover:bg-green-700 transition shadow">Export Excel</button>
            <button onclick="clearKGBFilter()" class="bg-gray-100 text-gray-600 px-5 py-3 rounded-xl font-semibold hover:bg-gray-200 transition">Reset</button>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-5 mb-6">
        <p class="text-xs font-bold text-gray-500 uppercase mb-3">Rekap per Kab/Kota</p>
        <div id="kgbKabkotaPills" class="flex flex-wrap gap-2"></div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h3 class="font-bold text-lg">Daftar Pegawai KGB</h3>
            <span id="kgbTableCount" class="text-sm bg-gray-100 px-3 py-1 rounded-full font-semibold">0 data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm">
                        <th class="p-3 text-center w-12">No</th>
                        <th class="p-3 text-left sort-btn cursor-pointer" onclick="sortKGBTable('nama')">Nama Pegawai ↕️</th>
                        <th class="p-3 text-left sort-btn cursor-pointer" onclick="sortKGBTable('kabkota')">Kab/Kota ↕️</th>
                        <th class="p-3 text-left sort-btn cursor-pointer" onclick="sortKGBTable('bulan')">Bulan KGB ↕️</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kgbTableBody" class="divide-y divide-gray-100 text-sm">
                    <tr><td colspan="5" class="text-center py-10"><div class="spinner mx-auto"></div></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let kgbAllData = [];
let kgbCurrentData = [];
let kgbSortCol = '';
let kgbSortAsc = true;

async function loadKGBData() {
    try {
        const res = await fetch(`<?php echo e(route('api.kgb-data')); ?>`);
        kgbAllData = await res.json();
        populateKGBDropdowns();
        renderKGBDashboard();
    } catch (e) {
        console.error(e);
        document.getElementById('kgbTableBody').innerHTML = `<tr><td colspan="5" class="text-center py-10 text-red-500">Gagal memuat data</td></tr>`;
    }
}

function populateKGBDropdowns() {
    const kabSet = [...new Set(kgbAllData.map(r => r.kabkota))].sort();
    const kabSel = document.getElementById('kgbFilterKabkota');
    kabSel.innerHTML = '<option value="">Semua</option>' + kabSet.map(k => `<option value="${k}">${k}</option>`).join('');
}

function toggleKGBFilterCustomTahun() {
    const sel = document.getElementById('kgbFilterTahunSel');
    const inp = document.getElementById('kgbFilterTahunCustom');
    if (!sel || !inp) return;
    inp.classList.toggle('hidden', sel.value !== 'lainnya');
}

function getKGBFilterBulan() {
    const bulanNama = document.getElementById('kgbFilterBulanNama')?.value || '';
    const tahunSel = document.getElementById('kgbFilterTahunSel')?.value || '';
    const tahunCustom = document.getElementById('kgbFilterTahunCustom')?.value || '';
    const tahun = tahunSel === 'lainnya' ? tahunCustom : tahunSel;
    return { bulanNama, tahun };
}

function renderKGBDashboard() {
    const { bulanNama, tahun } = getKGBFilterBulan();
    const kabkota = document.getElementById('kgbFilterKabkota')?.value || '';
    const search = (document.getElementById('kgbSearch')?.value || '').toLowerCase();

    kgbCurrentData = kgbAllData.filter(r => {
        let match = true;
        if (bulanNama && !r.bulan.includes(bulanNama)) match = false;
        if (tahun && !r.bulan.includes(tahun)) match = false;
        if (kabkota && r.kabkota !== kabkota) match = false;
        if (search && !r.nama.toLowerCase().includes(search)) match = false;
        return match;
    });

    if (kgbSortCol) {
        kgbCurrentData.sort((a, b) => {
            let v1 = a[kgbSortCol] || '', v2 = b[kgbSortCol] || '';
            if (v1 < v2) return kgbSortAsc ? -1 : 1;
            if (v1 > v2) return kgbSortAsc ? 1 : -1;
            return 0;
        });
    }

    // Hitung stats
    const uniqueKab = new Set(kgbCurrentData.map(r => r.kabkota)).size;
    const uniqueBulan = new Set(kgbCurrentData.map(r => r.bulan)).size;
    const avg = uniqueKab ? Math.round(kgbCurrentData.length / uniqueKab) : 0;

    document.getElementById('kgbStatTotal').textContent = kgbCurrentData.length;
    document.getElementById('kgbStatKabkota').textContent = uniqueKab;
    document.getElementById('kgbStatBulan').textContent = uniqueBulan;
    document.getElementById('kgbStatAvg').textContent = avg;

    document.getElementById('kgbTableCount').textContent = kgbCurrentData.length + ' data';

    // Kab/Kota Pills
    const kabMap = {};
    kgbCurrentData.forEach(r => kabMap[r.kabkota] = (kabMap[r.kabkota] || 0) + 1);
    const pillsHTML = Object.entries(kabMap).sort((a,b) => b[1] - a[1]).map(([k, count]) => 
        `<span class="bg-indigo-50 text-indigo-700 px-3 py-1.5 rounded-full text-sm font-semibold border border-indigo-100 shadow-sm">${k} <span class="bg-white text-indigo-700 text-xs px-2 py-0.5 rounded-full ml-1 font-bold">${count}</span></span>`
    ).join('');
    document.getElementById('kgbKabkotaPills').innerHTML = pillsHTML || '<span class="text-gray-400 text-sm">Tidak ada data</span>';

    // Tabel
    const tbody = document.getElementById('kgbTableBody');
    if (!kgbCurrentData.length) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-center py-12 text-gray-500 font-medium">Tidak ada data ditemukan</td></tr>`;
        return;
    }
    tbody.innerHTML = kgbCurrentData.map((r, i) => `
        <tr class="hover:bg-indigo-50 transition">
            <td class="p-3 text-center text-gray-400">${i + 1}</td>
            <td class="p-3 font-semibold">${r.nama}</td>
            <td class="p-3 text-indigo-700 font-medium bg-indigo-50/50">${r.kabkota}</td>
            <td class="p-3"><span class="flex items-center gap-1 text-gray-600"><svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>${r.bulan}</span></td>
            <td class="p-3 text-center text-gray-400">—</td>
        </tr>`).join('');
}

function clearKGBFilter() {
    document.getElementById('kgbFilterBulanNama').value = '';
    document.getElementById('kgbFilterTahunSel').value = '';
    document.getElementById('kgbFilterTahunCustom').value = '';
    document.getElementById('kgbFilterTahunCustom').classList.add('hidden');
    document.getElementById('kgbFilterKabkota').value = '';
    document.getElementById('kgbSearch').value = '';
    kgbSortCol = '';
    renderKGBDashboard();
}

function sortKGBTable(col) {
    if (kgbSortCol === col) kgbSortAsc = !kgbSortAsc;
    else { kgbSortCol = col; kgbSortAsc = true; }
    renderKGBDashboard();
}

function exportKGBExcel() {
    if (!kgbCurrentData.length) { alert('Tidak ada data.'); return; }
    const { bulanNama, tahun } = getKGBFilterBulan();
    const kabkota = document.getElementById('kgbFilterKabkota')?.value || '';
    
    let title = 'REKAP KGB';
    if (bulanNama) title += ' - ' + bulanNama;
    if (tahun) title += ' ' + tahun;
    if (kabkota) title += ' (' + kabkota + ')';
    
    const aoa = [
        [title, '', '', ''],
        ['No', 'Nama Pegawai', 'Kab/Kota', 'Bulan KGB'],
        ...kgbCurrentData.map((r, i) => [i + 1, r.nama, r.kabkota, r.bulan])
    ];
    
    const ws = XLSX.utils.aoa_to_sheet(aoa);
    ws['!cols'] = [{ wch: 5 }, { wch: 35 }, { wch: 30 }, { wch: 20 }];
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'KGB');
    XLSX.writeFile(wb, `Rekap_KGB_${Date.now()}.xlsx`);
}

loadKGBData();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/kgb/index.blade.php ENDPATH**/ ?>