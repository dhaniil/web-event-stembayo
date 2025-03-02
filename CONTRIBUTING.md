# Panduan Kontribusi untuk Bursa Event Sekolah

Terima kasih telah mempertimbangkan untuk berkontribusi pada proyek Bursa Event Sekolah! Panduan ini akan membantu Anda memahami alur kerja pengembangan dan cara berkontribusi dengan efektif.

## Alur Kerja Pengembangan

### Branching Strategy

Kami menggunakan model branching berikut:

- `main`: Branch production, hanya menerima merge dari `develop` setelah testing
- `develop`: Branch pengembangan utama
- `feature/nama-fitur`: Branch untuk fitur baru
- `bugfix/nama-bug`: Branch untuk perbaikan bug
- `hotfix/nama-hotfix`: Branch untuk perbaikan darurat di production

### Langkah-langkah Kontribusi

1. **Fork repository** (jika Anda bukan anggota tim inti)
2. **Clone repository**:
   ```bash
   git clone https://github.com/dhaniil/bursa-event-sekolah.git
   cd bursa-event-sekolah
   ```

3. **Buat branch baru**:
   ```bash
   # Untuk fitur baru
   git checkout -b feature/nama-fitur
   
   # Untuk perbaikan bug
   git checkout -b bugfix/nama-bug
   ```

4. **Lakukan perubahan** dan commit dengan pesan yang jelas:
   ```bash
   git add .
   git commit -m "Menambahkan fitur: deskripsi singkat"
   ```

5. **Push ke repository**:
   ```bash
   git push origin feature/nama-fitur
   ```

6. **Buat Pull Request** ke branch `develop`

## Setup Lingkungan Pengembangan

### Prasyarat

- PHP 8.2+
- Composer
- Node.js & NPM
- MariaDB/MySQL
- Git

### Instalasi

1. **Clone repository**:
   ```bash
   git clone https://github.com/username/bursa-event-sekolah.git
   cd bursa-event-sekolah
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**:
   - Buat database baru
   - Update konfigurasi di `.env`
   - Jalankan migrasi: `php artisan migrate --seed`

5. **Link storage**:
   ```bash
   php artisan storage:link
   ```

6. **Jalankan server development**:
   ```bash
   # Terminal 1: Laravel server
   php artisan serve
   
   # Terminal 2: Vite server
   npm run dev
   ```

## Standar Kode

### PHP

- Ikuti [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Gunakan type hints untuk parameter dan return values
- Dokumentasikan kode dengan PHPDoc

### JavaScript

- Gunakan ES6+ syntax
- Hindari penggunaan jQuery jika memungkinkan
- Gunakan arrow functions untuk callbacks

### CSS

- Gunakan class naming yang konsisten
- Hindari penggunaan !important
- Gunakan variabel CSS untuk warna dan ukuran yang konsisten

## Testing

Sebelum membuat Pull Request, pastikan:

1. **Kode berjalan tanpa error**:
   ```bash
   php artisan serve
   npm run dev
   ```

2. **Fitur berfungsi sesuai harapan**:
   - Test di browser yang berbeda
   - Test di ukuran layar yang berbeda

3. **Tidak ada regresi**:
   - Pastikan fitur lain tetap berfungsi

## Deployment ke Production

Deployment ke production hanya dilakukan oleh tim DevOps atau maintainer. Proses deployment meliputi:

1. **Merge ke branch `main`**:
   ```bash
   git checkout main
   git merge develop
   git push origin main
   ```

2. **Di server production**:
   ```bash
   cd /var/www/event
   git pull origin main
   composer install --optimize-autoloader --no-dev
   php artisan migrate --force
   npm install
   npm run build
   php artisan optimize
   php artisan filament:assets
   php artisan view:clear
   php artisan cache:clear
   ```

## Pemeliharaan Berkelanjutan

### Update Dependencies

Secara berkala, update dependencies untuk keamanan dan fitur baru:

```bash
# Update PHP dependencies
composer update

# Update JavaScript dependencies
npm update
```

### Monitoring Error

Gunakan Sentry atau Laravel Telescope untuk monitoring error di production.

### Backup Database

Lakukan backup database secara berkala:

```bash
# Di server production
mysqldump -u [username] -p [database] > backup_$(date +%Y%m%d).sql
```

## Kontak

Jika Anda memiliki pertanyaan atau masalah, silakan hubungi:

- **UI/UX Designer**: Farcha Amalia Nugrahaini (Limleye)
- **Front-End**: Laurentius Daviano Maximus Antara (LmX)
- **Back-End**: Ahmad Hanaffi Rahmadhani (iLazer)

## Terima Kasih

Terima kasih telah berkontribusi pada proyek Bursa Event Sekolah! Kontribusi Anda sangat dihargai dan membantu meningkatkan kualitas aplikasi ini. 