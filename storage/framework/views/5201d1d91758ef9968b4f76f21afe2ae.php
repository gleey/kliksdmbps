<?php $__env->startSection('title', 'Galeri SDM'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Galeri SDM</h1>
    <p class="text-gray-600 mt-2">Dokumentasi kegiatan dan aktivitas SDM BPS Provinsi Sulawesi Utara</p>
</div>
<?php if($gallery->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border p-16 text-center text-gray-400">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Belum ada foto di galeri.
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover group">
                <div class="aspect-video bg-gray-100 overflow-hidden">
                    <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-3">
                    <p class="text-sm font-semibold text-gray-700 truncate"><?php echo e($item->title); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/gallery/index.blade.php ENDPATH**/ ?>