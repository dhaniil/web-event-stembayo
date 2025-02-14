# Bursa Event Sekolah

Bursa Event Sekolah adalah aplikasi web yang dibangun dengan Laravel untuk memudahkan siswa, guru, dan orang tua dalam menemukan, mengelola, dan berpartisipasi dalam berbagai acara sekolah. Web ini dirancang untuk meningkatkan keterlibatan komunitas sekolah dan memfasilitasi komunikasi yang lebih baik antara semua pihak yang terlibat.

## Fitur

- **Pendaftaran Pengguna**: Pengguna dapat mendaftar dan membuat akun untuk mengakses fitur web.
- **Manajemen Event**: Membuat, mengedit, dan menghapus event.
- **Pencarian dan Filter**: Fitur pencarian dan filter untuk memudahkan pengguna menemukan event berdasarkan kategori dan tanggal.
- **Admin Panel**: Admin dapat mengelola semua event, pengguna, dan konten di dalam web.
- **Favorites**: Menandai event.
- **Reviews**: Pengunjung dapat memberikan review dan komentar.
- **Activity Logs**: Melacak semua aktivitas penting dalam sistem.
- **Role & Permissions**: Manajemen hak akses berbasis peran.

## Teknologi yang Digunakan

- **Backend**: Laravel 11.x, Filament Admin Panel 3.x
- **Frontend**: Blade, Bootstrap, HTML, dan CSS
- **Database**: MariaDB/MySQL
- **Package**: 
  - Spatie Permission untuk role & permissions
  - Spatie Activity Log untuk logging
  - Laravel Breeze untuk authentication

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MariaDB/MySQL
- Git

## Panduan Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/username/bursa-event-sekolah.git
cd bursa-event-sekolah
```

2. **Install Dependencies PHP**
```bash
composer install
```

3. **Install Dependencies JavaScript**
```bash
npm install
```

4. **Setup Konfigurasi**
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Link storage folder
php artisan storage:link
```

5. **Konfigurasi Database**

Buat database baru di MariaDB/MySQL, lalu sesuaikan konfigurasi di .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

Atau gunakan SQLite untuk development:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```
Lalu buat file database:
```bash
touch database/database.sqlite
```

6. **Jalankan Migrasi & Seeder**
```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder untuk membuat Super Admin
php artisan db:seed --class=SuperAdminSeeder
```

7. **Build Assets**
```bash
npm run build
```

8. **Jalankan Server Lokal**
```bash
php artisan serve
```

Aplikasi sekarang bisa diakses di http://localhost:8000

## Akun Default

**Super Admin:**
- Email: admin@admin.com
- Password: password

## Setup Tambahan (Opsional)

### Optimasi Image
Untuk menggunakan fitur optimasi gambar, pastikan telah menginstal:
```bash
sudo apt-get install jpegoptim optipng pngquant gifsicle webp
```

### Laravel Octane
Untuk performa lebih baik dengan Laravel Octane:
```bash
# Install Swoole
pecl install swoole

# Jalankan Octane
php artisan octane:start
```

## Dibuat oleh:
- **UI/UX Designer**: Farcha Amalia Nugrahaini (Limleye)
- **Front-End**: Laurentius Daviano Maximus Antara (LmX)
- **Back-End**: Ahmad Hanaffi Rahmadhani (iLazer)

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
