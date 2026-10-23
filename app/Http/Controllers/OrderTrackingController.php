<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index(Request $request)
    {
        $order = null;
        $error = null;

        $orderNumber = trim($request->input('order_number', ''));

        if ($orderNumber !== '') {
            $order = Order::with('items')
                ->where('order_number', $orderNumber)
                ->first();

            if (!$order) {
                $error = 'Order not found. Please check your order number.';
            }
        }

        return view('track-order', compact('order', 'error', 'orderNumber'));
    }
}
