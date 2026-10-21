<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Admin blog list
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    // Create blog form
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Save new blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_published' => ['required', 'boolean'],
        ]);

        $baseSlug = Str::slug($validated['title']) ?: 'blog';
        $slug = $baseSlug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    // Edit blog form
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Update existing blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_published' => ['required', 'boolean'],
        ]);

        $baseSlug = Str::slug($validated['title']) ?: 'blog';
        $slug = $baseSlug;
        $counter = 1;

        while (
            Blog::where('slug', $slug)
                ->where('id', '!=', $blog->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        } else {
            unset($validated['image']);
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
