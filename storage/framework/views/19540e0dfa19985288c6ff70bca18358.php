<?php $__env->startSection('title', 'FAQ'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola FAQ</h1>

<div class="mb-8">
    <h3 class="font-bold text-lg text-gray-700 mb-3">⏳ Belum Dijawab (<?php echo e($faqBelum->count()); ?>)</h3>
    <div class="space-y-3">
        <?php $__empty_1 = true; $__currentLoopData = $faqBelum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="font-semibold text-gray-800 mb-3"><?php echo e($item->question); ?></p>
                <form action="<?php echo e(route('admin.faq.answer', $item)); ?>" method="POST" class="flex gap-2">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <input type="text" name="answer" required placeholder="Tulis jawaban..."
                           class="flex-1 border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">Jawab</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Tidak ada pertanyaan yang menunggu jawaban.</div>
        <?php endif; ?>
    </div>
</div>

<div>
    <h3 class="font-bold text-lg text-gray-700 mb-3">✅ Sudah Dijawab (<?php echo e($faqTerjawab->count()); ?>)</h3>
    <div class="space-y-3">
        <?php $__empty_1 = true; $__currentLoopData = $faqTerjawab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <p class="font-semibold text-gray-800 mb-2"><?php echo e($item->question); ?></p>
                <p class="text-gray-600 text-sm bg-blue-50 rounded-lg p-3"><?php echo e($item->answer); ?></p>
                <form id="delFaq<?php echo e($item->id); ?>" action="<?php echo e(route('admin.faq.destroy', $item)); ?>" method="POST" class="mt-2">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                </form>
                <button onclick="confirmDelete('delFaq<?php echo e($item->id); ?>')" class="text-red-600 hover:underline text-xs font-semibold mt-1">Hapus</button>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-xl border p-8 text-center text-gray-400">Belum ada pertanyaan terjawab.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/admin/faq/index.blade.php ENDPATH**/ ?>