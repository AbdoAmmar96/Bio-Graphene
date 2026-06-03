# Bio-Graphene — موقع + لوحة تحكم (Laravel)

موقع شركة **Bio-Graphene** (إحدى شركات مجموعة Mining Earth) — صفحة واحدة احترافية (RTL) + صفحات تفصيلية لكل تطبيق/مستند، مع **لوحة تحكم مخصّصة بالكامل** للتحكم في كل المحتوى **بدون Filament**.

- **التقنيات:** Laravel 13 (متوافق مع 11+) · Blade · لوحة تحكم Blade مخصّصة · CSS/JS عادي (بدون build step) · SQLite (تشغيل فوري) أو MySQL (إنتاج).
- كل المحتوى الحقيقي من ملفات الـ Word **مزروع جاهز** في قاعدة البيانات، وقابل للتعديل من لوحة التحكم.

---

## التشغيل السريع (تشغيل فوري بـ SQLite)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed     # قاعدة البيانات مزروعة بالفعل، الأمر ده اختياري
php artisan storage:link
php artisan serve
```

ثم افتح: `http://127.0.0.1:8000`

> أو شغّل سكربت واحد يعمل كل ده: `bash setup.sh`

---

## التشغيل على Laravel Herd + MySQL (الإنتاج)

1. حط المشروع في مجلد Herd، وافتح:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
2. اعمل قاعدة بيانات MySQL (مثلاً `biographene`)، وعدّل `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=biographene
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. زرع البيانات واربط التخزين:
   ```bash
   php artisan migrate:fresh --seed
   php artisan storage:link
   ```
4. Herd هيخدم الموقع تلقائيًا على `https://bio-graphene.test`.

---

## لوحة التحكم

- الرابط: **`/admin/login`**
- البريد: `admin@biographene.local`
- كلمة المرور: `password`

> **مهم:** غيّر كلمة المرور فورًا:
> ```bash
> php artisan tinker
> >>> $u = App\Models\User::first(); $u->password = Hash::make('كلمة_مرور_قوية'); $u->save();
> ```

### اللي تقدر تتحكم فيه من اللوحة
| القسم | التحكم |
|---|---|
| **التطبيقات** | إضافة/تعديل/حذف بطاقات التطبيقات الصناعية + محتواها الكامل |
| **المادة المبتكرة** | نسخ المادة (الأساسية / V1 ...) |
| **رؤية المستقبل** | المحاور الثلاثة + شريط الأرقام + مستندات (الأرباح/الرؤية) |
| **المميزات** | بطاقات المميزات وأيقوناتها |
| **معرض الصور** | رفع وحذف صور المعمل والإنتاج |
| **إعدادات الموقع** | كل نصوص الهيرو + بيانات التواصل + الفوتر + روابط واتساب + **إظهار/إخفاء معرض الصور** |
| **الرسائل** | الرسائل الواردة من نموذج «تواصل معنا» (قراءة/حذف) |

> **التبويبات صفحات منفصلة:** كل تبويب في الـ navbar (المادة المبتكرة `/material` · التطبيقات `/applications` · رؤية المستقبل `/vision` · المميزات `/features` · معرض الصور `/gallery`) له صفحة مستقلة كاملة، والصفحة الرئيسية تعرض ملخصًا لكل قسم مع زر «الصفحة الكاملة».
> **إخفاء المعرض:** من إعدادات الموقع تقدر تخفي معرض الصور — فيختفي تبويبه وتتعطّل صفحته (404).

---

## ملاحظات

- **اللوجو:** حاليًا وردمارك متدرّج «Bio Graphene». لما يجهز اللوجو النهائي نقدر نستبدله في `resources/views/layouts/public.blade.php` و `admin.blade.php`.
- **المعرض:** بيظهر «صورة قريبًا» مكان الصور لحد ما ترفع صور من Dashboard ← معرض الصور.
- **بطاقة «التطبيقات الرئيسية»:** الملف الأصلي لها لسه ماوصلش، فمحتواها دلوقتي نص مؤقت — تقدر تعدّله من Dashboard ← التطبيقات ← «التطبيقات الرئيسية».
- محتوى التطبيقات/المادة/المستندات بصيغة HTML بسيط (h3, p, ul, li, strong) وتقدر تعدّله من حقل «المحتوى الكامل».

## هيكل المشروع (المخصّص)
```
app/Models/                 # SiteSetting, Material, Application, VisionAxis/Stat/Doc, Feature, GalleryImage, ContactMessage
app/Http/Controllers/       # Home, Contact, Auth/Login
app/Http/Controllers/Admin/ # Dashboard, Setting, Material, Application, Feature, Vision, Gallery, Message
database/migrations/2026_01_01_000000_create_content_tables.php
database/seeders/DatabaseSeeder.php   # كل المحتوى الحقيقي
resources/views/layouts/    # public.blade.php, admin.blade.php
resources/views/public/     # home.blade.php, detail.blade.php
resources/views/auth/       # login.blade.php
resources/views/admin/      # dashboard + كل صفحات الـ CRUD
public/css/site.css, admin.css
public/js/site.js           # الهيدر + المنيو + الأنيميشن + شبكة الجرافين
routes/web.php
```
