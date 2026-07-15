<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // ==========================================
    // DASHBOARD STATS
    // ==========================================
    public function dashboard()
    {
        $totalGames = Game::count();
        $totalProducts = Product::count();
        
        $setting = Setting::first();
        $whatsappClicks = $setting ? $setting->whatsapp_clicks : 0;
        
        $activeProductsCount = Product::where('status', true)->count();
        
        // Top selling products by summing quantity in order_items
        $topProducts = OrderItem::select('product_name', 'game_name', \DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name', 'game_name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalGames', 'totalProducts', 'whatsappClicks', 'activeProductsCount', 'topProducts'));
    }

    // ==========================================
    // GAMES MANAGEMENT
    // ==========================================
    public function games()
    {
        $games = Game::latest()->get();
        return view('admin.games.index', compact('games'));
    }

    public function gameCreate()
    {
        return view('admin.games.create');
    }

    public function gameStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_thumb_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['thumbnail'] = $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['banner'] = $filename;
        }

        $data['status'] = $request->has('status');

        Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil ditambahkan.');
    }

    public function gameEdit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function gameUpdate(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($game->thumbnail && File::exists(public_path('img/' . $game->thumbnail))) {
                File::delete(public_path('img/' . $game->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_thumb_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['thumbnail'] = $filename;
        }

        if ($request->hasFile('banner')) {
            // Delete old banner
            if ($game->banner && File::exists(public_path('img/' . $game->banner))) {
                File::delete(public_path('img/' . $game->banner));
            }

            $file = $request->file('banner');
            $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['banner'] = $filename;
        }

        $data['status'] = $request->has('status');

        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil diperbarui.');
    }

    public function gameDestroy(Game $game)
    {
        if ($game->thumbnail && File::exists(public_path('img/' . $game->thumbnail))) {
            File::delete(public_path('img/' . $game->thumbnail));
        }
        if ($game->banner && File::exists(public_path('img/' . $game->banner))) {
            File::delete(public_path('img/' . $game->banner));
        }

        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game berhasil dihapus.');
    }

    // ==========================================
    // PRODUCTS MANAGEMENT
    // ==========================================
    public function products()
    {
        $products = Product::with('game', 'category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function productCreate()
    {
        $games = Game::all();
        $categories = Category::all();
        return view('admin.products.create', compact('games', 'categories'));
    }

    public function productStore(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_prod_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->has('status');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function productEdit(Product $product)
    {
        $games = Game::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'games', 'categories'));
    }

    public function productUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            if ($product->image && File::exists(public_path('img/' . $product->image))) {
                File::delete(public_path('img/' . $product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_prod_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->has('status');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function productDestroy(Product $product)
    {
        if ($product->image && File::exists(public_path('img/' . $product->image))) {
            File::delete(public_path('img/' . $product->image));
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // ==========================================
    // BANNERS MANAGEMENT
    // ==========================================
    public function banners()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function bannerCreate()
    {
        return view('admin.banners.create');
    }

    public function bannerStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->has('status');

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function bannerEdit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function bannerUpdate(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            if ($banner->image && File::exists(public_path('img/' . $banner->image))) {
                File::delete(public_path('img/' . $banner->image));
            }

            $file = $request->file('image');
            $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->has('status');

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function bannerDestroy(Banner $banner)
    {
        if ($banner->image && File::exists(public_path('img/' . $banner->image))) {
            File::delete(public_path('img/' . $banner->image));
        }

        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }

    // ==========================================
    // TESTIMONIALS MANAGEMENT
    // ==========================================
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialCreate()
    {
        return view('admin.testimonials.create');
    }

    public function testimonialStore(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function testimonialEdit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function testimonialUpdate(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function testimonialDestroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    // ==========================================
    // SETTINGS MANAGEMENT (General Site Identity)
    // ==========================================
    public function settings()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings', compact('setting'));
    }

    public function settingsUpdate(Request $request)
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
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,svg|max:1028',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }

        $data = $validated;

        if ($request->hasFile('logo')) {
            if ($setting->logo && File::exists(public_path('img/' . $setting->logo))) {
                File::delete(public_path('img/' . $setting->logo));
            }
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['logo'] = $filename;
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon && File::exists(public_path('img/' . $setting->favicon))) {
                File::delete(public_path('img/' . $setting->favicon));
            }
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $data['favicon'] = $filename;
        }

        $setting->fill($data)->save();

        return redirect()->route('admin.settings')->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
