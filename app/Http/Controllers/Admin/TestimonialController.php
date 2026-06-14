<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'company'   => 'nullable|string|max:150',
            'position'  => 'nullable|string|max:100',
            'content'   => 'required|string|max:1000',
            'rating'    => 'required|integer|min:1|max:5',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'company'   => 'nullable|string|max:150',
            'position'  => 'nullable|string|max:100',
            'content'   => 'required|string|max:1000',
            'rating'    => 'required|integer|min:1|max:5',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
