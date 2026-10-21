<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Admin ko admin dashboard par bhejo
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Normal user / staff ke dashboard ke stats
        $stats = [
            'total_orders' => Order::count(),

            'total_sales' => Order::where('payment_status', 'paid')
                ->sum('total_amount'),

            'pending_orders' => Order::where('status', 'pending')
                ->count(),

            'completed_orders' => Order::where('status', 'completed')
                ->count(),

            'paid_orders' => Order::where('payment_status', 'paid')
                ->count(),

            'unpaid_orders' => Order::where('payment_status', 'unpaid')
                ->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
