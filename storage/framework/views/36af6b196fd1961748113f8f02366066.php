<?php $__env->startSection('title', 'FAQ'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6"><h1 class="text-3xl font-bold text-gray-800">FAQ</h1></div>

<!-- Answered FAQs -->
<div class="space-y-4 mb-8">
    <?php $__empty_1 = true; $__currentLoopData = $faq->where('is_answered', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <p class="font-bold text-gray-800 mb-3 flex items-start gap-2">
                <span class="text-blue-500 mt-0.5">❓</span> <?php echo e($item->question); ?>

            </p>
            <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                <p class="text-gray-700 text-sm flex items-start gap-2">
                    <span class="text-green-500 mt-0.5">✅</span> <?php echo e($item->answer); ?>

                </p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
            Belum ada pertanyaan yang terjawab.
        </div>
    <?php endif; ?>
</div>

<!-- Submit question -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="font-bold text-xl mb-4">Ajukan Pertanyaan</h3>
    <form action="<?php echo e(route('faq.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <textarea name="question" rows="3" required placeholder="Tulis pertanyaan Anda di sini..."
                  class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 resize-none"></textarea>
        <?php $__errorArgs = ['question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors">
            Kirim Pertanyaan
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/faq/index.blade.php ENDPATH**/ ?>