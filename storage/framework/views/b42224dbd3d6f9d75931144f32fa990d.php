<?php $__env->startSection('title', 'Pengumuman'); ?>
<?php $__env->startSection('content'); ?>
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
            <?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t border-gray-100">
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-800"><?php echo e($item->title); ?></p>
                        <p class="text-gray-500 text-xs mt-0.5 line-clamp-1"><?php echo e($item->content); ?></p>
                    </td>
                    <td class="px-4 py-3 text-gray-500"><?php echo e($item->date?->format('d M Y')); ?></td>
                    <td class="px-4 py-3">
                        <form action="<?php echo e(route('admin.pengumuman.toggle', $item)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="px-2 py-1 rounded-full text-xs font-semibold <?php echo e($item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'); ?>">
                                <?php echo e($item->is_active ? 'Aktif' : 'Nonaktif'); ?>

                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="editPengumuman(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->title)); ?>', '<?php echo e(addslashes($item->content)); ?>', '<?php echo e($item->date?->format('Y-m-d')); ?>')"
                                    class="text-blue-600 hover:underline text-xs font-semibold">Edit</button>
                            <form id="delForm<?php echo e($item->id); ?>" action="<?php echo e(route('admin.pengumuman.destroy', $item)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                            <button onclick="confirmDelete('delForm<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="text-center py-10 text-gray-400">Belum ada pengumuman.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Tambah Pengumuman</h3>
        <form action="<?php echo e(route('admin.pengumuman.store')); ?>" method="POST" class="space-y-3">
            <?php echo csrf_field(); ?>
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
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
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

<?php $__env->startPush('scripts'); ?>
<script>
function editPengumuman(id, title, content, date) {
    document.getElementById('editForm').action = `/admin/pengumuman/${id}`;
    document.getElementById('editTitle').value = title;
    document.getElementById('editContent').value = content;
    document.getElementById('editDate').value = date;
    document.getElementById('editModal').classList.add('active');
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>