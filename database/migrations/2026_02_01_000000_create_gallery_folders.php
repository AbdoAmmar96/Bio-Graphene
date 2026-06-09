<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_folders', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        // اربط الصور بالفولدرات (يبقى nullable للصور القديمة قبل التصنيف)
        Schema::table('gallery_images', function (Blueprint $t) {
            $t->foreignId('folder_id')->nullable()->after('id')
              ->constrained('gallery_folders')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $t) {
            $t->dropConstrainedForeignId('folder_id');
        });
        Schema::dropIfExists('gallery_folders');
    }
};
