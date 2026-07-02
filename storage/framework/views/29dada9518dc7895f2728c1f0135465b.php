<?php $__env->startSection('title', 'Tim SDM & Hukum'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Tim SDM &amp; Hukum</h1>
    <p class="text-gray-600 mt-2">Anggota tim Sub Bagian SDM dan Hukum BPS Provinsi Sulawesi Utara</p>
</div>
<?php if($tim->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border p-16 text-center text-gray-400">Belum ada data tim kerja.</div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php $__currentLoopData = $tim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-2xl shadow-sm border p-5 text-center card-hover">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-3 bg-gray-100 border-4 border-blue-100">
                    <img src="<?php echo e($member->photo_url); ?>" alt="<?php echo e($member->name); ?>"
                         class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($member->name)); ?>&background=1e40af&color=fff'">
                </div>
                <p class="font-bold text-gray-800"><?php echo e($member->name); ?></p>
                <p class="text-blue-600 text-sm mt-0.5"><?php echo e($member->position); ?></p>
                <?php if($member->phone): ?>
                    <p class="text-gray-500 text-xs mt-1.5 flex items-center justify-center gap-1">
                        📞 <?php echo e($member->phone); ?>

                    </p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/tim-kerja/index.blade.php ENDPATH**/ ?>