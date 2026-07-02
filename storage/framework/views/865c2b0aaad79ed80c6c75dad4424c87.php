<?php $__env->startSection('title', 'Peraturan'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Peraturan</h1>
    <form method="GET" action="<?php echo e(route('peraturan')); ?>">
        <select name="kategori" onchange="this.form.submit()"
                class="border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k); ?>" <?php echo e($kategori === $k ? 'selected' : ''); ?>><?php echo e($k); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>
</div>

<?php if($peraturan->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border p-16 text-center text-gray-400">Belum ada peraturan.</div>
<?php else: ?>
    <div class="space-y-4">
        <?php $__currentLoopData = $peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-sm border p-5 card-hover">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <?php if($item->kategori): ?>
                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full"><?php echo e($item->kategori); ?></span>
                            <?php endif; ?>
                            <?php if($item->tahun): ?>
                                <span class="text-gray-400 text-xs"><?php echo e($item->tahun); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-0.5"><?php echo e($item->judul); ?></h3>
                        <?php if($item->nomor): ?>
                            <p class="text-sm text-gray-500 mb-1"><?php echo e($item->nomor); ?></p>
                        <?php endif; ?>
                        <?php if($item->deskripsi): ?>
                            <p class="text-sm text-gray-600"><?php echo e($item->deskripsi); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if($item->url): ?>
                        <a href="<?php echo e($item->url); ?>" target="_blank"
                           class="flex-shrink-0 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center gap-1">
                            🔗 Buka
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/peraturan/index.blade.php ENDPATH**/ ?>