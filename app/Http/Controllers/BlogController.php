<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)
            ->latest()
            ->paginate(9);

        return view('blogs.index', compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('blogs.show', compact('blog'));
    }
}