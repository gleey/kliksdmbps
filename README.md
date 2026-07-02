# KLIK-SDM BPS Provinsi Sulawesi Utara

Aplikasi layanan Kepegawaian (SDM) untuk Badan Pusat Statistik (BPS) Provinsi Sulawesi Utara. Aplikasi ini merupakan hasil migrasi dari platform Single Page Application (SPA) berbasis Supabase & Vanilla JS menjadi aplikasi full-stack berbasis Laravel 11 dengan database MySQL.

## Fitur Utama & Layanan

Aplikasi ini mencakup modul-modul utama untuk pengelolaan administrasi kepegawaian, baik untuk tampilan publik maupun panel manajemen admin (CRUD) lengkap:

- **Pengumuman & FAQ**: Publikasi informasi resmi dan tanya jawab seputar layanan kepegawaian.
- **Galeri & Tim Kerja**: Dokumentasi visual kegiatan kepegawaian dan direktori tim.
- **Kenaikan Pangkat (KP)**: Monitoring status KP pegawai, pengelolaan jadwal, serta persyaratan administrasi.
- **Kenaikan Gaji Berkala (KGB)**: Pengelolaan dan tracking usulan kenaikan gaji berkala.
- **Uji Kompetensi**: Pendaftaran dan informasi jadwal uji kompetensi bagi fungsional.
- **Layanan Kepegawaian Khusus**:
  - Karis / Karsu (Kartu Istri / Kartu Suami)
  - Perkawinan Pertama
  - Pensiun Pegawai
  - Tugas Belajar (TB) - Persyaratan & Dokumen
- **Peraturan**: Bank data regulasi kepegawaian nasional maupun internal.
- **Pengaturan Sistem**: Konfigurasi global aplikasi oleh admin pengelola.

## Kebutuhan Sistem

- **PHP** >= 8.2
- **Composer**
- **MySQL** atau **MariaDB**

*(Catatan: Proyek ini menggunakan Tailwind CSS dan pustaka JavaScript pendukung seperti Chart.js dan SheetJS melalui CDN, sehingga tidak memerlukan Node.js atau proses bundling aset npm run build).*

## Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1. **Clone repositori**:
   ```bash
   git clone <repository-url>
   cd kliksdmbps-laravel
   ```

2. **Instal Dependensi PHP**:
   ```bash
   composer install
   ```

3. **Salin file konfigurasi lingkungan**:
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi Database & Environment**:
   Buka file `.env` yang baru dibuat dan sesuaikan kredensial koneksi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=username_mysql
   DB_PASSWORD=password_mysql
   ```

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi & Seeder**:
   Migrasikan seluruh tabel ke database beserta data seeding awal (termasuk user admin default):
   ```bash
   php artisan migrate --seed
   ```

7. **Hubungkan Storage**:
   Buat link symlink dari folder `storage` ke `public` untuk menangani file upload:
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.

## Akun Demo Pengujian

Setelah berhasil menjalankan seed (`php artisan db:seed`), Anda dapat masuk ke panel admin menggunakan akun pengujian berikut:

1. **Role: Admin Pengelola** (Akses Penuh + Pengaturan)
   - **Username**: `admin`
   - **Password**: `Admin@2024`

2. **Role: Admin Kepegawaian**
   - **Username**: `kepegawaian`
   - **Password**: `Kepeg@2024`

> [!WARNING]
> Harap segera mengubah kredensial default di atas melalui panel admin sebelum melakukan deployment ke server production.

## Detail Arsitektur Keamanan & Peran

- **Autentikasi**: Menggunakan sistem Session Guard bawaan Laravel (Laravel Auth).
- **Otorisasi**: Dikelola via middleware khusus (`admin`) untuk menyaring hak akses berdasarkan peran (`admin_pengelola` vs `admin_kepegawaian`). Halaman sensitif seperti konfigurasi sistem dan manajemen pengguna dibatasi hanya untuk `admin_pengelola`.

## Lisensi

Proyek ini bersifat internal untuk kebutuhan Badan Pusat Statistik (BPS) Provinsi Sulawesi Utara.
