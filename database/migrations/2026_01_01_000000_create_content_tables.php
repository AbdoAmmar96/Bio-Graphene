<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->text('value')->nullable();
            $t->timestamps();
        });

        Schema::create('materials', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('title');
            $t->text('short')->nullable();
            $t->longText('body')->nullable();
            $t->string('file_url')->nullable();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('applications', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('name');
            $t->string('symbol')->nullable();
            $t->string('icon')->default('symbol');
            $t->text('short')->nullable();
            $t->longText('body')->nullable();
            $t->string('file_url')->nullable();
            $t->boolean('is_overview')->default(false);
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('vision_axes', function (Blueprint $t) {
            $t->id();
            $t->string('number');
            $t->string('title');
            $t->text('body')->nullable();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('vision_stats', function (Blueprint $t) {
            $t->id();
            $t->string('value');
            $t->string('label');
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('vision_docs', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('title');
            $t->string('subtitle')->nullable();
            $t->longText('body')->nullable();
            $t->string('file_url')->nullable();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('features', function (Blueprint $t) {
            $t->id();
            $t->string('icon')->default('star');
            $t->string('title');
            $t->text('body')->nullable();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('gallery_images', function (Blueprint $t) {
            $t->id();
            $t->string('path');
            $t->string('caption')->nullable();
            $t->integer('sort')->default(0);
            $t->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('contact')->nullable();
            $t->text('message');
            $t->boolean('is_read')->default(false);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['contact_messages','gallery_images','features','vision_docs','vision_stats','vision_axes','applications','materials','site_settings'] as $tbl) {
            Schema::dropIfExists($tbl);
        }
    }
};
