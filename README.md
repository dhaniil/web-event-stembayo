# Bursa Event Sekolah

Bursa Event Sekolah adalah aplikasi web yang dibangun dengan Laravel untuk memudahkan siswa, guru, dan orang tua dalam menemukan, mengelola, dan berpartisipasi dalam berbagai acara sekolah. Web ini dirancang untuk meningkatkan keterlibatan komunitas sekolah dan memfasilitasi komunikasi yang lebih baik antara semua pihak yang terlibat.

## Fitur

- **Pendaftaran Pengguna**: Pengguna dapat mendaftar dan membuat akun untuk mengakses fitur web.
- **Manajemen Event**: Membuat, mengedit, dan menghapus event.
- **Pencarian dan Filter**: Fitur pencarian dan filter untuk memudahkan pengguna menemukan event berdasarkan kategori dan tanggal.
- **Admin Panel**: Admin dapat mengelola semua event, pengguna, dan konten di dalam web.
- **Favorites**: Menandai event.
- **Reviews**: Pengunjung dapat memberikan review dan komentar.

## Teknologi yang Digunakan

- **Backend**: Laravel 11, Filament Admin Panel
- **Frontend**: Blade, Bootstrap, HTML, dan CSS
- **Database**: MariaDB/MySQL

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
```

5. **Konfigurasi Database**
- Buat database baru di MariaDB/MySQL
- Edit file .env dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

6. **Jalankan Migrasi & Seeder**
```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder untuk membuat role dan admin default
php artisan db:seed
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

## Informasi Login Default

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
