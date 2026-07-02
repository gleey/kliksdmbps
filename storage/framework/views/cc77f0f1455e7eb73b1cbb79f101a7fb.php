<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola <?php echo e($title); ?></h1>
    <button onclick="document.getElementById('addModal').classList.add('active')"
            class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">+ Tambah Item</button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Persyaratan -->
    <div class="bg-white rounded-2xl shadow-sm border p-5">
        <h3 class="font-bold text-gray-800 mb-3">📋 Persyaratan</h3>
        <div class="space-y-2">
            <?php $__empty_1 = true; $__currentLoopData = $persyaratan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-start justify-between gap-3 bg-gray-50 rounded-lg p-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm"><?php echo e($item->title); ?></p>
                        <?php if($item->description): ?><p class="text-xs text-gray-500 mt-0.5"><?php echo e($item->description); ?></p><?php endif; ?>
                        <a href="<?php echo e($item->url); ?>" target="_blank" class="text-xs text-blue-600 hover:underline"><?php echo e($item->url); ?></a>
                    </div>
                    <div class="flex flex-col gap-1 flex-shrink-0">
                        <button onclick="editItem('persyaratan', <?php echo e($item->id); ?>, '<?php echo e(addslashes($item->title)); ?>', '<?php echo e(addslashes($item->description ?? '')); ?>', '<?php echo e(addslashes($item->url)); ?>')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                        <button onclick="deleteItem('persyaratan', <?php echo e($item->id); ?>)" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-400 text-sm text-center py-6">Belum ada persyaratan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Dokumen -->
    <div class="bg-white rounded-2xl shadow-sm border p-5">
        <h3 class="font-bold text-gray-800 mb-3">📁 Dokumen</h3>
        <div class="space-y-2">
            <?php $__empty_1 = true; $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-start justify-between gap-3 bg-indigo-50 rounded-lg p-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm"><?php echo e($item->title); ?></p>
                        <?php if($item->description): ?><p class="text-xs text-gray-500 mt-0.5"><?php echo e($item->description); ?></p><?php endif; ?>
                        <a href="<?php echo e($item->url); ?>" target="_blank" class="text-xs text-indigo-600 hover:underline"><?php echo e($item->url); ?></a>
                    </div>
                    <div class="flex flex-col gap-1 flex-shrink-0">
                        <button onclick="editItem('dokumen', <?php echo e($item->id); ?>, '<?php echo e(addslashes($item->title)); ?>', '<?php echo e(addslashes($item->description ?? '')); ?>', '<?php echo e(addslashes($item->url)); ?>')" class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                        <button onclick="deleteItem('dokumen', <?php echo e($item->id); ?>)" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-400 text-sm text-center py-6">Belum ada dokumen.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Item</h3>
        <form action="<?php echo e(route('admin.layanan.store', $type)); ?>" method="POST" class="space-y-3">
            <?php echo csrf_field(); ?>
            <select name="kategori" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option value="persyaratan">Persyaratan</option>
                <option value="dokumen">Dokumen</option>
            </select>
            <input type="text" name="title" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <textarea name="description" placeholder="Deskripsi (opsional)" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="url" required placeholder="URL dokumen/link" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
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
        <h3 class="font-bold text-lg text-gray-800 mb-4">Edit Item</h3>
        <form id="editForm" method="POST" class="space-y-3">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <input type="hidden" name="kategori" id="editKategori">
            <input type="text" name="title" id="editTitle" required placeholder="Judul" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <textarea name="description" id="editDescription" placeholder="Deskripsi (opsional)" rows="2" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
            <input type="url" name="url" id="editUrl" required placeholder="URL dokumen/link" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm">
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('editModal').classList.remove('active')" class="px-4 py-2 text-sm font-semibold text-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Hidden delete form -->
<form id="deleteForm" method="POST" class="hidden">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    <input type="hidden" name="kategori" id="deleteKategori">
</form>

<?php $__env->startPush('scripts'); ?>
<script>
const layananType = <?php echo json_encode($type, 15, 512) ?>;

function editItem(kategori, id, title, description, url) {
    document.getElementById('editForm').action = `/admin/layanan/${layananType}/${id}`;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;
    document.getElementById('editUrl').value = url;
    document.getElementById('editModal').classList.add('active');
}

function deleteItem(kategori, id) {
    if (!confirm('Yakin ingin menghapus item ini?')) return;
    document.getElementById('deleteForm').action = `/admin/layanan/${layananType}/${id}`;
    document.getElementById('deleteKategori').value = kategori;
    document.getElementById('deleteForm').submit();
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/layanan-crud.blade.php ENDPATH**/ ?>