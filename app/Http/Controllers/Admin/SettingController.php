<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'whatsapp_channel' => 'nullable|url|max:255',
            'youtube_tutorial' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'discord' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'footer' => 'nullable|string',
            'operating_hours' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,svg|max:1024',
        ]);

        $setting = Setting::firstOrNew();
        $data = $validated;

        if ($request->hasFile('logo')) {
            $this->deleteFile($setting->logo);
            $data['logo'] = $this->uploadFile($request->file('logo'), 'logo');
        }

        if ($request->hasFile('favicon')) {
            $this->deleteFile($setting->favicon);
            $data['favicon'] = $this->uploadFile($request->file('favicon'), 'favicon');
        }

        $setting->fill($data)->save();

        // Clear all related caches after update
        try {
            $gameService = app(GameService::class);
            $gameService->clearCache();
        } catch (\Exception $e) {
            // If service injection fails, clear caches manually
            Cache::forget('site_settings');
            Cache::forget('active_games_with_products');
            Cache::forget('active_banners');
            Cache::forget('active_testimonials');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan website berhasil diperbarui.');
    }

    public function incrementWhatsappClicks()
    {
        $setting = Setting::firstOrNew();
        $setting->increment('whatsapp_clicks');
        
        return response()->json(['success' => true, 'clicks' => $setting->whatsapp_clicks]);
    }

    private function uploadFile($file, $prefix)
    {
        $filename = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);
        return $filename;
    }

    private function deleteFile($filename)
    {
        if ($filename && File::exists(public_path('img/' . $filename))) {
            File::delete(public_path('img/' . $filename));
        }
    }
}