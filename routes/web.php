<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Testimonial;

Route::get('/', function () {
    $games = Game::where('status', true)->with(['products' => function ($q) {
        $q->where('status', true);
    }])->get();
    
    $banners = Banner::where('status', true)->get();
    $setting = Setting::first() ?? new Setting([
        'store_name' => 'Gamestore Indonesia',
        'whatsapp' => '628123456789',
        'footer' => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
    ]);
    $testimonials = Testimonial::where('status', true)->get();

    return view('landing.index', compact('games', 'banners', 'setting', 'testimonials'));
})->name('home');

Route::get('/game/{slug}', function (string $slug) {
    $game = Game::where('slug', $slug)->where('status', true)->with(['products' => function ($q) {
        $q->where('status', true);
    }])->firstOrFail();
    
    $setting = Setting::first() ?? new Setting([
        'store_name' => 'Gamestore Indonesia',
        'whatsapp' => '628123456789',
        'footer' => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
    ]);

    return view('landing.game', compact('game', 'setting'));
})->name('game.show');

// WhatsApp click logger (Ajax endpoint)
Route::post('/log-click', function () {
    $setting = Setting::first();
    if ($setting) {
        $setting->increment('whatsapp_clicks');
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
    Route::get('/games', [AdminController::class, 'games'])->name('games.index');
    Route::get('/games/create', [AdminController::class, 'gameCreate'])->name('games.create');
    Route::post('/games', [AdminController::class, 'gameStore'])->name('games.store');
    Route::get('/games/{game}/edit', [AdminController::class, 'gameEdit'])->name('games.edit');
    Route::put('/games/{game}', [AdminController::class, 'gameUpdate'])->name('games.update');
    Route::delete('/games/{game}', [AdminController::class, 'gameDestroy'])->name('games.destroy');

    // Products Management CRUD
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'productCreate'])->name('products.create');
    Route::post('/products', [AdminController::class, 'productStore'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'productUpdate'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'productDestroy'])->name('products.destroy');

    // Banners Management CRUD
    Route::get('/banners', [AdminController::class, 'banners'])->name('banners.index');
    Route::get('/banners/create', [AdminController::class, 'bannerCreate'])->name('banners.create');
    Route::post('/banners', [AdminController::class, 'bannerStore'])->name('banners.store');
    Route::get('/banners/{banner}/edit', [AdminController::class, 'bannerEdit'])->name('banners.edit');
    Route::put('/banners/{banner}', [AdminController::class, 'bannerUpdate'])->name('banners.update');
    Route::delete('/banners/{banner}', [AdminController::class, 'bannerDestroy'])->name('banners.destroy');

    // Testimonials Management CRUD
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials.index');
    Route::get('/testimonials/create', [AdminController::class, 'testimonialCreate'])->name('testimonials.create');
    Route::post('/testimonials', [AdminController::class, 'testimonialStore'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [AdminController::class, 'testimonialEdit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [AdminController::class, 'testimonialUpdate'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [AdminController::class, 'testimonialDestroy'])->name('testimonials.destroy');

    // Site Settings Management
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'settingsUpdate'])->name('settings.update');
    
    // Default profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
