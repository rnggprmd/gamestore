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
                  ->orWhere('slug', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $categories = $query->withCount('products')
                           ->paginate(10)
                           ->withQueryString();

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
                'slug' => 'nullable|string|max:255|unique:categories,slug',
                'description' => 'nullable|string|max:2000',
                'status' => 'boolean',
            ]);

            // Generate slug if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            } else {
                $validated['slug'] = Str::slug($validated['slug']);
            }

            // Ensure slug is unique
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Category::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            $validated['status'] = $request->has('status');

            Category::create($validated);
            $this->gameService->clearCache();

            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
            }

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Category store error: ' . $e->getMessage());
            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
            }
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.')->withInput();
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
                'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
                'description' => 'nullable|string|max:2000',
                'status' => 'boolean',
            ]);

            // Generate slug if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            } else {
                $validated['slug'] = Str::slug($validated['slug']);
            }

            // Ensure slug is unique (excluding current record)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Category::where('slug', $validated['slug'])->where('id', '!=', $category->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            $validated['status'] = $request->has('status');

            $category->update($validated);
            $this->gameService->clearCache();

            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
                session()->flash('_edit_id', $category->id);
            }

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
                session()->flash('_edit_id', $category->id);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Category update error: ' . $e->getMessage());
            if ($request->has('_form_type')) {
                session()->flash('_form_type', $request->_form_type);
                session()->flash('_edit_id', $category->id);
            }
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.')->withInput();
        }
    }

    public function destroy(Category $category)
    {
        try {
            if ($category->products()->count() > 0) {
                return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
            }

            $category->delete();
            $this->gameService->clearCache();

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Category delete error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
}