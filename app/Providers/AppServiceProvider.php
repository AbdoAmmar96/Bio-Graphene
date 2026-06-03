<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share site settings with every view as $S (key => value)
        try {
            if (Schema::hasTable('site_settings')) {
                View::share('S', SiteSetting::pluck('value', 'key'));
            } else {
                View::share('S', collect());
            }
        } catch (\Throwable $e) {
            View::share('S', collect());
        }
    }
}
