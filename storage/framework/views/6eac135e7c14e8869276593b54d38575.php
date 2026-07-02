<?php $__env->startSection('title', 'Kenaikan Pangkat'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Kenaikan Pangkat</h1>
    <p class="text-gray-600 mt-2">Informasi, persyaratan, jadwal, dan rekap kenaikan pangkat pegawai</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Persyaratan -->
    <div class="bg-white rounded-2xl shadow-sm border p-6">
        <div class="flex items-center gap-3 mb-5">
            <span class="bg-blue-100 text-blue-700 rounded-xl p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </span>
            <h3 class="font-bold text-xl text-gray-800">Persyaratan Kenaikan Pangkat</h3>
        </div>

        <?php if($requirements->isEmpty()): ?>
            <p class="text-gray-400 text-sm text-center py-4">Belum ada persyaratan.</p>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="kp-req-item <?php echo e(count($req->sub_items ?? []) > 0 ? 'has-sub' : ''); ?>">
                        <div class="kp-req-num"><?php echo e($i + 1); ?></div>
                        <div class="flex-1">
                            <p class="text-gray-700 font-medium text-sm"><?php echo e($req->text); ?></p>
                            <?php if($req->note): ?>
                                <span class="kp-req-note"><?php echo e($req->note); ?></span>
                            <?php endif; ?>
                            <?php if(!empty($req->sub_items)): ?>
                                <div class="kp-req-sub">
                                    <?php $__currentLoopData = $req->sub_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="kp-req-sub-item"><?php echo e($sub); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Jadwal -->
    <div class="bg-white rounded-2xl shadow-sm border p-6">
        <div class="flex items-center gap-3 mb-5">
            <span class="bg-green-100 text-green-700 rounded-xl p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </span>
            <h3 class="font-bold text-xl text-gray-800">Jadwal Periode Kenaikan Pangkat</h3>
        </div>
        <?php if($jadwal->isEmpty()): ?>
            <p class="text-gray-400 text-sm text-center py-4">Belum ada jadwal.</p>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                        <p class="font-bold text-gray-800"><?php echo e($j->periode); ?></p>
                        <?php if($j->tanggal): ?>
                            <p class="text-sm text-gray-600 mt-1">📅 <?php echo e($j->tanggal); ?></p>
                        <?php endif; ?>
                        <?php if($j->keterangan): ?>
                            <p class="text-sm text-gray-500 mt-1"><?php echo e($j->keterangan); ?></p>
                        <?php endif; ?>
                        <?php if($j->pdf_url): ?>
                            <a href="<?php echo e($j->pdf_url); ?>" target="_blank"
                               class="inline-flex items-center gap-1 mt-2 text-xs font-semibold text-red-600 hover:underline">
                                📄 Unduh PDF
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Rekap Data KP -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="font-bold text-xl mb-4 text-gray-800">Rekap Bulanan Kenaikan Pangkat</h3>
    <div class="flex flex-wrap gap-3 mb-6">
        <select id="kpMonthSelect" onchange="loadKPRecap()" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="all">Semua Bulan</option>
            <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option>
            <option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option>
            <option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option>
            <option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
        </select>
        <select id="kpYearSelect" onchange="loadKPRecap()" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="all">Semua Tahun</option>
            <option value="2025">2025</option><option value="2026" selected>2026</option><option value="2027">2027</option>
            <option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option>
            <option value="lainnya">Lainnya...</option>
        </select>
        <input id="kpYearCustom" type="number" placeholder="Masukkan tahun" min="2000" max="2099"
            class="hidden p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 w-40"
            onchange="loadKPRecap()">
        <button onclick="exportKPToExcel()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold shadow-md">Export Excel</button>
    </div>
    
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm text-center"><p class="text-3xl font-bold text-blue-600" id="statTotal">0</p><p class="text-xs text-gray-500 mt-1">Total Pegawai</p></div>
            <div class="bg-white rounded-xl p-4 shadow-sm text-center"><p class="text-3xl font-bold text-green-600" id="statGolIII">0</p><p class="text-xs text-gray-500 mt-1">Golongan III</p></div>
            <div class="bg-white rounded-xl p-4 shadow-sm text-center"><p class="text-3xl font-bold text-purple-600" id="statGolIV">0</p><p class="text-xs text-gray-500 mt-1">Golongan IV</p></div>
            <div class="bg-white rounded-xl p-4 shadow-sm text-center"><p class="text-3xl font-bold text-orange-500" id="statGolII">0</p><p class="text-xs text-gray-500 mt-1">Golongan II</p></div>
        </div>
        <div class="chart-container bg-white rounded-xl p-4 shadow-sm" style="position:relative;height:320px;width:100%;"><canvas id="kpChart"></canvas></div>
    </div>

    <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">Daftar Pegawai yang akan naik pangkat</h2>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Pegawai</th>
                    <th class="p-3 text-left">NIP</th>
                    <th class="p-3 text-left">Pangkat Lama</th>
                    <th class="p-3 text-left">Pangkat Baru</th>
                    <th class="p-3 text-left">Tanggal Usulan</th>
                    <th class="p-3 text-center">Link Drive</th>
                </tr>
            </thead>
            <tbody id="kpTableBody" class="divide-y divide-gray-200">
                <tr><td colspan="7" class="text-center py-8 text-gray-500">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let kpChart = null;
let kpData  = [];

function getKPMonthValue() {
    const bulan = document.getElementById('kpMonthSelect').value || 'all';
    const tahunSel = document.getElementById('kpYearSelect').value || 'all';
    const tahunCustom = document.getElementById('kpYearCustom').value || '';
    const tahun = tahunSel === 'lainnya' ? (tahunCustom || new Date().getFullYear()) : tahunSel;
    
    const customEl = document.getElementById('kpYearCustom');
    if (customEl) customEl.classList.toggle('hidden', tahunSel !== 'lainnya');
    
    if (bulan === 'all' || tahun === 'all') return 'all';
    return `${tahun}-${bulan}`;
}

async function loadKPRecap() {
    const month = getKPMonthValue();
    const res   = await fetch(`<?php echo e(route('api.kp-data')); ?>?month=${month}`);
    kpData      = await res.json();
    
    const s = getGolStats(kpData);
    document.getElementById('statTotal').textContent = kpData.length;
    document.getElementById('statGolIII').textContent = s['Gol III'];
    document.getElementById('statGolIV').textContent = s['Gol IV'];
    document.getElementById('statGolII').textContent = s['Gol II'];
    
    renderKPTable(kpData);
    drawKPChart(kpData);
}

function renderKPTable(data) {
    const tbody = document.getElementById('kpTableBody');
    if (!data.length) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-500">Belum ada data untuk periode ini</td></tr>';
        return;
    }
    tbody.innerHTML = data.map((r, i) => `
        <tr class="hover:bg-blue-50 transition">
            <td class="p-3 text-center font-semibold">${i + 1}</td>
            <td class="p-3 font-semibold">${r.name}</td>
            <td class="p-3">${r.nip}</td>
            <td class="p-3">${r.old_rank}</td>
            <td class="p-3 text-green-700 font-semibold">${r.new_rank}</td>
            <td class="p-3 text-center">${r.tanggal_usulan ? new Date(r.tanggal_usulan).toLocaleDateString('id-ID') : '—'}</td>
            <td class="p-3 text-center">${r.drive_url ? `<a href="${r.drive_url}" target="_blank" class="text-blue-600 hover:underline text-sm font-semibold">Klik disini</a>` : '—'}</td>
        </tr>`).join('');
}

