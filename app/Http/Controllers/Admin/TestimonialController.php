<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


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
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
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

            Cache::forget('active_testimonials');

            return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.testimonials.index')
                ->withErrors($e->errors())
                ->withInput($request->all())
                ->with('_form_type', 'create');
        }
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
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

            Cache::forget('active_testimonials');

            return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.testimonials.index')
                ->withErrors($e->errors())
                ->withInput($request->all())
                ->with('_form_type', 'edit')
                ->with('_edit_id', $testimonial->id);
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteFile($testimonial->image);
        $testimonial->delete();

        Cache::forget('active_testimonials');
        
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