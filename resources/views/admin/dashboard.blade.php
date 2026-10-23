
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
            <h2 style="font-size:24px;font-weight:800;color:#111827;">
                Admin Dashboard
            </h2>
            <span style="font-size:13px;color:#64748b;">
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </x-slot>

    <style>
        .admin-card {
            background: white;
            padding: 22px;
            border: 1px solid #e8ecf3;
            border-radius: 13px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
        }

        .admin-stat-label {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .admin-stat-value {
            color: #172238;
            font-size: 27px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .admin-stat-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .admin-section-title {
            font-size: 17px;
            font-weight: 800;
            color: #172238;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .admin-table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-align: left;
            padding: 14px;
        }

        .admin-table td {
            padding: 15px 14px;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            color: #334155;
        }

        .admin-table-wrap {
            overflow-x: auto;
        }

        .admin-status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #f1f5f9;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .admin-action {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }
    </style>

    <div style="background:#f4f6fb;padding:28px;min-height:calc(100vh - 80px);">

            <div style="margin-bottom:25px;">
                <h1 style="font-size:25px;font-weight:800;color:#172238;">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>

                <p style="color:#64748b;font-size:14px;margin-top:6px;">
                    Here is what's happening in your restaurant.
                </p>
            </div>

            {{-- ANALYTICS CARDS --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:17px;margin-bottom:22px;">

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#dbeafe;color:#1d4ed8;">🛒</div>
                    <p class="admin-stat-label">Total Orders</p>
                    <div class="admin-stat-value">{{ $stats['total_orders'] }}</div>
                </div>

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#dcfce7;color:#15803d;">₹</div>
                    <p class="admin-stat-label">Total Paid Revenue</p>
                    <div class="admin-stat-value" style="font-size:23px;">
                        ₹{{ number_format((float)$stats['total_revenue'], 2) }}
                    </div>
                </div>

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#fef3c7;color:#b45309;">◷</div>
                    <p class="admin-stat-label">Today's Paid Sales</p>
                    <div class="admin-stat-value" style="font-size:23px;">
                        ₹{{ number_format((float)$stats['today_sales'], 2) }}
                    </div>
                </div>

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#ffedd5;color:#c2410c;">!</div>
                    <p class="admin-stat-label">Pending Orders</p>
                    <div class="admin-stat-value">{{ $stats['pending_orders'] }}</div>
                </div>

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#d1fae5;color:#047857;">✓</div>
                    <p class="admin-stat-label">Completed Orders</p>
                    <div class="admin-stat-value">{{ $stats['completed_orders'] }}</div>
                </div>

                <div class="admin-card">
                    <div class="admin-stat-icon" style="background:#ede9fe;color:#6d28d9;">₹</div>
                    <p class="admin-stat-label">Paid Orders</p>
                    <div class="admin-stat-value">{{ $stats['paid_orders'] }}</div>
                </div>
            </div>

            {{-- CHARTS --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,320px),1fr));gap:20px;margin-bottom:22px;">

                <section class="admin-card">
                    <div style="display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap;margin-bottom:20px;">
                        <div>
                            <h3 class="admin-section-title">Sales Analytics</h3>
                            <p style="color:#94a3b8;font-size:12px;margin-top:5px;">
                                Paid revenue · Last 6 months
                            </p>
                        </div>
                        <span style="background:#dcfce7;color:#166534;padding:6px 10px;border-radius:7px;font-size:12px;">
                            Monthly
                        </span>
                    </div>

                    <div style="height:280px;position:relative;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </section>

                <section class="admin-card">
                    <h3 class="admin-section-title">Order Status Analysis</h3>
                    <p style="color:#94a3b8;font-size:12px;margin-top:5px;margin-bottom:15px;">
                        Orders by current status
                    </p>

                    <div style="height:245px;position:relative;">
                        <canvas id="statusChart"></canvas>
                    </div>

                    <div style="text-align:center;color:#64748b;font-size:12px;margin-top:10px;">
                        Total orders: {{ $stats['total_orders'] }}
                    </div>
                </section>
            </div>

            {{-- RECENT ORDERS --}}
            <section class="admin-card" style="padding:0;overflow:hidden;">
                <div style="padding:22px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
                    <div>
                        <h3 class="admin-section-title">Recent Orders</h3>
                        <p style="font-size:12px;color:#94a3b8;margin-top:5px;">
                            Latest 8 restaurant orders
                        </p>
                    </div>

                    <a href="{{ route('orders.index') }}"
                       style="background:#172238;color:white;padding:10px 14px;border-radius:7px;text-decoration:none;font-size:12px;font-weight:700;">
                        View All Orders →
                    </a>
                </div>

                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ORDER NUMBER</th>
                                <th>CUSTOMER</th>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td style="font-weight:700;">
                                        {{ $order->order_number }}
                                    </td>

                                    <td>
                                        {{ $order->customer_name ?: 'Walk-in Customer' }}
                                    </td>

                                    <td>
                                        {{ $order->created_at?->format('d M Y') }}
                                    </td>

                                    <td style="font-weight:700;">
                                        ₹{{ number_format((float)$order->total_amount, 2) }}
                                    </td>

                                    <td>
                                        <span class="admin-status">
                                            {{ str_replace('_', ' ', $order->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="admin-action"
                                           href="{{ route('orders.show', $order) }}">
                                            View →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center;padding:30px;color:#94a3b8;">
                                        No orders found yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <p style="text-align:center;font-size:12px;color:#94a3b8;margin-top:25px;">
                Restaurant Management System · Admin Analytics
            </p>
    </div>

    {{-- Charts library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const salesCanvas = document.getElementById('salesChart');
        const statusCanvas = document.getElementById('statusChart');

        const salesLabels = @json($monthlySales['labels']);
        const salesValues = @json($monthlySales['values']);

        const statusLabels = @json($statusLabels);
        const statusValues = @json($statusValues);

        if (salesCanvas && window.Chart) {
            new Chart(salesCanvas, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Paid Revenue (₹)',
                        data: salesValues,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.12)',
                        fill: true,
                        tension: 0.38,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '₹' + Number(context.raw).toLocaleString('en-IN', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#eef2f7'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '₹' + Number(value).toLocaleString('en-IN');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        if (statusCanvas && window.Chart) {
            new Chart(statusCanvas, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusValues,
                        backgroundColor: [
                            '#f59e0b',
                            '#3b82f6',
                            '#8b5cf6',
                            '#10b981',
                            '#ef4444'
                        ],
                        borderWidth: 0,
                        hoverOffset: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '66%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 16
                            }
                        }
                    }
                }
            });
        }
    </script>
</x-app-layout>
