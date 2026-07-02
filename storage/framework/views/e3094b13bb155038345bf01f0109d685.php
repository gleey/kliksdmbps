<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — KLIK-SDM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Plus Jakarta Sans', sans-serif; } .gradient-bps { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); }</style>
</head>
<body class="gradient-bps min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="gradient-bps p-8 text-center">
            <img src="<?php echo e(asset('assets/images/logo_bps.png')); ?>" alt="BPS" class="h-16 w-16 object-contain mx-auto mb-3">
            <h1 class="text-2xl font-bold text-white">KLIK-SDM</h1>
            <p class="text-blue-200 text-sm mt-1">Kemudahan Layanan Informasi Kepegawaian</p>
            <p class="text-blue-300 text-xs mt-0.5">BPS Provinsi Sulawesi Utara</p>
        </div>
        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Login Admin</h2>
            <form action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" required autofocus
                           class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:border-blue-500 transition-colors
                                  <?php echo e($errors->has('username') ? 'border-red-400 bg-red-50' : 'border-gray-200'); ?>"
                           placeholder="Masukkan username">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" id="passwordInput" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-colors pr-12"
                               placeholder="Masukkan password">
                        <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>
                <?php if($errors->has('username')): ?>
                    <div class="flex items-center gap-2 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <?php echo e($errors->first('username')); ?>

                    </div>
                <?php endif; ?>
                <button type="submit"
                        class="w-full gradient-bps text-white py-3 rounded-xl font-bold text-sm hover:opacity-90 transition-opacity mt-2">
                    Masuk
                </button>
            </form>
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('home')); ?>" class="text-blue-600 hover:underline text-sm">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    <script>
        function togglePwd() {
            const input = document.getElementById('passwordInput');
            const eye = document.getElementById('eyeIcon');
            const eyeOff = document.getElementById('eyeOffIcon');
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>