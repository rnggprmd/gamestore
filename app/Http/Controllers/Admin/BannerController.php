<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $this->deleteFile($banner->image);
        $banner->delete();
        
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }

    private function uploadFile($file)
    {
        $filename = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
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