<?php $__env->startSection('title', 'Galeri'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Galeri SDM</h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">
        + Tambah Foto
    </button>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
    <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="aspect-video bg-gray-100">
                <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-full object-cover">
            </div>
            <div class="p-3">
                <p class="text-sm font-semibold text-gray-800 truncate"><?php echo e($item->title); ?></p>
                <div class="flex gap-3 mt-2">
                    <button onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.add('active')"
                            class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                    <form id="delForm<?php echo e($item->id); ?>" action="<?php echo e(route('admin.gallery.destroy', $item)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    </form>
                    <button onclick="confirmDelete('delForm<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                </div>
            </div>
        </div>

        <!-- Per-item Edit Modal -->
        <div id="editModal<?php echo e($item->id); ?>" class="modal-overlay">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Foto</h3>
                <form action="<?php echo e(route('admin.gallery.update', $item)); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Judul</label>
                        <input type="text" name="title" value="<?php echo e($item->title); ?>" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Ganti Foto (opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm">
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" onclick="document.getElementById('editModal<?php echo e($item->id); ?>').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full bg-white rounded-xl border p-10 text-center text-gray-400">Belum ada foto.</div>
    <?php endif; ?>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Foto</h3>
        <form action="<?php echo e(route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Judul</label>
                <input type="text" name="title" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Foto</label>
                <input type="file" name="image" accept="image/*" required class="w-full text-sm">
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>