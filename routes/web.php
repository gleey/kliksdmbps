<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\{
    DashboardController,
    PengumumanController,
    GalleryController,
    TimKerjaController,
    FaqController,
    KpController,
    KgbController,
    UjiKompetensiController,
    PeraturanController,
    SettingController,
    LayananController,
};

// ══════════════════════════════════════════════════════════════
// AUTH
// ══════════════════════════════════════════════════════════════
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ══════════════════════════════════════════════════════════════
// PUBLIC PAGES
// ══════════════════════════════════════════════════════════════
Route::get('/',                    [PublicController::class, 'home'])->name('home');
Route::get('/kenaikan-pangkat',    [PublicController::class, 'kenaikanPangkat'])->name('kenaikan-pangkat');
Route::get('/kgb',                 [PublicController::class, 'kgb'])->name('kgb');
Route::get('/uji-kompetensi',      [PublicController::class, 'ujiKompetensi'])->name('uji-kompetensi');
Route::get('/tugas-belajar',       [PublicController::class, 'tugasBelajar'])->name('tugas-belajar');
Route::get('/karis-karsu',         [PublicController::class, 'karisKarsu'])->name('karis-karsu');
Route::get('/perkawinan-pertama',  [PublicController::class, 'perkawinanPertama'])->name('perkawinan-pertama');
Route::get('/pensiun',             [PublicController::class, 'pensiun'])->name('pensiun');
Route::get('/peraturan',           [PublicController::class, 'peraturan'])->name('peraturan');
Route::get('/gallery',             [PublicController::class, 'gallery'])->name('gallery');
Route::get('/tim-kerja',           [PublicController::class, 'timKerja'])->name('tim-kerja');
Route::get('/faq',                 [PublicController::class, 'faq'])->name('faq');
Route::post('/faq',                [PublicController::class, 'faqStore'])->name('faq.store');
Route::get('/kontak',              [PublicController::class, 'kontak'])->name('kontak');

// Public JSON endpoints (used by frontend JS for charts, filters)
Route::get('/api/kp-data',         [PublicController::class, 'kpDataJson'])->name('api.kp-data');
Route::get('/api/kgb-data',        [PublicController::class, 'kgbDataJson'])->name('api.kgb-data');
Route::get('/api/uji-kompetensi',  [PublicController::class, 'ujiKompetensiJson'])->name('api.uji-kompetensi');

// ══════════════════════════════════════════════════════════════
// ADMIN (requires auth)
// ══════════════════════════════════════════════════════════════
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Pengumuman
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/',                           [PengumumanController::class, 'index'])->name('index');
        Route::post('/',                          [PengumumanController::class, 'store'])->name('store');
        Route::put('/{pengumuman}',               [PengumumanController::class, 'update'])->name('update');
        Route::delete('/{pengumuman}',            [PengumumanController::class, 'destroy'])->name('destroy');
        Route::patch('/{pengumuman}/toggle',      [PengumumanController::class, 'toggleActive'])->name('toggle');
    });

    // Gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/',               [GalleryController::class, 'index'])->name('index');
        Route::post('/',              [GalleryController::class, 'store'])->name('store');
        Route::put('/{gallery}',      [GalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}',   [GalleryController::class, 'destroy'])->name('destroy');
    });

    // Tim Kerja
    Route::prefix('tim-kerja')->name('tim-kerja.')->group(function () {
        Route::get('/',               [TimKerjaController::class, 'index'])->name('index');
        Route::post('/',              [TimKerjaController::class, 'store'])->name('store');
        Route::put('/{timKerja}',     [TimKerjaController::class, 'update'])->name('update');
        Route::delete('/{timKerja}',  [TimKerjaController::class, 'destroy'])->name('destroy');
    });

    // FAQ
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/',               [FaqController::class, 'index'])->name('index');
        Route::put('/{faq}/answer',   [FaqController::class, 'answer'])->name('answer');
        Route::delete('/{faq}',       [FaqController::class, 'destroy'])->name('destroy');
    });

    // Kenaikan Pangkat
    Route::prefix('kp')->name('kp.')->group(function () {
        Route::get('/',                            [KpController::class, 'index'])->name('index');
        Route::post('/data',                       [KpController::class, 'storeData'])->name('data.store');
        Route::put('/data/{kpData}',               [KpController::class, 'updateData'])->name('data.update');
        Route::delete('/data/{kpData}',            [KpController::class, 'destroyData'])->name('data.destroy');
        Route::post('/requirement',                [KpController::class, 'storeRequirement'])->name('req.store');
        Route::post('/requirement/bulk',            [KpController::class, 'bulkReplaceRequirements'])->name('req.bulk');
        Route::put('/requirement/{requirement}',   [KpController::class, 'updateRequirement'])->name('req.update');
        Route::delete('/requirement/{requirement}',[KpController::class, 'destroyRequirement'])->name('req.destroy');
        Route::post('/jadwal',                     [KpController::class, 'storeJadwal'])->name('jadwal.store');
        Route::put('/jadwal/{jadwal}',             [KpController::class, 'updateJadwal'])->name('jadwal.update');
        Route::delete('/jadwal/{jadwal}',          [KpController::class, 'destroyJadwal'])->name('jadwal.destroy');
    });

    // KGB
    Route::prefix('kgb')->name('kgb.')->group(function () {
        Route::get('/',           [KgbController::class, 'index'])->name('index');
        Route::post('/bulk',      [KgbController::class, 'bulkStore'])->name('bulk');
        Route::put('/{id}',       [KgbController::class, 'update'])->name('update');
        Route::delete('/row/{id}',[KgbController::class, 'destroyRow'])->name('destroyRow');
        Route::delete('/delete',  [KgbController::class, 'destroy'])->name('destroy');
    });

    // Uji Kompetensi
    Route::prefix('uji-kompetensi')->name('uji-kompetensi.')->group(function () {
        Route::get('/',                          [UjiKompetensiController::class, 'index'])->name('index');
        Route::post('/',                         [UjiKompetensiController::class, 'store'])->name('store');
        Route::put('/{ujiKompetensi}',           [UjiKompetensiController::class, 'update'])->name('update');
        Route::delete('/{ujiKompetensi}',        [UjiKompetensiController::class, 'destroy'])->name('destroy');
    });

    // Peraturan
    Route::prefix('peraturan')->name('peraturan.')->group(function () {
        Route::get('/',                [PeraturanController::class, 'index'])->name('index');
        Route::post('/',               [PeraturanController::class, 'store'])->name('store');
        Route::put('/{peraturan}',     [PeraturanController::class, 'update'])->name('update');
        Route::delete('/{peraturan}',  [PeraturanController::class, 'destroy'])->name('destroy');
    });

    // Layanan (Tugas Belajar, Karis/Karsu, Perkawinan Pertama, Pensiun)
    Route::prefix('layanan/{type}')->name('layanan.')->group(function () {
        Route::get('/',          [LayananController::class, 'index'])->name('index');
        Route::post('/',         [LayananController::class, 'store'])->name('store');
        Route::put('/{id}',      [LayananController::class, 'update'])->name('update');
        Route::delete('/{id}',   [LayananController::class, 'destroy'])->name('destroy');
    });

    // Settings (hanya admin_pengelola)
    Route::prefix('settings')->name('settings.')->middleware('admin:admin_pengelola')->group(function () {
        Route::get('/',  [SettingController::class, 'index'])->name('index');
        Route::put('/',  [SettingController::class, 'update'])->name('update');
    });
});
