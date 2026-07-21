<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{
    public function __construct(private GameService $gameService) {}

    /**
     * Landing page dengan semua data games, banners, dll
     */
    public function index()
    {
        try {
            $games = $this->gameService->getActiveGamesWithProducts();
            $banners = $this->gameService->getActiveBanners();
            $setting = $this->gameService->getSettings();
            $testimonials = $this->gameService->getActiveTestimonials();
            $categories = $this->gameService->getActiveCategories();

            return view('landing.index', compact(
                'games', 
                'banners', 
                'setting', 
                'testimonials',
                'categories'
            ));

        } catch (\Exception $e) {
            Log::error('Landing page error: ' . $e->getMessage());
            
            // Fallback data
            return view('landing.index', [
                'games' => collect([]),
                'banners' => collect([]),
                'setting' => new Setting(),
                'testimonials' => collect([]),
                'categories' => collect([])
            ]);
        }
    }

    /**
     * Halaman detail game dengan produk-produknya
     */
    public function gameDetail(string $slug)
    {
        try {
            $game = $this->gameService->getGameBySlug($slug);
            $setting = $this->gameService->getSettings();
            $otherGames = $this->gameService->getActiveGamesWithProducts()
                ->where('id', '!=', $game->id)
                ->take(6)
                ->values();

            return view('landing.game', compact('game', 'setting', 'otherGames'));

        } catch (\Exception $e) {
            Log::error("Game detail error for slug {$slug}: " . $e->getMessage());
            abort(404, 'Game tidak ditemukan');
        }
    }

    /**
     * AJAX endpoint untuk log WhatsApp clicks (analytics)
     */
    public function logWhatsAppClick(Request $request)
    {
        try {
            $setting = Setting::first();
            
            if ($setting) {
                $setting->increment('whatsapp_clicks');
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('WhatsApp click log error: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * API endpoint untuk search games (untuk future features)
     */
    public function searchGames(Request $request)
    {
        try {
            $query = $request->get('q', '');
            
            if (empty($query)) {
                return response()->json([]);
            }

            $games = $this->gameService->searchGames($query);

            return response()->json([
                'games' => $games->map(function ($game) {
                    return [
                        'id' => $game->id,
                        'name' => $game->name,
                        'slug' => $game->slug,
                        'thumbnail' => $game->thumbnail,
                        'url' => route('game.show', $game->slug)
                    ];
                })
            ]);

        } catch (\Exception $e) {
            Log::error('Game search error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }

    /**
     * Get site settings untuk AJAX calls — hanya field non-sensitif
     */
    public function getSiteSettings()
    {
        try {
            $setting = $this->gameService->getSettings();

            return response()->json([
                'store_name' => $setting->store_name,
                // Nomor WA tidak diekspos ke publik
            ]);

        } catch (\Exception $e) {
            Log::error('Site settings API error: ' . $e->getMessage());
            return response()->json(['error' => 'Settings unavailable'], 500);
        }
    }
}