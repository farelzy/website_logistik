<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author')->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'category'     => 'required|string|max:100',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        $validated['slug']         = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['user_id']      = auth()->id();
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'category'     => 'required|string|max:100',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        $validated['slug']         = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && !$blog->published_at) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
