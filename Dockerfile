# Tahap 1: Gunakan Composer berbasis Alpine untuk instalasi dependensi
FROM composer:latest AS composer

WORKDIR /var/www/event

# Install ekstensi yang dibutuhkan di Alpine Linux
RUN apk update && apk add --no-cache icu-dev && docker-php-ext-install intl exif

# Copy file composer
COPY composer.json composer.lock ./

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Tahap 2: Gunakan FrankenPHP berbasis Debian 12 untuk menjalankan Laravel
FROM dunglas/frankenphp:latest

WORKDIR /var/www/event

# Install ekstensi tambahan di Debian
RUN apt update && apt install -y libicu-dev && docker-php-ext-install intl exif

# Copy semua file proyek
COPY . .
COPY --from=composer /var/www/event/vendor ./vendor

# Pastikan folder storage & bootstrap/cache bisa ditulis
RUN chmod -R 777 storage bootstrap/cache

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=80", "--admin-port=2020"]
