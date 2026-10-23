<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $menuItem = MenuItem::findOrFail($id);

        if ($menuItem->is_available === false) {
            return back()->with('error', 'This dish is currently unavailable.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + (int) $request->quantity;

            if ($newQuantity > 20) {
                return back()->with('error', 'Maximum quantity per dish is 20.');
            }

            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => (float) $menuItem->price,
                'quantity' => (int) $request->quantity,
                'image' => $menuItem->image,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', $menuItem->name . ' added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')
                ->with('error', 'Item not found in cart.');
        }

        $cart[$id]['quantity'] = (int) $request->quantity;

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart.');
    }
}
