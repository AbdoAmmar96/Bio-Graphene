<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;

/* ---------------- Public ---------------- */
Route::get('/', [HomeController::class, 'index'])->name('home');

/* صفحات الأقسام الكاملة (تبويبات الـ navbar) */
Route::get('/material', [HomeController::class, 'materialPage'])->name('material');
Route::get('/applications', [HomeController::class, 'applicationsPage'])->name('applications');
Route::get('/vision', [HomeController::class, 'visionPage'])->name('vision');
Route::get('/features', [HomeController::class, 'featuresPage'])->name('features');
Route::get('/gallery', [HomeController::class, 'galleryPage'])->name('gallery');

/* صفحات التفاصيل (المقالات) */
Route::get('/applications/{slug}', [HomeController::class, 'application'])->name('app.show');
Route::get('/materials/{slug}', [HomeController::class, 'material'])->name('material.show');
Route::get('/vision-docs/{slug}', [HomeController::class, 'visionDoc'])->name('vision.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/* ---------------- Auth ---------------- */
Route::get('/admin/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

/* ---------------- Admin ---------------- */
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::resource('applications', ApplicationController::class)->except(['show']);
    Route::resource('features', FeatureController::class)->except(['show']);

    Route::get('vision', [VisionController::class, 'index'])->name('vision.index');
    Route::put('vision', [VisionController::class, 'update'])->name('vision.update');

    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::patch('messages/{message}/read', [MessageController::class, 'read'])->name('messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
