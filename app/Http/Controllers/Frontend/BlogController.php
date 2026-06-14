<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('title', 'like', "%{$q}%")
                   ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        $posts      = $query->paginate(6);
        $categories = BlogPost::published()->reorder()->distinct()->pluck('category');

        return view('frontend.blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post   = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $post->incrementViews();
        $related = BlogPost::published()
                    ->where('category', $post->category)
                    ->where('id', '!=', $post->id)
                    ->take(3)->get();

        return view('frontend.blog.show', compact('post', 'related'));
    }
}
