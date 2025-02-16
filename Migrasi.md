# Masalah Migrasi ke Server Baru

## Error yang Ditemukan

Saat menjalankan aplikasi di server baru, terdapat beberapa error yang muncul di browser:

```
app-cAUDMrc-.css:1 Failed to load resource: the server responded with a status of 404 (Not Found)
SOC02116.jpg:1 Failed to load resource: the server responded with a status of 403 (Forbidden)
stembayo.png:1 Failed to load resource
```

## Analisis Masalah

1. **CSS File Not Found (404)**
   - Error `app-cAUDMrc-.css` menunjukkan bahwa file CSS yang di-generate oleh Vite tidak ditemukan
   - Ini terjadi karena aset belum di-build untuk production atau direktori public/build belum tersinkronisasi dengan benar

2. **Image Access Forbidden (403)**
   - Error pada `SOC02116.jpg` dengan status 403 menunjukkan masalah permission
   - File ada di server tapi web server (Apache/Nginx) tidak memiliki izin untuk mengaksesnya
   - Ini biasanya terkait dengan permission storage atau public directory

3. **Missing Image**
   - Error pada `stembayo.png` menunjukkan gambar tidak dapat diakses
   - Kemungkinan file belum ditransfer ke server baru atau path yang salah

## Langkah-langkah Perbaikan yang Diperlukan

1. **Untuk Asset Building**
   ```bash
   npm install
   npm run build
   ```
   - Pastikan semua dependensi terinstall
   - Build ulang asset untuk production

2. **Untuk Permission Storage**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 public/
   chown -R www-data:www-data storage/
   chown -R www-data:www-data public/
   php artisan storage:link
   ```
   - Sesuaikan permission directory
   - Buat symbolic link untuk storage

3. **Untuk File Transfer**
   - Pastikan semua asset (gambar, file) sudah ditransfer ke server baru
   - Periksa struktur direktori sama dengan development
   - Verifikasi path yang digunakan dalam kode sesuai dengan struktur di production

4. **Konfigurasi Server**
   - Pastikan DocumentRoot mengarah ke direktori public
   - Periksa konfigurasi .htaccess (Apache) atau nginx.conf
   - Verifikasi virtual host configuration

5. **Environment Settings**
   - Periksa APP_URL di .env sudah sesuai dengan domain production
   - ASSET_URL jika menggunakan CDN atau subdomain berbeda
   - Pastikan setting filesystem di config/filesystems.php sudah benar

## Catatan Penting
- Backup database sebelum melakukan migrasi
- Test di environment staging terlebih dahulu jika memungkinkan
- Dokumentasikan setiap perubahan yang dilakukan
- Monitor error log setelah deployment
- Penanganan Storage Files:
  1. File storage seharusnya berada di `storage/app/public`, bukan di `public/storage`
  2. Langkah yang benar untuk menangani file storage:
     ```bash
     # Di server development
     # 1. Salin semua file dari public/storage ke storage/app/public
     cp -r public/storage/* storage/app/public/
     
     # 2. Hapus symbolic link lama
     rm public/storage
     
     # 3. Buat ulang symbolic link
     php artisan storage:link
     
     # 4. Track file di storage/app/public
     git add storage/app/public/*
     git commit -m "Add storage files"
     git push
     
     # Di server production
     # 1. Pull perubahan
     git pull
     
     # 2. Buat symbolic link
     php artisan storage:link
     
     # 3. Set permission
     chmod -R 775 storage/app/public
     chown -R www-data:www-data storage/app/public
     ```
