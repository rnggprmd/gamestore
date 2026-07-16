<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    private const CACHE_KEY = 'site_settings';
    private const CACHE_TTL = 3600; // 1 hour

    public function get(string $key, $default = null)
    {
        $settings = $this->getAllCached();
        return $settings[$key] ?? $default;
    }

    public function set(string $key, $value, string $type = 'string'): bool
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );

        // Clear cache after update
        $this->clearCache();

        return $setting->exists;
    }

    public function getAllCached(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function getFirstCached(): ?Setting
    {
        return Cache::remember(self::CACHE_KEY . '_first', self::CACHE_TTL, function () {
            return Setting::first();
        });
    }

    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_KEY . '_first');
    }

    public function incrementWhatsappClicks(): int
    {
        $setting = Setting::firstOrNew();
        $setting->increment('whatsapp_clicks');
        
        // Clear cache to get updated value
        $this->clearCache();
        
        return $setting->whatsapp_clicks;
    }

    public function getWhatsappClicks(): int
    {
        $setting = $this->getFirstCached();
        return $setting ? $setting->whatsapp_clicks : 0;
    }
}