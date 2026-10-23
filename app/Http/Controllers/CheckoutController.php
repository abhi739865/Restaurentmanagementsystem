<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:2000',
            'notes' => 'nullable|string|max:2000',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) $item['quantity'];
        });

        $order = DB::transaction(function () use (
            $validated,
            $cart,
            $total
        ) {
            $order = Order::create([
                'order_number' => 'ORD-' . Str::upper(Str::random(10)),
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'order_type' => 'delivery',
                'status' => 'pending',
                'subtotal' => $total,
                'tax' => 0,
                'total_amount' => $total,
                'payment_status' => 'unpaid',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($cart as $cartKey => $item) {
                $order->items()->create([
                    'menu_item_id' => $item['id'] ?? (
                        is_numeric($cartKey) ? $cartKey : null
                    ),
                    'item_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.confirmation', [
            'orderNumber' => $order->order_number,
        ]);
    }

    public function confirmation(string $orderNumber)
{
    $order = Order::with('items')
        ->where('order_number', $orderNumber)
        ->firstOrFail();

    return view('checkout.confirmation', compact('order'));
}
}