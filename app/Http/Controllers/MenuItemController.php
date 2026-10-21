<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')
            ->latest()
            ->paginate(10);

        return view('menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_available' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('menu-items', 'public');
        }

        MenuItem::create($validated);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item added successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('menu-items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_available' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }

            $validated['image'] = $request->file('image')
                ->store('menu-items', 'public');
        }

        $menuItem->update($validated);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
