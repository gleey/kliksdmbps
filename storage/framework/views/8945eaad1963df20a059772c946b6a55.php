<?php $__env->startSection('title', 'Kenaikan Gaji Berkala'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Data Kenaikan Gaji Berkala (KGB)</h1>

<!-- Upload Excel -->
<div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">
    <h3 class="font-bold text-lg text-gray-800 mb-1">Upload Data dari Excel</h3>
    <p class="text-gray-500 text-sm mb-4">
        Baris pertama harus berupa header (<code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">No</code>,
        <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">Nama Pegawai</code>). Kolom A = nomor urut, kolom B = nama pegawai.
    </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kabupaten / Kota</label>
            <select id="uploadKabkota" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm">
                <option value="">-- Pilih --</option>
                <?php $__currentLoopData = $kabkotaOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kk); ?>"><?php echo e($kk); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Bulan & Tahun KGB</label>
            <div class="flex gap-2">
                <select id="uploadBulanNama" class="flex-1 border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm">
                    <option value="">-- Bulan --</option>
                    <?php $__currentLoopData = $bulanNamaOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($bn); ?>"><?php echo e($bn); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <select id="uploadTahun" class="w-28 border-2 border-gray-200 rounded-lg px-3 py-2.5 text-sm">
                    <?php for($y = now()->year - 1; $y <= now()->year + 4; $y++): ?>
                        <option value="<?php echo e($y); ?>" <?php echo e($y === now()->year ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <input type="file" id="uploadFile" accept=".xlsx,.xls,.csv" class="border-2 border-gray-200 rounded-lg px-3 py-2 text-sm w-full mb-4">
    <button onclick="processUpload()" id="uploadBtn"
            class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">
        Proses Upload
    </button>
    <p id="uploadStatus" class="text-sm mt-3"></p>
</div>

<!-- Filter & Table -->
<div class="bg-white rounded-2xl shadow-sm border p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg text-gray-800">Data KGB Tersimpan</h3>
        <form method="GET" class="flex gap-2">
            <select name="bulan" onchange="this.form.submit()" class="border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Bulan</option>
                <?php $__currentLoopData = $bulanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($b); ?>" <?php echo e($bulan === $b ? 'selected' : ''); ?>><?php echo e($b); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="kabkota" onchange="this.form.submit()" class="border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Kab/Kota</option>
                <?php $__currentLoopData = $kabkotaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>" <?php echo e($kabkota === $k ? 'selected' : ''); ?>><?php echo e($k); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>
    </div>
    <div class="overflow-x-auto max-h-[480px] overflow-y-auto">
        <table class="w-full text-sm">
            <thead class="sticky top-0 bg-gray-50">
                <tr class="text-gray-600">
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">Kab/Kota</th>
                    <th class="px-4 py-3 text-left font-semibold">Bulan</th>
                    <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-2.5 font-medium text-gray-800"><?php echo e($item->nama); ?></td>
                        <td class="px-4 py-2.5 text-gray-600"><?php echo e($item->kabkota); ?></td>
                        <td class="px-4 py-2.5 text-gray-500"><?php echo e($item->bulan); ?></td>
                        <td class="px-4 py-2.5">
                            <div class="flex gap-2">
                                <button onclick="document.getElementById('editRow<?php echo e($item->id); ?>').classList.add('active')"
                                        class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                                <form id="delRow<?php echo e($item->id); ?>" action="<?php echo e(route('admin.kgb.destroyRow', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                </form>
                                <button onclick="confirmDelete('delRow<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                            </div>
                        </td>
                    </tr>

                    <div id="editRow<?php echo e($item->id); ?>" class="modal-overlay">
                        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Data KGB</h3>
                            <form action="<?php echo e(route('admin.kgb.update', $item->id)); ?>" method="POST" class="space-y-3">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="nama" value="<?php echo e($item->nama); ?>" required placeholder="Nama Pegawai" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <select name="kabkota" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                    <?php $__currentLoopData = $kabkotaOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kk); ?>" <?php echo e($item->kabkota === $kk ? 'selected' : ''); ?>><?php echo e($kk); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="text" name="bulan" value="<?php echo e($item->bulan); ?>" required placeholder="Bulan KGB (cth: Januari 2026)" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" onclick="document.getElementById('editRow<?php echo e($item->id); ?>').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="text-center py-10 text-gray-400">Tidak ada data.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
async function processUpload() {
    const kabkota   = document.getElementById('uploadKabkota').value;
    const bulanNama = document.getElementById('uploadBulanNama').value;
    const tahun     = document.getElementById('uploadTahun').value;
    const file      = document.getElementById('uploadFile').files[0];
    const status    = document.getElementById('uploadStatus');

    if (!kabkota || !bulanNama || !tahun || !file) {
        status.innerHTML = '<span class="text-red-600">Harap lengkapi Kab/Kota, Bulan, Tahun, dan pilih file.</span>';
        return;
    }
    const bulan = `${bulanNama} ${tahun}`;

    status.innerHTML = '<span class="text-blue-600">Membaca file...</span>';

    const reader = new FileReader();
    reader.onload = async (e) => {
        try {
            const wb = XLSX.read(e.target.result, { type: 'array' });
            const sheet = wb.Sheets[wb.SheetNames[0]];
            const json = XLSX.utils.sheet_to_json(sheet);

            const rows = json.map(row => {
                const key = Object.keys(row).find(k => k.toLowerCase().includes('nama'));
                return { nama: key ? String(row[key]).trim() : null };
            }).filter(r => r.nama);

            if (!rows.length) {
                status.innerHTML = '<span class="text-red-600">Tidak ditemukan kolom "Nama Pegawai" yang valid di file.</span>';
                return;
            }

            status.innerHTML = `<span class="text-blue-600">Mengupload ${rows.length} baris...</span>`;

            const res = await fetch('<?php echo e(route('admin.kgb.bulk')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ kabkota, bulan, rows }),
            });
            const result = await res.json();

            if (result.success) {
                status.innerHTML = `<span class="text-green-600">✅ Berhasil mengupload ${result.count} data. Memuat ulang halaman...</span>`;
                setTimeout(() => location.reload(), 1200);
            } else {
                status.innerHTML = '<span class="text-red-600">Gagal mengupload data.</span>';
            }
        } catch (err) {
            status.innerHTML = `<span class="text-red-600">Error: ${err.message}</span>`;
        }
    };
    reader.readAsArrayBuffer(file);
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/kgb/index.blade.php ENDPATH**/ ?>