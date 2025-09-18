#!/bin/bash
set -e

cd /var/www/uada_mardan

echo "🔄 Pulling latest code..."
git pull origin main

echo "📦 Installing dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "⚙️ Running migrations..."
php artisan migrate --force

echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "📂 Fixing permissions..."
chown -R www-data:www-data /var/www/uada_mardan/storage /var/www/uada_mardan/bootstrap/cache
chmod -R 775 /var/www/uada_mardan/storage /var/www/uada_mardan/bootstrap/cache

echo "✅ Deployment finished!"
