# Migration & Deployment Guide with Laravel Octane (FrankenPHP)

## Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MariaDB/MySQL
- FrankenPHP Runtime
- Git

## Step 1: Project & Octane Setup

1. Install FrankenPHP Runtime:
```bash
curl -sSL https://raw.githubusercontent.com/dunglas/frankenphp/main/install.sh | sh
```

2. Clone and setup project:
```bash
git clone <repository-url>
cd event
composer install
npm install
cp .env.example .env
php artisan key:generate
```

3. Install Laravel Octane:
```bash
composer require laravel/octane
php artisan octane:install
```

4. Configure Octane for FrankenPHP in `config/octane.php`:
```php
// filepath: /var/www/event/config/octane.php
return [
    'server' => 'frankenphp',
    'https' => false,
    'host' => '0.0.0.0',
    'port' => 8000,
    'workers' => 4,
    'max_requests' => 500,
];
```

## Step 2: Database Configuration

1. Create database:
```sql
CREATE DATABASE event_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_db
DB_USERNAME=<username>
DB_PASSWORD=<password>

OCTANE_SERVER=frankenphp
```

3. Run migrations:
```bash
php artisan migrate
```

## Step 3: Performance Optimizations

1. Enable OPcache in `php.ini`:
```ini
opcache.enable=1
opcache.enable_cli=1
opcache.validate_timestamps=0
opcache.max_accelerated_files=10000
opcache.memory_consumption=128
opcache.interned_strings_buffer=16
```

2. Cache application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Step 4: FrankenPHP Service Setup

1. Create systemd service:
```ini
// filepath: /etc/systemd/system/frankenphp-event.service
[Unit]
Description=FrankenPHP Event Service
After=network.target

[Service]
User=www-data
Group=www-data
WorkingDirectory=/var/www/event
ExecStart=/usr/local/bin/frankenphp run --config=/var/www/event/Caddyfile
Restart=always

[Install]
WantedBy=multi-user.target
```

2. Create Caddyfile configuration:
```caddy
// filepath: /var/www/event/Caddyfile
{
    order php_server before file_server
}

:8000 {
    root * public/
    php_server
}
```

3. Enable and start service:
```bash
sudo systemctl enable frankenphp-event
sudo systemctl start frankenphp-event
```

## Step 5: Nginx Reverse Proxy (Optional)

```nginx
// filepath: /etc/nginx/sites-available/event
server {
    listen 80;
    server_name event.example.com;
    
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

## Step 6: Environment Specific Settings

1. Production `.env` adjustments:
```env
APP_ENV=production
APP_DEBUG=false
OCTANE_HTTPS=true
OCTANE_WORKERS=4
SESSION_DRIVER=octane
CACHE_DRIVER=octane
QUEUE_CONNECTION=octane
```

2. Set permissions:
```bash
sudo chown -R www-data:www-data /var/www/event
sudo chmod -R 775 storage bootstrap/cache
```

## Step 7: Monitoring & Maintenance

1. Monitor Octane processes:
```bash
php artisan octane:status
```

2. Graceful reload:
```bash
php artisan octane:reload
```

3. Check logs:
```bash
tail -f storage/logs/laravel.log
```

## Troubleshooting

1. If Octane fails to start:
```bash
sudo systemctl status frankenphp-event
journalctl -u frankenphp-event
```

2. Clear all caches:
```bash
php artisan optimize:clear
php artisan octane:clear
```

3. Check FrankenPHP status:
```bash
frankenphp doctor
```

## Performance Tips

1. Enable preloading in `php.ini`:
```ini
opcache.preload=/var/www/event/preload.php
opcache.preload_user=www-data
```

2. Create preload file:
```php
// filepath: /var/www/event/preload.php
<?php
require_once __DIR__.'/vendor/autoload.php';
```

3. Optimize Composer:
```bash
composer install --optimize-autoloader --no-dev
```

## Security Notes

1. Update security headers in `Caddyfile`:
```caddy
header {
    X-Frame-Options "SAMEORIGIN"
    X-XSS-Protection "1; mode=block"
    X-Content-Type-Options "nosniff"
    Referrer-Policy "strict-origin-when-cross-origin"
}
```

2. Enable HTTPS in production:
```env
OCTANE_HTTPS=true
SESSION_SECURE_COOKIE=true
```
