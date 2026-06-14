# 🚀 Panduan Deployment SwiftLogix

## Deployment ke VPS/Server Shared

### Persyaratan Server
- PHP 8.2+
- MySQL 8.0+
- Composer 2.0+
- Web Server: Apache atau Nginx
- SSL Certificate (disarankan)

---

## Deploy ke Apache

### 1. Upload Files

```bash
git clone https://github.com/farelzy/website_logistik.git /var/www/swiftlogix
cd /var/www/swiftlogix
composer install --no-dev --optimize-autoloader
```

### 2. Konfigurasi .env Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=swiftlogix_prod
DB_USERNAME=swiftlogix_user
DB_PASSWORD=strong_password_here
```

### 3. Setup Database

```bash
php artisan migrate --seed --force
php artisan storage:link
```

### 4. Optimasi Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 5. Konfigurasi Apache Virtual Host

```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/swiftlogix/public

    <Directory /var/www/swiftlogix/public>
        AllowOverride All
        Require all granted
    </Directory>

    SSLEngine on
    SSLCertificateFile /path/to/cert.pem
    SSLCertificateKeyFile /path/to/key.pem
</VirtualHost>
```

### 6. Set Permissions

```bash
chmod -R 775 /var/www/swiftlogix/storage
chmod -R 775 /var/www/swiftlogix/bootstrap/cache
chown -R www-data:www-data /var/www/swiftlogix
```

---

## Deploy ke Nginx

```nginx
server {
    listen 443 ssl;
    server_name yourdomain.com;
    root /var/www/swiftlogix/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
}
```

---

## Cron Job (Opsional)

Tambahkan ke crontab untuk Laravel Scheduler:

```bash
* * * * * cd /var/www/swiftlogix && php artisan schedule:run >> /dev/null 2>&1
```

---

## Update Aplikasi

```bash
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

---

## Troubleshooting

### 500 Internal Server Error
```bash
php artisan config:clear
php artisan cache:clear
chmod -R 775 storage/ bootstrap/cache/
```

### Gambar tidak tampil
```bash
php artisan storage:link
```

### Database connection error
- Periksa konfigurasi DB di `.env`
- Pastikan MySQL berjalan: `systemctl status mysql`
