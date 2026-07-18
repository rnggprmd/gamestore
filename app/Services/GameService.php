<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class GameService
{
    private const CACHE_TTL = 3600; // 1 hour

    public function getActiveGamesWithProducts()
    {
        return Cache::remember('active_games_with_products', self::CACHE_TTL, function () {
            return Game::where('status', true)
                ->with(['products' => function ($q) {
                    $q->where('status', true);
                }])
                ->get();
        });
    }

    public function getGameBySlug(string $slug)
    {
        return Cache::remember("game_slug_{$slug}", self::CACHE_TTL, function () use ($slug) {
            return Game::where('slug', $slug)
                ->where('status', true)
                ->with(['products' => function ($q) {
                    $q->where('status', true);
                }])
                ->firstOrFail();
        });
    }

    public function getActiveBanners()
    {
        return Cache::remember('active_banners', self::CACHE_TTL, function () {
            return Banner::active()->ordered()->get();
        });
    }

    public function getActiveTestimonials()
    {
        return Cache::remember('active_testimonials', self::CACHE_TTL, function () {
            return Testimonial::active()->get();
        });
    }

    public function getSettings()
    {
        return Cache::remember('site_settings', self::CACHE_TTL, function () {
            return Setting::first() ?? $this->getDefaultSettings();
        });
    }

    private function getDefaultSettings(): Setting
    {
        return new Setting([
            'store_name' => 'Gamestore Indonesia',
            'whatsapp' => '628123456789',
            'footer' => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
        ]);
    }

    public function clearCache(): void
    {
        Cache::forget('active_games_with_products');
        Cache::forget('active_banners');
        Cache::forget('active_testimonials');
        Cache::forget('site_settings');
    }

    public function clearGameCache(string $slug): void
    {
        Cache::forget("game_slug_{$slug}");
        $this->clearCache();
    }
}