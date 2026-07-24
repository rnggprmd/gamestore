<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        // Share $setting with ALL views so admin.layout (and landing) can always access it
        View::composer('*', function ($view) {
            if (!$view->offsetExists('setting')) {
                $view->with('setting', Setting::first() ?? new Setting([
                    'store_name'  => 'Gamestore Indonesia',
                    'whatsapp'    => '628123456789',
                    'footer'      => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
                ]));
            }
        });
    }
}
