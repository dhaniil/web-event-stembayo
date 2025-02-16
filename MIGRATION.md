# Panduan Migrasi Laravel Event App

Dokumen ini berisi langkah-langkah untuk migrasi aplikasi Laravel Event dari satu server ke server lain menggunakan Laravel Octane dengan FrankenPHP.

## 1. Backup Data (Di Server Lama)

```bash
# Backup database
mysqldump -u [username] -p [nama_database] > database_backup.sql

# Backup file storage
cd /var/www/event
tar -czf storage_backup.tar.gz storage/app/public/*

# Backup .env
cp .env .env.backup
```

## 2. Persiapan Server Baru

Pastikan server tujuan memiliki:
- Git
- PHP 8.1 atau lebih tinggi dengan ekstensi yang diperlukan:
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Supervisor (opsional tapi direkomendasikan)
- Nginx (opsional jika menggunakan sebagai reverse proxy)

## 3. Clone Repository

```bash
# Clone repository
cd /var/www
git clone [URL_REPOSITORY] event
cd event
```

## 4. Setup Aplikasi

```bash
# Install dependencies PHP
composer install --optimize-autoloader --no-dev

# Install dependencies Node.js
npm install

# Copy .env.example
cp .env.example .env

# Generate app key
php artisan key:generate

# Setup environment di .env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com
DB_HOST=localhost
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
OCTANE_SERVER=frankenphp
VITE_SERVER=false
```

## 5. Setup Database

```bash
# Buat database baru
mysql -u root -p
CREATE DATABASE nama_database;
exit;

# Import database dari backup (jika ada)
mysql -u [username] -p nama_database < backup.sql

# Atau jalankan migration fresh jika instalasi baru
php artisan migrate:fresh --seed
```

## 6. Setup File Storage

```bash
# Buat symlink storage
php artisan storage:link

# Restore backup storage dari server lama (jika ada)
cd /var/www/event
tar -xzf storage_backup.tar.gz -C storage/app/public/

# Set permission yang benar
sudo chown -R www-data:www-data /var/www/event
sudo find /var/www/event -type f -exec chmod 644 {} \;
sudo find /var/www/event -type d -exec chmod 755 {} \;
sudo chmod -R 775 storage bootstrap/cache

# Verify storage symlink
ls -la public/storage
```

## 7. Build Assets dan Setup Vite

```bash
# Build Vite assets untuk production
npm run build

# Publish assets Filament
php artisan vendor:publish --tag=filament-assets --force
php artisan filament:assets

# Tambahkan konfigurasi Vite di .env untuk mencegah CORS issues
APP_ENV=production
VITE_SERVER=false
ASSET_URL=https://domain-anda.com
```

Catatan: Jika mengalami masalah CORS dengan Vite:
- Pastikan VITE_SERVER=false di .env
- Pastikan assets sudah di-build dengan `npm run build`
- Pastikan ASSET_URL sudah dikonfigurasi dengan benar
- Clear cache setelah mengubah konfigurasi

## 8. Optimasi Laravel

```bash
# Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize
php artisan optimize
```

## 9. Setup Laravel Octane dengan FrankenPHP

```bash
# Install Octane
php artisan octane:install

# Edit config/octane.php, pastikan:
'server' => env('OCTANE_SERVER', 'frankenphp'),

# Edit .env:
OCTANE_SERVER=frankenphp
OCTANE_HTTPS=true     # Jika menggunakan HTTPS

# Start Octane dengan FrankenPHP
php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000

# Untuk development mode (opsional):
php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000 --watch
```

Catatan penting untuk FrankenPHP:
- FrankenPHP adalah server web modern yang terintegrasi dengan PHP
- Lebih baik performa dibanding server PHP-FPM tradisional
- Mendukung HTTP/2 dan HTTP/3
- Auto-reload ketika file berubah (dengan flag --watch)

## 10. Setup Supervisor (Opsional tapi Direkomendasikan)

Buat file konfigurasi supervisor:
```bash
sudo nano /etc/supervisor/conf.d/octane.conf
```

Isi dengan:
```ini
[program:octane]
process_name=%(program_name)s
command=php /var/www/event/artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/event/storage/logs/octane.log
```

Kemudian:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start octane
```

## 11. Setup Nginx sebagai Reverse Proxy (Opsional tapi Direkomendasikan)

```bash
sudo nano /etc/nginx/sites-available/event
```

Isi dengan:
```nginx
server {
    listen 80;
    server_name domain-anda.com;
    
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

Aktifkan dan restart Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/event /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

## 12. Setup SSL/HTTPS (Direkomendasikan)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Dapatkan dan pasang sertifikat
sudo certbot --nginx -d domain-anda.com
```

## 13. Verifikasi Instalasi

Setelah menyelesaikan semua langkah, verifikasi instalasi dengan:

```bash
# Cek status Octane
php artisan octane:status

# Cek status Supervisor
sudo supervisorctl status octane

# Cek status Nginx (jika menggunakan)
sudo systemctl status nginx

# Tes koneksi database
php artisan tinker
DB::connection()->getPdo();
exit;

# Cek symlink storage
ls -la public/storage

# Cek permission
ls -la storage
ls -la bootstrap/cache

# Cek versi PHP dan ekstensi
php -v
php -m
```

Tes fungsional:
1. Buka website di browser
2. Coba login ke admin panel
3. Upload file ke storage
4. Verifikasi asset CSS/JS dimuat dengan benar
5. Cek performa dengan developer tools

## Troubleshooting

Jika mengalami masalah:

1. Cek logs:
```bash
tail -f storage/logs/laravel.log
tail -f storage/logs/octane.log
```

2. Jika ada masalah permission:
```bash
sudo chown -R www-data:www-data /var/www/event
sudo chmod -R 775 storage bootstrap/cache
```

3. Jika ada masalah dengan assets:
```bash
npm run build
php artisan optimize
php artisan view:clear
php artisan cache:clear
```

4. Jika ada masalah dengan Octane/FrankenPHP:
```bash
# Stop semua instance
php artisan octane:stop

# Clear octane cache
rm bootstrap/cache/octane-*.php

# Restart dengan debug
php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000 --watch
```

5. Restart services:
```bash
sudo supervisorctl restart octane
sudo systemctl restart nginx
```
