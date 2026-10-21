<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = InventoryItem::latest()->paginate(10);

        $totalItems = InventoryItem::count();

        $lowStockItems = InventoryItem::whereColumn(
            'quantity',
            '<=',
            'minimum_stock'
        )->count();

        $totalStockValue = InventoryItem::selectRaw(
            'COALESCE(SUM(quantity * cost_per_unit), 0) as total'
        )->value('total');

        return view('inventory-items.index', compact(
            'items',
            'totalItems',
            'lowStockItems',
            'totalStockValue'
        ));
    }

    public function create()
    {
        return view('inventory-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:30',
            'quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        InventoryItem::create($validated);

        return redirect()
            ->route('inventory-items.index')
            ->with('success', 'Inventory item added successfully.');
    }

    public function show(InventoryItem $inventoryItem)
    {
        return redirect()->route('inventory-items.edit', $inventoryItem);
    }

    public function edit(InventoryItem $inventoryItem)
    {
        return view('inventory-items.edit', compact('inventoryItem'));
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:30',
            'quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $inventoryItem->update($validated);

        return redirect()
            ->route('inventory-items.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();

        return redirect()
            ->route('inventory-items.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}
