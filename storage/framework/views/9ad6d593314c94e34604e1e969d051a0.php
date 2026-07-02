<aside id="mainSidebar" class="sidebar bg-white shadow-xl w-64 min-w-64 p-4">
    <div class="p-2">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Menu</h2>
        <nav class="space-y-1">
            <a href="<?php echo e(route('home')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Beranda</span>
            </a>

            
            <div class="pt-4 pb-2"><h3 class="text-xs font-semibold text-gray-400 uppercase px-3">Layanan Informasi Kepegawaian</h3></div>

            <a href="<?php echo e(route('kenaikan-pangkat')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('kenaikan-pangkat') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                <span>Kenaikan Pangkat</span>
            </a>
            <a href="<?php echo e(route('kgb')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('kgb') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Kenaikan Gaji Berkala</span>
            </a>
            <a href="<?php echo e(route('karis-karsu')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('karis-karsu') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>KARIS/KARSU</span>
            </a>
            <a href="<?php echo e(route('perkawinan-pertama')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('perkawinan-pertama') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>Perkawinan Pertama</span>
            </a>
            <a href="<?php echo e(route('pensiun')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('pensiun') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Pensiun</span>
            </a>
            <!-- Ganti Link Form -->
            <a href="https://forms.gle/LINK_FORM" target="_blank"
               class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>Konseling</span>
            </a>
            <a href="<?php echo e(route('uji-kompetensi')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('uji-kompetensi') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                <span>Uji Kompetensi</span>
            </a>
            <a href="<?php echo e(route('tugas-belajar')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('tugas-belajar') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                <span>Tugas Belajar</span>
            </a>

            
            <div class="pt-4 pb-2"><h3 class="text-xs font-semibold text-gray-400 uppercase px-3">Informasi</h3></div>

            <a href="<?php echo e(route('peraturan')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('peraturan') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Peraturan</span>
            </a>
            <a href="<?php echo e(route('gallery')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('gallery') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Galeri SDM</span>
            </a>
            <a href="<?php echo e(route('tim-kerja')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('tim-kerja') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Tim SDM &amp; Hukum</span>
            </a>
            <a href="<?php echo e(route('faq')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('faq') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>FAQ</span>
            </a>
            <a href="<?php echo e(route('kontak')); ?>"
               class="sidebar-item <?php echo e(request()->routeIs('kontak') ? 'active' : ''); ?> flex items-center space-x-3 p-3 rounded-lg text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>Kontak</span>
            </a>
        </nav>
    </div>
</aside>
<?php /**PATH C:\gley\Magang\kliksdmbps-laravel\resources\views/components/sidebar.blade.php ENDPATH**/ ?>