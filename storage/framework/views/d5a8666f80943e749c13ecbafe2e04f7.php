<?php $__env->startSection('title', 'Pensiun'); ?>
<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal831c4d20e0db012f4e41f18aa657ec0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal831c4d20e0db012f4e41f18aa657ec0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layanan-content','data' => ['persyaratan' => $persyaratan,'dokumen' => $dokumen,'title' => 'Pensiun']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layanan-content'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['persyaratan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($persyaratan),'dokumen' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dokumen),'title' => 'Pensiun']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal831c4d20e0db012f4e41f18aa657ec0c)): ?>
<?php $attributes = $__attributesOriginal831c4d20e0db012f4e41f18aa657ec0c; ?>
<?php unset($__attributesOriginal831c4d20e0db012f4e41f18aa657ec0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal831c4d20e0db012f4e41f18aa657ec0c)): ?>
<?php $component = $__componentOriginal831c4d20e0db012f4e41f18aa657ec0c; ?>
<?php unset($__componentOriginal831c4d20e0db012f4e41f18aa657ec0c); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/pages/pensiun/index.blade.php ENDPATH**/ ?>