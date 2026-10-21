<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RestaurantTableController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::latest()->paginate(10);

        return view('restaurant-tables.index', compact('tables'));
    }

    public function create()
    {
        return view('restaurant-tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|max:255|unique:restaurant_tables,table_number',
            'capacity' => 'required|integer|min:1|max:100',
            'status' => ['required', Rule::in(['available', 'occupied', 'reserved'])],
            'description' => 'nullable|string',
        ]);

        RestaurantTable::create($validated);

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant table added successfully.');
    }

    public function edit(RestaurantTable $restaurantTable)
    {
        return view('restaurant-tables.edit', compact('restaurantTable'));
    }

    public function update(Request $request, RestaurantTable $restaurantTable)
    {
        $validated = $request->validate([
            'table_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('restaurant_tables', 'table_number')
                    ->ignore($restaurantTable->id),
            ],
            'capacity' => 'required|integer|min:1|max:100',
            'status' => ['required', Rule::in(['available', 'occupied', 'reserved'])],
            'description' => 'nullable|string',
        ]);

        $restaurantTable->update($validated);

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant table updated successfully.');
    }

    public function destroy(RestaurantTable $restaurantTable)
    {
        $restaurantTable->delete();

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant table deleted successfully.');
    }
}
