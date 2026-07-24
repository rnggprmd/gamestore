<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        // Share $setting with ALL views so admin.layout (and landing) can always access it.
        // Uses cache to avoid querying DB on every partial view render.
        View::composer('*', function ($view) {
            if (!$view->offsetExists('setting')) {
                $setting = Cache::remember('site_settings_global', 3600, function () {
                    return Setting::first() ?? new Setting([
                        'store_name' => 'Gamestore Indonesia',
                        'whatsapp'   => '628123456789',
                        'footer'     => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
                    ]);
                });
                $view->with('setting', $setting);
            }
        });
    }
}
