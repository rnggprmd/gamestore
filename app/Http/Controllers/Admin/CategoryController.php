<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(private GameService $gameService) {}

    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $categories = $query->withCount('products')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string',
                'status' => 'boolean',
            ]);

            $validated['slug'] = Str::slug($validated['name']);
            $validated['status'] = $request->has('status');

            Category::create($validated);
            $this->gameService->clearCache();

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string',
                'status' => 'boolean',
            ]);

            $validated['slug'] = Str::slug($validated['name']);
            $validated['status'] = $request->has('status');

            $category->update($validated);
            $this->gameService->clearCache();

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Category $category)
    {
        try {
            // Check if category has products
            if ($category->products()->count() > 0) {
                return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
            }

            $category->delete();
            $this->gameService->clearCache();

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}