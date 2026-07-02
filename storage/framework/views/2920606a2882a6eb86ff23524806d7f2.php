
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['persyaratan', 'dokumen', 'title']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['persyaratan', 'dokumen', 'title']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-6"><h1 class="text-3xl font-bold text-gray-800"><?php echo e($title); ?></h1></div>

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="font-bold text-xl mb-4">Persyaratan</h3>
    <?php if($persyaratan->isEmpty()): ?>
        <p class="text-gray-400 text-center py-4">Belum ada data</p>
    <?php else: ?>
        <?php $__currentLoopData = $persyaratan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pdf-card border border-gray-200 rounded-xl p-4 mb-3 flex items-center justify-between">
                <div>
                    <p class="font-bold"><?php echo e($item->title); ?></p>
                    <?php if($item->description): ?>
                        <p class="text-sm text-gray-500"><?php echo e($item->description); ?></p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e($item->url); ?>" target="_blank" class="text-blue-600 hover:underline text-sm font-semibold flex-shrink-0 ml-4">Buka PDF</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="font-bold text-xl mb-4">Dokumen</h3>
    <?php if($dokumen->isEmpty()): ?>
        <p class="text-gray-400 text-center py-4">Belum ada data</p>
    <?php else: ?>
        <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pdf-card border border-gray-200 rounded-xl p-4 mb-3 flex items-center justify-between">
                <div>
                    <p class="font-bold"><?php echo e($item->title); ?></p>
                    <?php if($item->description): ?>
                        <p class="text-sm text-gray-500"><?php echo e($item->description); ?></p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e($item->url); ?>" target="_blank" class="text-blue-600 hover:underline text-sm font-semibold flex-shrink-0 ml-4">Buka PDF</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/components/layanan-content.blade.php ENDPATH**/ ?>