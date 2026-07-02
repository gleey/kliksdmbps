<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin — <?php echo $__env->yieldContent('title', 'Dashboard'); ?> | KLIK-SDM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bps { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); }
        .sidebar-item { transition: all 0.2s ease; border-left: 3px solid transparent; }
        .sidebar-item:hover { background: rgba(59,130,246,0.1); border-left-color: #3b82f6; }
        .sidebar-item.active { background: rgba(59,130,246,0.15); border-left-color: #3b82f6; font-weight: 600; }
        .admin-badge { padding: 4px 10px; border-radius: 20px; font-weight: 700; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase; }
        .admin-badge.pengelola { background: linear-gradient(135deg,#f59e0b,#d97706); color: white; }
        .admin-badge.kepegawaian { background: linear-gradient(135deg,#10b981,#059669); color: white; }
        .toast { position: fixed; bottom: 24px; right: 24px; z-index: 9999; padding: 12px 20px; border-radius: 10px; font-weight: 600; font-size: 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); animation: slideUp 0.3s ease; }
        .toast.success { background: #10b981; color: white; }
        .toast.error { background: #ef4444; color: white; }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; backdrop-filter: blur(4px); }
        .modal-overlay.active { display: flex; align-items: center; justify-content: center; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-100">

<!-- Admin Header -->
<header class="gradient-bps text-white shadow-xl sticky top-0 z-50">
    <div class="px-6 py-3 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="<?php echo e(asset('assets/images/logo_bps.png')); ?>" alt="BPS" class="h-9 w-9 object-contain">
            <div>
                <h1 class="text-base font-bold">KLIK-SDM Admin</h1>
                <p class="text-blue-200 text-xs">BPS Provinsi Sulawesi Utara</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <a href="<?php echo e(route('home')); ?>" class="text-blue-200 hover:text-white text-sm transition-colors">← Lihat Publik</a>
            <div class="flex items-center space-x-2 bg-white/10 rounded-xl px-3 py-2">
                <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="text-sm font-semibold"><?php echo e(auth()->user()->username); ?></span>
                <span class="admin-badge <?php echo e(auth()->user()->role === 'admin_pengelola' ? 'pengelola' : 'kepegawaian'); ?> ml-1">
                    <?php echo e(auth()->user()->role_label); ?>

                </span>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-blue-200 hover:text-white text-sm transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<div class="flex min-h-screen">
    <!-- Admin Sidebar -->
    <aside class="w-60 bg-white shadow-md min-h-screen">
        <nav class="p-4 space-y-1">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                🏠 <span>Dashboard</span>
            </a>
            <div class="pt-2 pb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Konten</div>
            <a href="<?php echo e(route('admin.pengumuman.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.pengumuman.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                📢 <span>Pengumuman</span>
            </a>
            <a href="<?php echo e(route('admin.gallery.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                🖼️ <span>Galeri SDM</span>
            </a>
            <a href="<?php echo e(route('admin.tim-kerja.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.tim-kerja.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                👥 <span>Tim SDM & Hukum</span>
            </a>
            <a href="<?php echo e(route('admin.faq.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.faq.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                ❓ <span>FAQ</span>
            </a>
            <div class="pt-2 pb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Kepegawaian</div>
            <a href="<?php echo e(route('admin.kp.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.kp.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                📈 <span>Kenaikan Pangkat</span>
            </a>
            <a href="<?php echo e(route('admin.kgb.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.kgb.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                💰 <span>Kenaikan Gaji Berkala</span>
            </a>
            <a href="<?php echo e(route('admin.uji-kompetensi.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.uji-kompetensi.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                📋 <span>Uji Kompetensi</span>
            </a>
            <a href="<?php echo e(route('admin.peraturan.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.peraturan.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                📜 <span>Peraturan</span>
            </a>
            <div class="pt-2 pb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Layanan</div>
            <?php $__currentLoopData = [['tugas-belajar','🎓','Tugas Belajar'],['karis-karsu','💳','KARIS/KARSU'],['perkawinan-pertama','💍','Perkawinan Pertama'],['pensiun','🏖️','Pensiun']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$slug,$icon,$label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.layanan.index', $slug)); ?>"
               class="sidebar-item <?php echo e(request()->is('admin/layanan/'.$slug.'*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                <?php echo e($icon); ?> <span><?php echo e($label); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->user()->isPengelola()): ?>
            <div class="pt-2 pb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Pengaturan</div>
            <a href="<?php echo e(route('admin.settings.index')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?> flex items-center gap-3 p-3 rounded-lg text-gray-700 text-sm">
                ⚙️ <span>Pengaturan</span>
            </a>
            <?php endif; ?>
        </nav>
    </aside>

    <!-- Admin Main -->
    <main class="flex-1 p-6">
        <?php if(session('success')): ?>
            <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl text-sm font-medium">
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                ❌ <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc list-inside space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<script>
    function toast(msg, type = 'success') {
        const el = document.createElement('div');
        el.className = `toast ${type}`;
        el.textContent = msg;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 3000);
    }
    function confirmDelete(formId) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            document.getElementById(formId).submit();
        }
    }
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>