function getGolStats(data) {
    const s = { 'Gol IV': 0, 'Gol III': 0, 'Gol II': 0, 'Fungsional': 0 };
    data.forEach(r => {
        const x = (r.new_rank || r.old_rank || '').toLowerCase().trim();
        const compact = x.replace(/[\s./-]/g, '');
        const isGolIV = compact.startsWith('iv') || /\bgol(?:ongan)?\s*iv\b/.test(x) || x.includes('pembina');
        const isGolIII = compact.startsWith('iii') || /\bgol(?:ongan)?\s*iii\b/.test(x) || x.includes('penata');
        const isGolII = compact.startsWith('ii') || /\bgol(?:ongan)?\s*ii\b/.test(x) || x.includes('pengatur');

        if (isGolIV) s['Gol IV']++;
        else if (isGolIII) s['Gol III']++;
        else if (isGolII) s['Gol II']++;
        else s['Fungsional']++;
    });
    return s;
}

function drawKPChart(data) {
    const ctx = document.getElementById('kpChart').getContext('2d');
    const s = getGolStats(data);
    const lbls = Object.keys(s).filter(k => s[k] > 0);
    
    if (kpChart) { kpChart.destroy(); kpChart = null; }
    if (!lbls.length) return;
    
    const chartLabels = lbls.map(l => l === 'Fungsional' ? 'Golongan Fungsional' : l);
    kpChart = new Chart(ctx, {
        type: 'bar',
        data: { 
            labels: chartLabels, 
            datasets: [{ 
                label: 'Jumlah', 
                data: lbls.map(k => s[k]), 
                backgroundColor: ['rgba(245,158,11,.85)', 'rgba(59,130,246,.85)', 'rgba(139,92,246,.85)', 'rgba(16,185,129,.85)'], 
                borderWidth: 2, 
                borderRadius: 8 
            }] 
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } }, x: { grid: { display: false } } } }
    });
}

function exportKPToExcel() {
    if (!kpData.length) { alert('Tidak ada data untuk diekspor.'); return; }
    const mv = getKPMonthValue();
    const ml = (mv && mv !== 'all') ? new Date(mv + '-01').toLocaleDateString('id-ID', { month: 'long', year: 'numeric' }) : 'Semua Periode';
    
    const aoa = [
        ['REKAP KENAIKAN PANGKAT - ' + ml.toUpperCase(), '', '', '', '', '', ''], 
        ['No', 'Nama', 'NIP', 'Pangkat Lama', 'Pangkat Baru', 'Tanggal Usulan', 'Link Upload'], 
        ...kpData.map((r, i) => [i + 1, r.name, r.nip, r.old_rank, r.new_rank, r.tanggal_usulan || '', r.drive_url || ''])
    ];
    
    const ws  = XLSX.utils.aoa_to_sheet(aoa);
    const wb  = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'KP Data');
    XLSX.writeFile(wb, `rekap_kp_${(mv && mv !== 'all') ? mv : 'semua'}.xlsx`);
}

loadKPRecap();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/kenaikan-pangkat/index.blade.php ENDPATH**/ ?>