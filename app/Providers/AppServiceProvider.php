<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Make global site settings available to every frontend view as $settings.
        View::composer('*', function ($view) {
            if (Schema::hasTable('settings')) {
                $view->with('settings', Setting::map());
            } else {
                $view->with('settings', []);
            }
        });
    }
}
