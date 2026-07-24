<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class BannerController extends Controller
{
    public function __construct(private GameService $gameService) {}

    public function index()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'latest');

        $banners = Banner::query()
            ->search($search, ['title', 'description'])
            ->filterByStatus($status);

        if ($sort === 'oldest') {
            $banners = $banners->oldest();
        } elseif ($sort === 'order') {
            $banners = $banners->orderBy('order', 'asc');
        } else {
            $banners = $banners->latest();
        }

        $banners = $banners->get();

        return view('admin.banners.index', compact('banners', 'search', 'status', 'sort'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'button_text' => 'nullable|string|max:255',
                'button_link' => 'nullable|string|max:255',
                'link' => 'nullable|string|max:255',
                'order' => 'nullable|integer|min:0',
            ]);

            $data = $validated;
            $data['status'] = $request->has('status');
            $data['order'] = $request->input('order', 0);

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'));
            }

            Banner::create($data);

            $this->gameService->clearCache();

            return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.banners.index')
                ->withErrors($e->errors())
                ->withInput($request->all())
                ->with('_form_type', 'create');
        }
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'button_text' => 'nullable|string|max:255',
                'button_link' => 'nullable|string|max:255',
                'link' => 'nullable|string|max:255',
                'order' => 'nullable|integer|min:0',
            ]);

            $data = $validated;
            $data['status'] = $request->has('status');
            $data['order'] = $request->input('order', 0);

            if ($request->hasFile('image')) {
                $this->deleteFile($banner->image);
                $data['image'] = $this->uploadFile($request->file('image'));
            }

            $banner->update($data);

            $this->gameService->clearCache();

            return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.banners.index')
                ->withErrors($e->errors())
                ->withInput($request->all())
                ->with('_form_type', 'edit')
                ->with('_edit_id', $banner->id);
        }
    }

    public function destroy(Banner $banner)
    {
        $this->deleteFile($banner->image);
        $banner->delete();

        $this->gameService->clearCache();
        
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');

    }

    private function uploadFile($file)
    {
        $targetDir = public_path('img');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }
        $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move($targetDir, $filename);
        return $filename;
    }

    private function deleteFile($filename)
    {
        if ($filename && File::exists(public_path('img/' . $filename))) {
            File::delete(public_path('img/' . $filename));
        }
    }
}