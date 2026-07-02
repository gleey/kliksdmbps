# KLIK-SDM — Laravel Migration

Hasil migrasi dari SPA Supabase/vanilla JS (`index.html` + Supabase Edge Functions) ke aplikasi Laravel 11 dengan MySQL.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env`, isi kredensial MySQL (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), lalu:

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

Akun default (dari `UserSeeder`, password sudah di-hash dengan `Hash::make`):
- `admin` / `Admin@2024` — role `admin_pengelola` (akses penuh termasuk Pengaturan)
- `kepegawaian` / `Kepeg@2024` — role `admin_kepegawaian`

**Ganti password ini sebelum deploy ke production.**

## Yang sudah dimigrasikan

Seluruh 14 endpoint Supabase Edge Function (`settings`, `login`, `pengumuman`, `gallery`, `tim_kerja`, `faq`, `kp_data`, `kp_requirements`, `kp_jadwal`, `kgb_data`, `uji_kompetensi`, `peraturan`, `tb_persyaratan`/`tb_dokumen`, dan layanan sejenis untuk karis/karsu, perkawinan pertama, pensiun) sudah menjadi model Eloquent + migration MySQL + controller Laravel, dengan tampilan publik dan panel admin penuh (CRUD) untuk masing-masing.

Skema database (`database/migrations/`) mengikuti `supabase/01_schema.sql` apa adanya, termasuk format data asli yang penting untuk kompatibilitas:
- `kp_data.month` → `YYYY-MM`
- `kgb_data.bulan` → teks bebas seperti `"Januari 2026"` (bukan `YYYY-MM` — ini sempat salah saya asumsikan di draf pertama, sudah diperbaiki)
- `kgb_data.kabkota` → 12 pilihan kab/kota + provinsi sesuai daftar asli di kode sumber

Autentikasi memakai Laravel `Auth` + session database (bukan Supabase Auth), dengan middleware `admin` yang mendukung pembatasan per-role (mis. halaman Pengaturan hanya untuk `admin_pengelola`).

## Yang sengaja disederhanakan / belum sepenuhnya direplikasi

File asli `index.html` adalah SPA 2600+ baris dengan banyak interaksi sisi-klien. Beberapa hal berikut **tidak** saya replikasi karena bersifat kosmetik atau murni client-side, bukan logika bisnis inti:

- **Custom menu via localStorage** (`klik_custom_menus`) — fitur menambah menu kustom yang tersimpan di browser pengguna sendiri (tidak tersinkron ke server). Tidak relevan di arsitektur server-rendered Laravel.
- **Drag-and-drop file upload** untuk KGB — saya gunakan `<input type="file">` standar (fungsional sama, UX sedikit berbeda).
- **Sub-poin (`sub_items`) dan catatan pada persyaratan KP** — di aplikasi asli pun field ini tidak bisa diisi lewat panel admin (hanya lewat seed data langsung di database). Saya pertahankan kemampuan menambah item dengan catatan via form tambah manual, tapi tidak ada UI untuk mengelola sub-poin bertingkat.

Saya **menemukan dan memperbaiki** satu gap fungsional nyata saat membandingkan dengan kode asli: panel admin untuk Kenaikan Pangkat (data pegawai & jadwal) awalnya saya buat tanpa fungsi edit (hanya tambah/hapus) — versi asli punya `editJadwal`/`saveEditKP`. Sudah ditambahkan modal edit untuk keduanya.

## Catatan penting

Saya melihat dari riwayat sebelumnya bahwa Anda sudah punya progres migrasi Laravel yang berjalan untuk repo `kliksdmbps` ini (migrations, models, controllers, Blade views, dengan admin views masih in-progress). Build di paket ini adalah implementasi independen dari awal berdasarkan analisis ulang repo sumber — bukan lanjutan dari file yang sudah Anda kerjakan sebelumnya, karena saya tidak punya akses ke state proyek itu di sesi ini. Sebelum menggabungkan, ada baiknya bandingkan dulu struktur/penamaan supaya tidak terjadi konflik (terutama nama tabel, migration timestamp, dan route name) dengan progres yang sudah ada.

## Verifikasi yang sudah dilakukan

- `php -l` pada seluruh file PHP (bersih, tanpa syntax error).
- Cross-check otomatis: setiap pemanggilan `route()` di Blade cocok dengan nama route yang didefinisikan di `routes/web.php` (tidak ada referensi route yang hilang).
- Cross-check otomatis: setiap `view()` di controller mengarah ke file Blade yang benar-benar ada.
- Balance check tag Blade (`@section/@endsection`, `@foreach/@endforeach`, `@forelse/@endforelse`, `@if/@endif`, `@push/@endpush`, `@php/@endphp`).

Catatan: karena `packagist.org` tidak ada di allowlist jaringan sandbox saya, saya **tidak bisa menjalankan `composer install` atau migration sungguhan** di sini — verifikasi di atas bersifat statis (analisis kode), bukan hasil eksekusi end-to-end. Jalankan `composer install` dan `php artisan migrate` di environment Anda sebagai langkah verifikasi terakhir sebelum deploy.
