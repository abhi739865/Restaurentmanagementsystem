<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('restaurantTable')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menuItems = MenuItem::where('is_available', true)
            ->orderBy('name')
            ->get();

        $tables = RestaurantTable::where('status', 'available')
            ->orderBy('table_number')
            ->get();

        return view('orders.create', compact('menuItems', 'tables'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'order_type' => ['required', Rule::in(['dine_in', 'takeaway', 'delivery'])],
            'restaurant_table_id' => 'nullable|exists:restaurant_tables,id',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:100',
        ]);

        if (
            $validated['order_type'] !== 'dine_in'
            && !empty($validated['restaurant_table_id'])
        ) {
            return back()->withErrors([
                'restaurant_table_id' => 'Table sirf dine-in order ke liye select karein.',
            ])->withInput();
        }

        if ($validated['order_type'] === 'dine_in' && empty($validated['restaurant_table_id'])) {
            return back()->withErrors([
                'restaurant_table_id' => 'Dine-in order ke liye table select karna zaroori hai.',
            ])->withInput();
        }

        $order = DB::transaction(function () use ($validated) {
            $subtotal = 0;
            $itemsToSave = [];

            foreach ($validated['items'] as $item) {
                $menuItem = MenuItem::where('is_available', true)
                    ->findOrFail($item['menu_item_id']);

                $price = (float) $menuItem->price;
                $quantity = (int) $item['quantity'];
                $itemSubtotal = round($price * $quantity, 2);

                $subtotal += $itemSubtotal;

                $itemsToSave[] = [
                    'menu_item_id' => $menuItem->id,
                    'item_name' => $menuItem->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $tax = 0;
            $total = round($subtotal + $tax, 2);

            $order = Order::create([
                'restaurant_table_id' => $validated['order_type'] === 'dine_in'
                    ? $validated['restaurant_table_id']
                    : null,
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                'customer_name' => $validated['customer_name'] ?? null,
                'order_type' => $validated['order_type'],
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $total,
                'payment_status' => 'unpaid',
                'notes' => $validated['notes'] ?? null,
            ]);

            $order->items()->createMany($itemsToSave);

            if ($validated['order_type'] === 'dine_in') {
                RestaurantTable::where('id', $validated['restaurant_table_id'])
                    ->update(['status' => 'occupied']);
            }

            return $order;
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order successfully create ho gaya. Order: ' . $order->order_number);
    }

    public function show(Order $order)
    {
        $order->load(['items', 'restaurantTable']);

        return view('orders.show', compact('order'));
    }

    
public function invoice(Order $order)
{
    $order->load(['items', 'restaurantTable']);

    return view('orders.invoice', compact('order'));
}


    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'preparing', 'ready', 'completed', 'cancelled'])],
            'payment_status' => ['required', Rule::in(['unpaid', 'paid', 'refunded'])],
            'notes' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order successfully update ho gaya.');
    }

    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) {
            $tableId = $order->restaurant_table_id;

            $order->delete();

            if ($tableId) {
                $tableHasActiveOrder = Order::where('restaurant_table_id', $tableId)
                    ->whereIn('status', ['pending', 'preparing', 'ready'])
                    ->exists();

                if (!$tableHasActiveOrder) {
                    RestaurantTable::where('id', $tableId)
                        ->update(['status' => 'available']);
                }
            }
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order delete ho gaya.');
    }
}
