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

// Landing Pages (Public) - Using LandingController
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/game/{slug}', [LandingController::class, 'gameDetail'])->name('game.show');

// AJAX Endpoints
Route::post('/log-click', [LandingController::class, 'logWhatsAppClick'])->name('log-click');
Route::get('/api/search-games', [LandingController::class, 'searchGames'])->name('api.search.games');
Route::get('/api/site-settings', [LandingController::class, 'getSiteSettings'])->name('api.site.settings');

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

    // Categories Management CRUD (NEW!)
    Route::resource('categories', CategoryController::class);

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
