<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),

            'total_revenue' => Order::where('payment_status', 'paid')
                ->sum('total_amount'),

            'today_sales' => Order::where('payment_status', 'paid')
                ->whereDate('created_at', today())
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

        // Last 6 months ki paid sales
        $monthlySales = [
            'labels' => [],
            'values' => [],
        ];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->startOfMonth()->subMonths($i);
            $nextMonth = $month->copy()->addMonth();

            $monthlySales['labels'][] = $month->format('M Y');

            $monthlySales['values'][] = (float) Order::where(
                'payment_status',
                'paid'
            )
                ->where('created_at', '>=', $month)
                ->where('created_at', '<', $nextMonth)
                ->sum('total_amount');
        }

        // Order status breakdown
        $statusLabels = [
            'Pending',
            'Preparing',
            'Ready',
            'Completed',
            'Cancelled',
        ];

        $statusValues = [
            Order::where('status', 'pending')->count(),
            Order::where('status', 'preparing')->count(),
            Order::where('status', 'ready')->count(),
            Order::where('status', 'completed')->count(),
            Order::where('status', 'cancelled')->count(),
        ];

        $recentOrders = Order::latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'monthlySales',
            'statusLabels',
            'statusValues',
            'recentOrders'
        ));
    }
}
