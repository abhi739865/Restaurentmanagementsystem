
<x-app-layout>
    <x-slot name="header">
        <div class="staff-header">
            <div>
                <h2>Staff Dashboard</h2>
                <p>Manage your restaurant operations</p>
            </div>
        </div>
    </x-slot>

    <style>
        .staff-dashboard {
            padding: 24px;
            background: #f8fafc;
            min-height: 100%;
            color: #172238;
        }

        .staff-dashboard * {
            box-sizing: border-box;
        }

        .staff-header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: #172238;
        }

        .staff-header p {
            margin-top: 5px;
            color: #64748b;
            font-size: 13px;
        }

        .staff-welcome {
            padding: 28px;
            margin-bottom: 24px;
            border-radius: 16px;
            color: white;
            background: linear-gradient(120deg, #1e3a8a, #2563eb);
        }

        .staff-welcome h1 {
            margin: 0 0 8px;
            font-size: 26px;
            font-weight: 800;
        }

        .staff-welcome p {
            margin: 0;
            color: #dbeafe;
            font-size: 14px;
        }

        .staff-stats-grid,
        .staff-actions-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .staff-card {
            min-width: 0;
            background: #fff;
            border: 1px solid #e8edf4;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, .04);
        }

        .staff-stat-card {
            padding: 22px;
        }

        .staff-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .staff-stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
        }

        .staff-stat-number {
            margin-top: 12px;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 800;
            color: #172238;
            overflow-wrap: anywhere;
        }

        .staff-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            font-size: 22px;
            flex-shrink: 0;
        }

        .staff-section-title {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: #172238;
        }

        .staff-action-card {
            padding: 23px;
        }

        .staff-action-card h3 {
            margin: 16px 0 7px;
            font-size: 17px;
            font-weight: 800;
            color: #172238;
        }

        .staff-action-card p {
            margin: 0 0 18px;
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
        }

        .staff-action-link {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 15px;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            transition: background .2s ease;
        }

        .staff-action-link:hover {
            filter: brightness(.92);
            color: #fff;
        }

        .staff-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .staff-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .staff-table th {
            padding: 15px 18px;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .staff-table td {
            padding: 16px 18px;
            border-top: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            white-space: nowrap;
        }

        .staff-table tbody tr:hover {
            background: #fafcff;
        }

        .staff-status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
        }

        .staff-view-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
        }

        .staff-view-link:hover {
            text-decoration: underline;
        }

        .staff-footer {
            padding: 24px 0 4px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 1000px) {
            .staff-stats-grid,
            .staff-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .staff-dashboard {
                padding: 14px;
            }

            .staff-welcome {
                padding: 22px;
            }

            .staff-welcome h1 {
                font-size: 22px;
            }

            .staff-stats-grid,
            .staff-actions-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .staff-stat-card,
            .staff-action-card {
                padding: 18px;
            }
        }
    </style>

    <div class="staff-dashboard">

        {{-- WELCOME --}}
        <section class="staff-welcome">
            <h1>Welcome to your Dashboard!</h1>
            <p>Monitor orders and manage your restaurant from one place.</p>
        </section>

        {{-- STATISTICS --}}
        <div class="staff-stats-grid">

            <div class="staff-card staff-stat-card">
                <div class="staff-stat-top">
                    <span class="staff-stat-label">Total Orders</span>
                    <div class="staff-stat-icon"
                         style="background:#dbeafe;color:#1d4ed8;">📋</div>
                </div>
                <div class="staff-stat-number">
                    {{ \App\Models\Order::count() }}
                </div>
            </div>

            <div class="staff-card staff-stat-card">
                <div class="staff-stat-top">
                    <span class="staff-stat-label">Pending Orders</span>
                    <div class="staff-stat-icon"
                         style="background:#fef3c7;color:#b45309;">⏳</div>
                </div>
                <div class="staff-stat-number">
                    {{ \App\Models\Order::where('status', 'pending')->count() }}
                </div>
            </div>

            <div class="staff-card staff-stat-card">
                <div class="staff-stat-top">
                    <span class="staff-stat-label">Menu Items</span>
                    <div class="staff-stat-icon"
                         style="background:#dcfce7;color:#15803d;">🍽️</div>
                </div>
                <div class="staff-stat-number">
                    {{ \App\Models\MenuItem::count() }}
                </div>
            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <h3 class="staff-section-title" style="margin-bottom:16px;">
            Quick Actions
        </h3>

        <div class="staff-actions-grid">

            <div class="staff-card staff-action-card">
                <div class="staff-stat-icon"
                     style="background:#dbeafe;color:#1d4ed8;">📋</div>
                <h3>Orders</h3>
                <p>View and manage restaurant orders.</p>
                <a href="{{ route('orders.index') }}"
                   class="staff-action-link">
                    Manage Orders →
                </a>
            </div>

            <div class="staff-card staff-action-card">
                <div class="staff-stat-icon"
                     style="background:#dcfce7;color:#15803d;">🍔</div>
                <h3>Menu Items</h3>
                <p>View restaurant menu items.</p>
                <a href="{{ route('menu-items.index') }}"
                   class="staff-action-link">
                    Manage Menu →
                </a>
            </div>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="staff-card staff-action-card">
                    <div class="staff-stat-icon"
                         style="background:#ede9fe;color:#7c3aed;">🗂️</div>
                    <h3>Categories</h3>
                    <p>Organize menu categories.</p>
                    <a href="{{ route('categories.index') }}"
                       class="staff-action-link"
                       style="background:#7c3aed;">
                        Manage Categories →
                    </a>
                </div>

                <div class="staff-card staff-action-card">
                    <div class="staff-stat-icon"
                         style="background:#fef3c7;color:#b45309;">🪑</div>
                    <h3>Restaurant Tables</h3>
                    <p>Access your restaurant's tables.</p>
                    <a href="{{ route('restaurant-tables.index') }}"
                       class="staff-action-link"
                       style="background:#b45309;">
                        Manage Tables →
                    </a>
                </div>
            @endif

        </div>

        {{-- RECENT ORDERS --}}
        <section class="staff-card" style="padding:0;overflow:hidden;">
            <div style="padding:22px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
                <div>
                    <h3 class="staff-section-title">Recent Orders</h3>
                    <p style="font-size:12px;color:#94a3b8;margin-top:5px;">
                        Latest restaurant orders
                    </p>
                </div>

                <a href="{{ route('orders.index') }}"
                   class="staff-action-link"
                   style="margin-top:0;">
                    View All Orders →
                </a>
            </div>

            <div class="staff-table-wrap">
                <table class="staff-table">
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
                        @forelse(\App\Models\Order::latest()->take(5)->get() as $order)
                            <tr>
                                <td style="font-weight:700;">
                                    {{ $order->order_number }}
                                </td>

                                <td>
                                    {{ $order->customer_name ?: 'Walk-in Customer' }}
                                </td>

                                <td>
                                    {{ $order->created_at?->format('d M Y') ?? '—' }}
                                </td>

                                <td style="font-weight:700;">
                                    ₹{{ number_format((float) $order->total_amount, 2) }}
                                </td>

                                <td>
                                    <span class="staff-status">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('orders.show', $order) }}"
                                       class="staff-view-link">
                                        View →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    style="text-align:center;padding:30px;color:#94a3b8;">
                                    No orders found yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <p class="staff-footer">
            Restaurant Management System · Staff Workspace
        </p>

    </div>
</x-app-layout>