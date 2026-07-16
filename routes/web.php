<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Services\GameService;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function (GameService $gameService) {
    $games = $gameService->getActiveGamesWithProducts();
    $banners = $gameService->getActiveBanners();
    $setting = $gameService->getSettings();
    $testimonials = $gameService->getActiveTestimonials();

    return view('landing.index', compact('games', 'banners', 'setting', 'testimonials'));
})->name('home');

Route::get('/game/{slug}', function (string $slug, GameService $gameService) {
    $game = $gameService->getGameBySlug($slug);
    $setting = $gameService->getSettings();

    return view('landing.game', compact('game', 'setting'));
})->name('game.show');

// WhatsApp click logger (Ajax endpoint)
Route::post('/log-click', function (GameService $gameService) {
    $setting = Setting::first();
    if ($setting) {
        $setting->increment('whatsapp_clicks');
        $gameService->clearCache();
    }
    return response()->json(['success' => true]);
})->name('log-click');

// Redirect from default login /dashboard to our custom /admin panel
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes (Protected by auth middleware)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Games Management CRUD
    Route::resource('games', GameController::class);

    // Products Management CRUD
    Route::resource('products', ProductController::class);

    // Banners Management CRUD
    Route::resource('banners', BannerController::class);

    // Testimonials Management CRUD
    Route::resource('testimonials', TestimonialController::class);

    // Site Settings Management
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Default profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
