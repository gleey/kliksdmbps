<?php $__env->startSection('title', 'Uji Kompetensi'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Uji Kompetensi</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">+ Tambah Data</button>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-gray-600">
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-4 py-3 text-left font-semibold">NIP</th>
                <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                <th class="px-4 py-3 text-left font-semibold">Periode</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t border-gray-100">
                    <td class="px-4 py-3 font-semibold text-gray-800"><?php echo e($item->name); ?></td>
                    <td class="px-4 py-3 text-gray-600 font-mono text-xs"><?php echo e($item->nip); ?></td>
                    <td class="px-4 py-3"><?php echo e($item->jenis); ?></td>
                    <td class="px-4 py-3"><?php echo e($item->periode); ?></td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo e(['Lulus'=>'bg-green-100 text-green-700','Tidak Lulus'=>'bg-red-100 text-red-700','Belum'=>'bg-gray-100 text-gray-600'][$item->status]); ?>"><?php echo e($item->status); ?></span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.add('active')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                            <form id="delUk<?php echo e($item->id); ?>" action="<?php echo e(route('admin.uji-kompetensi.destroy', $item)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                            <button onclick="confirmDelete('delUk<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>

                <div id="editModal<?php echo e($item->id); ?>" class="modal-overlay">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Data</h3>
                        <form action="<?php echo e(route('admin.uji-kompetensi.update', $item)); ?>" method="POST" class="space-y-3">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="text" name="name" value="<?php echo e($item->name); ?>" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="nip" value="<?php echo e($item->nip); ?>" required placeholder="NIP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="jenis" value="<?php echo e($item->jenis); ?>" required placeholder="Jenis" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="periode" value="<?php echo e($item->periode); ?>" required placeholder="Periode" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="tanggal" value="<?php echo e($item->tanggal); ?>" placeholder="Tanggal" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <select name="status" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                                <?php $__currentLoopData = ['Lulus','Tidak Lulus','Belum']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s); ?>" <?php echo e($item->status === $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <textarea name="keterangan" placeholder="Keterangan" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"><?php echo e($item->keterangan); ?></textarea>
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Data Uji Kompetensi</h3>
        <form action="<?php echo e(route('admin.uji-kompetensi.store')); ?>" method="POST" class="space-y-3">
            <?php echo csrf_field(); ?>
            <input type="text" name="name" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="nip" required placeholder="NIP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="jenis" required placeholder="Jenis Uji Kompetensi" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="periode" required placeholder="Periode" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="tanggal" placeholder="Tanggal" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <select name="status" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option value="Belum">Belum</option>
                <option value="Lulus">Lulus</option>
                <option value="Tidak Lulus">Tidak Lulus</option>
            </select>
            <textarea name="keterangan" placeholder="Keterangan" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/uji-kompetensi/index.blade.php ENDPATH**/ ?>