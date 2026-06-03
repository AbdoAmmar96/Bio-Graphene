#!/usr/bin/env bash
# Bio-Graphene quick setup
set -e
echo "→ composer install"
composer install
[ -f .env ] || { echo "→ creating .env"; cp .env.example .env; }
echo "→ app key"
php artisan key:generate
echo "→ database (sqlite)"
touch database/database.sqlite 2>/dev/null || true
php artisan migrate:fresh --seed --force
echo "→ storage link"
php artisan storage:link 2>/dev/null || true
echo ""
echo "✅ تم. شغّل:  php artisan serve   ثم افتح http://127.0.0.1:8000"
echo "   لوحة التحكم: /admin/login  —  admin@biographene.local / password"
