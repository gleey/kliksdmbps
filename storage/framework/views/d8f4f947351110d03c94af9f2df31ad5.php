<?php $__env->startSection('title', 'Tim Kerja'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Tim SDM & Hukum</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">
        + Tambah Anggota
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-gray-600">
                <th class="px-4 py-3 text-left font-semibold">Foto</th>
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-4 py-3 text-left font-semibold">Jabatan</th>
                <th class="px-4 py-3 text-left font-semibold">No. HP</th>
                <th class="px-4 py-3 text-left font-semibold">Urutan</th>
                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $tim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t border-gray-100">
                    <td class="px-4 py-3">
                        <img src="<?php echo e($item->photo_url); ?>" class="w-10 h-10 rounded-full object-cover">
                    </td>
                    <td class="px-4 py-3 font-semibold text-gray-800"><?php echo e($item->name); ?></td>
                    <td class="px-4 py-3 text-gray-600"><?php echo e($item->position); ?></td>
                    <td class="px-4 py-3 text-gray-500"><?php echo e($item->phone ?: '-'); ?></td>
                    <td class="px-4 py-3 text-gray-500"><?php echo e($item->sort_order); ?></td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.add('active')"
                                    class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                            <form id="delForm<?php echo e($item->id); ?>" action="<?php echo e(route('admin.tim-kerja.destroy', $item)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                            <button onclick="confirmDelete('delForm<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>

                <div id="editModal<?php echo e($item->id); ?>" class="modal-overlay">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Anggota</h3>
                        <form action="<?php echo e(route('admin.tim-kerja.update', $item)); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="text" name="name" value="<?php echo e($item->name); ?>" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="position" value="<?php echo e($item->position); ?>" required placeholder="Jabatan" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="text" name="phone" value="<?php echo e($item->phone); ?>" placeholder="No. HP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="number" name="sort_order" value="<?php echo e($item->sort_order); ?>" placeholder="Urutan" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <input type="file" name="photo" accept="image/*" class="w-full text-sm">
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada anggota tim.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Anggota Tim</h3>
        <form action="<?php echo e(route('admin.tim-kerja.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
            <?php echo csrf_field(); ?>
            <input type="text" name="name" required placeholder="Nama" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="position" required placeholder="Jabatan" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="text" name="phone" placeholder="No. HP" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="number" name="sort_order" placeholder="Urutan" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <input type="file" name="photo" accept="image/*" class="w-full text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/tim-kerja/index.blade.php ENDPATH**/ ?>