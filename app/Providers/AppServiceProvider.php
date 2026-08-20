<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /*
         | `artisan serve` hands the PHP dev server only an allow-list of
         | environment variables, and TMP/TEMP are not on it. Windows works out
         | the upload temporary directory from those, so without them PHP has
         | nowhere to put an incoming file and rejects it with "unable to
         | create a temporary file" — before Laravel or Livewire ever sees the
         | request, which makes every upload in the admin panel fail silently.
         | Only the local dev server is affected; a real web server is not.
         */
        if (PHP_OS_FAMILY === 'Windows') {
            foreach (['TMP', 'TEMP'] as $variable) {
                if (! in_array($variable, ServeCommand::$passthroughVariables, true)) {
                    ServeCommand::$passthroughVariables[] = $variable;
                }
            }
        }
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
