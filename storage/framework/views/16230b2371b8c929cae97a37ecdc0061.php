<?php $__env->startSection('title', 'Pengaturan'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Website</h1>

<div class="bg-white rounded-2xl shadow-sm border p-6 max-w-2xl">
    <h3 class="font-bold text-lg text-gray-800 mb-4">Teks Berjalan (Running Text)</h3>
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="space-y-3">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <textarea name="scrolling_text" rows="3" required
                  class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500"><?php echo e($scrollingText); ?></textarea>
        <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700">Simpan Pengaturan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>