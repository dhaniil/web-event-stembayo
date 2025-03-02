# Deployment Guide

## 1. Server Requirements

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install dependencies
sudo apt install -y git curl unzip nginx mariadb-server \
    php8.2-fpm php8.2-cli php8.2-common php8.2-mysql \
    php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl \
    php8.2-xml php8.2-bcmath php8.2-intl php8.2-opcache

# Install Node.js 18
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Install image optimization tools (optional)
sudo apt-get install -y jpegoptim optipng pngquant gifsicle webp
```

## 2. Database Setup

```sql
CREATE DATABASE event_stembayo;
CREATE USER 'event_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON event_stembayo.* TO 'event_user'@'localhost';
FLUSH PRIVILEGES;
```

## 3. Application Setup

```bash
# Clone and set permissions
cd /var/www
sudo git clone https://github.com/username/bursa-event-sekolah.git event
cd event
sudo chown -R www-data:www-data /var/www/event
sudo find /var/www/event -type f -exec chmod 644 {} \;
sudo find /var/www/event -type d -exec chmod 755 {} \;
sudo chmod -R 775 storage bootstrap/cache

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install

# Environment setup
cp .env.example .env
php artisan key:generate
```

### Production .env Configuration
```env
APP_NAME="Bursa Event Sekolah"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://event.stembayo.sch.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=event_stembayo
DB_USERNAME=event_user
DB_PASSWORD=your_password

VITE_SERVER=false
ASSET_URL=https://event.stembayo.sch.id
```

### Initialize Application
```bash
php artisan migrate --seed
php artisan storage:link
php artisan optimize
npm run build
php artisan filament:assets
```

## 4. Nginx Configuration

```nginx
server {
    listen 80;
    server_name event.stembayo.sch.id;
    root /var/www/event/public;

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }
}
```

## 5. SSL Setup
```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d event.stembayo.sch.id
```

## Maintenance & Updates

```bash
cd /var/www/event
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
npm install && npm run build
php artisan optimize
php artisan filament:assets
```

## Troubleshooting

### Assets Issues
1. Rebuild assets: `npm run build`
2. Check VITE_SERVER=false in .env
3. Verify ASSET_URL configuration
4. Clear caches:
```bash
php artisan view:clear
php artisan cache:clear
php artisan route:clear
php artisan config:clear
```

### Permission Issues
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data /var/www/event
```

## Default Account

- Email: admin@admin.com
- Password: password