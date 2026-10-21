<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MenuItem;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::latest()->take(6)->get();

        $blogs = Blog::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('menuItems', 'blogs'));
    }

    public function menu()
    {
        $menuItems = MenuItem::with('category')->latest()->get();

        $categories = Category::all();

        return view('our-menu', compact('menuItems', 'categories'));
    }
}
