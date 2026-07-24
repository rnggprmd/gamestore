<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Order;
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
        $topProducts = OrderItem::select('product_name', 'game_name', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name', 'game_name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        // Calculate 7-day activity data (orders per day for past 7 days)
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->translatedFormat('D'); // e.g. Sen, Sel, Rab...
            $count = Order::whereDate('created_at', $date->toDateString())->count();
            
            $chartLabels[] = $dayName;
            $chartData[] = $count;
        }

        return view('admin.dashboard', compact(
            'totalGames', 
            'totalProducts', 
            'whatsappClicks', 
            'activeProductsCount', 
            'topProducts',
            'chartLabels',
            'chartData'
        ));
    }
}

