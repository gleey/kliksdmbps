<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Beranda'); ?> — KLIK-SDM | Kemudahan Layanan Informasi Kepegawaian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .scrolling-text { overflow: hidden; white-space: nowrap; }
        .scrolling-text span { display: inline-block; padding-left: 100%; animation: scroll-left 20s linear infinite; }
        @keyframes scroll-left { 0% { transform: translateX(0); } 100% { transform: translateX(-100%); } }
        .modal { display: none; position: fixed; z-index: 1000; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); }
        .modal.active { display: flex; align-items: center; justify-content: center; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .gradient-bps { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); }
        .sidebar { transition: transform 0.3s ease, width 0.3s ease; }
        .sidebar-collapsed { transform: translateX(-100%); }
        @media (max-width: 768px) {
            .sidebar { position: fixed; z-index: 40; height: 100vh; overflow-y: auto; top: 0; left: 0; }
        }
        @media (min-width: 769px) {
            .sidebar { overflow-y: auto; max-height: calc(100vh - 88px); position: sticky; top: 88px; align-self: flex-start; }
            .sidebar-collapsed { transform: translateX(0); width: 0 !important; min-width: 0 !important; overflow: hidden; padding: 0 !important; }
        }
        #sidebarOverlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 39; }
        #sidebarOverlay.active { display: block; }
        .sidebar-item { transition: all 0.2s ease; border-left: 3px solid transparent; }
        .sidebar-item:hover { background: rgba(59,130,246,0.1); border-left-color: #3b82f6; }
        .sidebar-item.active { background: rgba(59,130,246,0.15); border-left-color: #3b82f6; font-weight: 600; }
        .admin-badge { display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .admin-badge.pengelola { background: linear-gradient(135deg,#f59e0b,#d97706); color: white; }
        .admin-badge.kepegawaian { background: linear-gradient(135deg,#10b981,#059669); color: white; }
        .spinner { border: 3px solid #f3f3f3; border-top: 3px solid #3b82f6; border-radius: 50%; width: 24px; height: 24px; animation: spin 0.8s linear infinite; display: inline-block; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .toast { position: fixed; bottom: 24px; right: 24px; z-index: 9999; padding: 12px 20px; border-radius: 10px; font-weight: 600; font-size: 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); animation: slideUp 0.3s ease; }
        .toast.success { background: #10b981; color: white; }
        .toast.error { background: #ef4444; color: white; }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .app-card { transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1); cursor: pointer; text-decoration: none; }
        .app-card:hover { transform: translateY(-8px) scale(1.04); box-shadow: 0 24px 48px rgba(0,0,0,0.15); }
        .app-card:active { transform: translateY(-2px) scale(0.98); }
        .app-icon-wrapper { width: 72px; height: 72px; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 32px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); transition: box-shadow 0.3s ease; }
        .app-card:hover .app-icon-wrapper { box-shadow: 0 12px 28px rgba(0,0,0,0.25); }
        .pdf-card { transition: all 0.25s ease; }
        .pdf-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(0,0,0,0.12); }
        .sort-btn { cursor: pointer; user-select: none; transition: color 0.2s; }
        .sort-btn:hover { color: #4f46e5; }
        .sort-asc::after { content: ' ↑'; color: #4f46e5; }
        .sort-desc::after { content: ' ↓'; color: #4f46e5; }
        .month-pill { cursor:pointer; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600; border:2px solid #e5e7eb; transition:all 0.2s; }
        .month-pill:hover { border-color:#6366f1; color:#4f46e5; }
        .month-pill.active { background:#4f46e5; color:white; border-color:#4f46e5; }
        .kp-req-item { display:flex; align-items:flex-start; gap:14px; padding:14px 18px; border-radius:12px; background:linear-gradient(135deg,#f8faff 0%,#f0f4ff 100%); border:1.5px solid #e0e8ff; transition:all 0.25s ease; }
        .kp-req-item:hover { border-color:#a5b4fc; box-shadow:0 4px 16px rgba(99,102,241,0.1); transform:translateX(4px); }
        .kp-req-num { min-width:30px; height:30px; border-radius:50%; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:white; font-size:13px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 3px 8px rgba(79,70,229,0.3); }
        .kp-req-item.has-sub { background:linear-gradient(135deg,#fafffe 0%,#f0fdf8 100%); border-color:#d1fae5; }
        .kp-req-item.has-sub:hover { border-color:#6ee7b7; box-shadow:0 4px 16px rgba(16,185,129,0.1); }
        .kp-req-item.has-sub .kp-req-num { background:linear-gradient(135deg,#059669,#0d9488); }
        .kp-req-sub { margin-top:10px; padding-left:4px; display:flex; flex-direction:column; gap:8px; }
        .kp-req-sub-item { display:flex; align-items:center; gap:10px; padding:8px 12px; background:white; border-radius:8px; border:1px solid #d1fae5; font-size:13.5px; color:#374151; }
        .kp-req-sub-item::before { content:'→'; color:#059669; font-weight:700; font-size:12px; flex-shrink:0; }
        .kp-req-note { margin-top:6px; font-size:12px; color:#6b7280; font-style:italic; background:#fffbeb; border:1px solid #fde68a; border-radius:6px; padding:5px 10px; display:inline-block; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50">

<!-- Header -->
<header class="gradient-bps text-white shadow-xl sticky top-0 z-50">
    <div class="px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-white/10 transition-colors" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="flex items-center space-x-3">
                    <img src="<?php echo e(asset('assets/images/logo_bps.png')); ?>" alt="BPS" class="h-10 w-10 object-contain">
                    <div>
                        <h1 class="text-lg font-bold leading-tight">KLIK-SDM</h1>
                        <p class="text-blue-200 text-xs leading-tight">Kemudahan Layanan Informasi Kepegawaian</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <?php if(auth()->guard()->check()): ?>
                    <div class="hidden md:flex items-center space-x-2 bg-white/10 rounded-xl px-3 py-2">
                        <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <div class="text-sm">
                            <p class="font-semibold"><?php echo e(auth()->user()->username); ?></p>
                            <p class="text-blue-200 text-xs"><?php echo e(auth()->user()->role_label); ?></p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="p-2 rounded-lg hover:bg-white/10 transition-colors text-xs font-semibold px-3">Admin</a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="p-2 rounded-lg hover:bg-white/10 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="p-2 rounded-lg hover:bg-white/10 transition-colors text-sm font-semibold px-3">Login Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Scrolling text ticker -->
    <div class="bg-gradient-to-r from-yellow-400 to-orange-400 py-2 scrolling-text shadow-md">
        <span class="text-gray-800 font-semibold text-xs">📢 <?php echo e($scrollingText ?? 'Selamat Datang di KLIK-SDM BPS Provinsi Sulawesi Utara'); ?></span>
    </div>
</header>

<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-6 min-w-0">
        <?php if(session('success')): ?>
            <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (window.innerWidth < 769) {
            sidebar.classList.toggle('sidebar-collapsed');
            overlay.classList.toggle('active');
        } else {
            sidebar.classList.toggle('sidebar-collapsed');
        }
    }
    function closeSidebar() {
        document.getElementById('mainSidebar').classList.add('sidebar-collapsed');
        document.getElementById('sidebarOverlay').classList.remove('active');
    }
    function openSidebar() {
        document.getElementById('mainSidebar').classList.remove('sidebar-collapsed');
    }
    function toast(msg, type = 'success') {
        const el = document.createElement('div');
        el.className = `toast ${type}`;
        el.textContent = msg;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 3000);
    }
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>