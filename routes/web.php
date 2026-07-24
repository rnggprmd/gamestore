<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// ============================================================
// PUBLIC ROUTES - Landing Pages
// ============================================================
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/game/{slug}', [LandingController::class, 'gameDetail'])->name('game.show');

// AJAX Endpoints (rate limited)
Route::post('/log-click', [LandingController::class, 'logWhatsAppClick'])
    ->middleware('throttle:30,1')
    ->name('log-click');

Route::get('/api/search-games', [LandingController::class, 'searchGames'])
    ->middleware('throttle:60,1')
    ->name('api.search.games');

// ============================================================
// REDIRECT - After login go to admin panel
// ============================================================
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================================
// ADMIN ROUTES - Protected by auth + admin middleware
// ============================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Games Management
    Route::resource('games', GameController::class);

    // Products Management
    Route::resource('products', ProductController::class);

    // Categories Management
    Route::resource('categories', CategoryController::class);

    // Banners Management
    Route::resource('banners', BannerController::class);

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);

    // Orders Management
    // Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);

    // Site Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
