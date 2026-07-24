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
        $setting = $this->getFirstCached();
        return $setting ? ($setting->$key ?? $default) : $default;
    }

    public function set(string $key, $value): bool
    {
        $setting = Setting::first() ?? new Setting();
        $setting->$key = $value;
        $saved = $setting->save();

        // Clear cache after update
        $this->clearCache();

        return $saved;
    }

    public function getAllCached(): array
    {
        $setting = $this->getFirstCached();
        return $setting ? $setting->toArray() : [];
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
        Cache::forget('site_settings_global');
    }

    public function incrementWhatsappClicks(): int
    {
        $setting = Setting::first();
        if ($setting) {
            $setting->increment('whatsapp_clicks');
            $this->clearCache();
            return $setting->whatsapp_clicks;
        }
        return 0;
    }

    public function getWhatsappClicks(): int
    {
        $setting = $this->getFirstCached();
        return $setting ? $setting->whatsapp_clicks : 0;
    }
}