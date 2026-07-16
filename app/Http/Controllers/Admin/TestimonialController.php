<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'latest');
        $rating = request('rating');

        $testimonials = Testimonial::query()
            ->search($search, ['name', 'message'])
            ->filterByStatus($status);

        if ($rating) {
            $testimonials = $testimonials->where('rating', $rating);
        }

        if ($sort === 'oldest') {
            $testimonials = $testimonials->oldest();
        } elseif ($sort === 'rating_asc') {
            $testimonials = $testimonials->orderBy('rating', 'asc');
        } elseif ($sort === 'rating_desc') {
            $testimonials = $testimonials->orderBy('rating', 'desc');
        } else {
            $testimonials = $testimonials->latest();
        }

        $testimonials = $testimonials->get();

        return view('admin.testimonials.index', compact('testimonials', 'search', 'status', 'sort', 'rating'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'));
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $this->deleteFile($testimonial->image);
            $data['image'] = $this->uploadFile($request->file('image'));
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteFile($testimonial->image);
        $testimonial->delete();
        
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    private function uploadFile($file)
    {
        $filename = time() . '_testimonial_' . \Illuminate\Support\Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);
        return $filename;
    }

    private function deleteFile($filename)
    {
        if ($filename && \Illuminate\Support\Facades\File::exists(public_path('img/' . $filename))) {
            \Illuminate\Support\Facades\File::delete(public_path('img/' . $filename));
        }
    }
}