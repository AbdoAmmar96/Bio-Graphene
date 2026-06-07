# دليل النشر (Deployment) — Bio-Graphene

دليل رفع المشروع على سيرفر إنتاج. المشروع **Laravel 13** (PHP ^8.3)، واجهة Blade بـ CSS/JS عادي من `public/`
(**بدون خطوة build** — لا حاجة لـ `npm install` أو `npm run build`).

---

## ⚙️ المتطلبات على السيرفر

| المتطلب | الإصدار |
|---|---|
| PHP | **8.3+** مع امتدادات: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `curl` |
| Composer | 2.x |
| قاعدة بيانات | **SQLite** (تشغيل فوري) أو **MySQL 8** / MariaDB (مُوصى به للإنتاج) |
| امتداد PHP لـ DB | `pdo_sqlite` (لـ SQLite) أو `pdo_mysql` (لـ MySQL) |

> لا تحتاج Node.js — كل أصول الواجهة جاهزة في `public/css` و `public/js`.

---

## 🚀 خطوات النشر (عامة)

```bash
# 1) اجلب الكود
git clone https://github.com/AbdoAmmar96/Bio-Graphene.git
cd Bio-Graphene

# 2) الاعتماديات (إنتاج فقط — بدون حزم التطوير)
composer install --no-dev --optimize-autoloader

# 3) البيئة والمفتاح
cp .env.example .env
php artisan key:generate

# 4) عدّل .env (انظر القسم التالي) ثم زرع قاعدة البيانات
php artisan migrate --seed --force

# 5) اربط مجلد التخزين (لصور المعرض)
php artisan storage:link

# 6) كاش الإنتاج (أداء أعلى)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

ثم اضبط **document root** على مجلد `public/` (مهم — انظر أقسام الاستضافة).

---

## 🔐 إعدادات `.env` للإنتاج

```env
APP_NAME="Bio-Graphene"
APP_ENV=production
APP_DEBUG=false                      # لازم false في الإنتاج
APP_URL=https://your-domain.com      # دومينك الحقيقي
APP_LOCALE=ar

# --- قاعدة البيانات (اختر واحدة) ---

# (أ) SQLite — أبسط
DB_CONNECTION=sqlite
# تأكد من وجود الملف: touch database/database.sqlite

# (ب) MySQL — مُوصى به للإنتاج
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=biographene
# DB_USERNAME=your_user
# DB_PASSWORD=your_password
```

> **مهم:** `APP_DEBUG=false` و `APP_KEY` مولّد. لا ترفع ملف `.env` إلى git أبدًا (مُتجاهَل أصلًا في `.gitignore`).

---

## 🔒 الأمان بعد النشر (إلزامي)

1. **غيّر كلمة مرور الأدمن فورًا** (الافتراضية `password` ضعيفة):
   ```bash
   php artisan tinker
   >>> $u = App\Models\User::first(); $u->password = Hash::make('كلمة-مرور-قوية'); $u->save();
   ```
2. تأكد `APP_DEBUG=false` و `APP_ENV=production`.
3. شغّل الموقع على **HTTPS** (شهادة SSL — مثل Let's Encrypt).
4. صلاحيات المجلدات: `storage/` و `bootstrap/cache/` قابلة للكتابة بواسطة مستخدم الويب.

---

## 🟢 الاستضافة (أ): استضافة مشتركة / cPanel

1. ارفع المشروع (أو `git clone` من Terminal في cPanel).
2. شغّل `composer install --no-dev --optimize-autoloader` (أو ارفع `vendor/` لو مفيش Composer).
3. من **Setup PHP**: اختر PHP 8.3.
4. **المشكلة الشائعة:** الاستضافة المشتركة تخدم من `public_html/` وليس `public/`. الحل:
   - انقل محتويات `public/` إلى `public_html/`، **أو**
   - اعمل symlink، **أو** عدّل `public_html/index.php` ليشير لمسار المشروع:
     ```php
     require __DIR__.'/../bio-graphene/vendor/autoload.php';
     $app = require_once __DIR__.'/../bio-graphene/bootstrap/app.php';
     ```
5. أنشئ قاعدة MySQL من cPanel وحدّث `.env`.
6. شغّل عبر Terminal: `php artisan migrate --seed --force && php artisan storage:link`.

---

## 🟣 الاستضافة (ب): VPS مع Nginx + PHP-FPM

ضع المشروع في `/var/www/bio-graphene` ثم:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/bio-graphene/public;        # ← مجلد public

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* { deny all; }   # امنع الوصول لملفات .env وغيرها
}
```

صلاحيات:
```bash
sudo chown -R www-data:www-data /var/www/bio-graphene
sudo chmod -R 775 storage bootstrap/cache
```

ثم: `certbot --nginx -d your-domain.com` لتفعيل HTTPS.

---

## 🐘 الاستضافة (ج): Laravel Herd / Valet (محلي أو ماك)

ضع المشروع في مجلد Herd، وسيُخدَم تلقائيًا على `https://bio-graphene.test`. ثم:
```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed && php artisan storage:link
```

---

## 🔄 التحديث (Re-deploy)

عند رفع تعديلات جديدة:
```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force            # لو في migrations جديدة
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

> **لا تشغّل `migrate:fresh` في الإنتاج** — يمسح كل البيانات. استخدم `migrate` فقط.

---

## 🧹 إعادة ضبط الكاش (للتشخيص)

```bash
php artisan optimize:clear     # يمسح config/route/view/event cache دفعة واحدة
```

---

## ✅ قائمة تحقق نهائية قبل الإطلاق

- [ ] `APP_ENV=production` و `APP_DEBUG=false`
- [ ] `APP_KEY` مولّد و `.env` غير مرفوع على git
- [ ] document root = `public/`
- [ ] HTTPS مفعّل
- [ ] `php artisan migrate --seed --force` تم بنجاح
- [ ] `php artisan storage:link` تم (المعرض يعرض الصور)
- [ ] **كلمة مرور الأدمن اتغيّرت**
- [ ] `storage/` و `bootstrap/cache/` قابلة للكتابة
- [ ] كاش الإنتاج (`config:cache`, `route:cache`, `view:cache`) مفعّل

---

## 📋 ملاحظات خاصة بالمشروع

- **لا build للأصول:** صفحات الموقع تستخدم `public/css/site.css` و `public/css/admin.css` و `public/js/site.js` مباشرة. (الـ `@vite` موجود فقط في `welcome.blade.php` غير المستخدمة.)
- **المحتوى مزروع بالكامل** في `DatabaseSeeder` + `database/seed_sections.php` — فأمر `--seed` يبني كل نصوص الموقع.
- **لوحة التحكم:** `/admin/login` (الافتراضي `admin@biographene.local` / `password` — **غيّرها**).
- **معرض الصور:** يحتاج `storage:link`؛ وقابل للإخفاء كليًا من إعدادات الموقع.
- راجع [README.md](README.md) للتشغيل المحلي و [DESIGN-SYSTEM.md](DESIGN-SYSTEM.md) لنظام التصميم.
