<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderItem;
use App\Services\GameService;

class AdminController extends Controller
{
    public function __construct(private GameService $gameService) {}

    public function dashboard()
    {
        $totalGames = Game::count();
        $totalProducts = Product::count();
        $activeProductsCount = Product::active()->count();
        
        $setting = Setting::first();
        $whatsappClicks = $setting ? $setting->whatsapp_clicks : 0;
        
        // Optimized top products query with eager loading
        $topProducts = OrderItem::select('product_name', 'game_name', \DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name', 'game_name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalGames', 
            'totalProducts', 
            'whatsappClicks', 
            'activeProductsCount', 
            'topProducts'
        ));
    }
}

