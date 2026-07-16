<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Game;
use App\Models\Category;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct(private GameService $gameService) {}

    public function index()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'latest');

        $products = Product::query()
            ->withRelations()
            ->search($search, ['name', 'description'])
            ->filterByStatus($status);

        if ($sort === 'oldest') {
            $products = $products->oldest();
        } elseif ($sort === 'price_asc') {
            $products = $products->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $products = $products->orderBy('price', 'desc');
        } else {
            $products = $products->latest();
        }

        $products = $products->paginate(10);
        $games = Game::active()->get();
        $categories = Category::all();
        
        return view('admin.products.index', compact('products', 'games', 'categories', 'search', 'status', 'sort'));
    }

    public function create()
    {
        $games = Game::active()->get();
        $categories = Category::all();
        
        return view('admin.products.create', compact('games', 'categories'));
    }

    public function store(Request $request)
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
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'));
        }

        Product::create($data);
        $this->gameService->clearCache();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $games = Game::active()->get();
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'games', 'categories'));
    }

    public function update(Request $request, Product $product)
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
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $this->deleteFile($product->image);
            $data['image'] = $this->uploadFile($request->file('image'));
        }

        $product->update($data);
        $this->gameService->clearCache();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteFile($product->image);
        $product->delete();
        
        $this->gameService->clearCache();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function uploadFile($file)
    {
        $filename = time() . '_prod_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
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