
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
            <div>
                <h2 style="font-size:24px;font-weight:800;color:#172238;">
                    Orders Management
                </h2>
                <p style="font-size:13px;color:#64748b;margin-top:5px;">
                    Manage orders, customer details and payments.
                </p>
            </div>

            <a href="{{ route('orders.create') }}"
               style="background:#2563eb;color:white;padding:11px 17px;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
                + Create Order
            </a>
        </div>
    </x-slot>

    <style>
        .orders-page {
            padding: 28px;
            background: #f4f6fb;
            min-height: 650px;
        }

        .orders-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .orders-panel {
            background: white;
            border: 1px solid #e8ecf3;
            border-radius: 13px;
            box-shadow: 0 3px 12px rgba(15,23,42,.03);
            overflow: hidden;
        }

        .orders-panel-heading {
            padding: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-bottom: 1px solid #eef2f7;
        }

        .orders-panel-title {
            color: #172238;
            font-size: 17px;
            font-weight: 800;
        }

        .orders-panel-subtitle {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 12px;
        }

        .orders-table-wrap {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            min-width: 1250px;
            border-collapse: collapse;
            text-align: left;
        }

        .orders-table th {
            padding: 15px 14px;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .orders-table td {
            padding: 15px 14px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .orders-table tbody tr:hover {
            background: #fafcff;
        }

        .order-number {
            color: #172238;
            font-weight: 800;
            white-space: nowrap;
        }

        .order-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .order-action {
            display: inline-block;
            padding: 8px 11px;
            margin: 2px;
            border-radius: 6px;
            color: white;
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .order-alert {
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: 9px;
            font-size: 13px;
        }

        .order-alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .order-alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .orders-pagination {
            padding: 18px 22px;
        }

        @media(max-width: 700px) {
            .orders-page {
                padding: 15px;
            }

            .orders-panel-heading {
                padding: 16px;
            }

            .orders-table th,
            .orders-table td {
                padding: 12px;
            }
        }
    </style>

    <div class="orders-page">
        <div class="orders-container">

            @if (session('success'))
                <div class="order-alert order-alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="order-alert order-alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="order-alert order-alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <section class="orders-panel">
                <div class="orders-panel-heading">
                    <div>
                        <h3 class="orders-panel-title">All Orders</h3>
                        <p class="orders-panel-subtitle">
                            Customer information, order status and payment details
                        </p>
                    </div>

                    <span style="background:#dbeafe;color:#1d4ed8;padding:7px 11px;border-radius:7px;font-size:12px;font-weight:800;">
                        {{ $orders->total() }} Orders
                    </span>
                </div>

                <div class="orders-table-wrap">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ORDER NUMBER</th>
                                <th>CUSTOMER</th>
                                <th>MOBILE</th>
                                <th style="min-width:220px;">DELIVERY ADDRESS</th>
                                <th>TABLE</th>
                                <th>TOTAL</th>
                                <th>STATUS</th>
                                <th>PAYMENT</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($orders as $order)
                                @php
                                    $statusColors = [
                                        'pending' => 'background:#fef3c7;color:#92400e;',
                                        'preparing' => 'background:#dbeafe;color:#1d4ed8;',
                                        'ready' => 'background:#ede9fe;color:#6d28d9;',
                                        'completed' => 'background:#dcfce7;color:#166534;',
                                        'cancelled' => 'background:#fee2e2;color:#991b1b;',
                                    ];

                                    $paymentColors = [
                                        'unpaid' => 'background:#fee2e2;color:#991b1b;',
                                        'paid' => 'background:#dcfce7;color:#166534;',
                                        'refunded' => 'background:#f1f5f9;color:#475569;',
                                    ];
                                @endphp

                                <tr>
                                    <td>
                                        <span class="order-number">
                                            {{ $order->order_number }}
                                        </span>
                                    </td>

                                    <td style="font-weight:600;">
                                        {{ $order->customer_name ?: 'Walk-in Customer' }}
                                    </td>

                                    <td style="white-space:nowrap;">
                                        @if ($order->phone)
                                            <a href="tel:{{ $order->phone }}"
                                               style="color:#2563eb;text-decoration:none;font-weight:600;">
                                                {{ $order->phone }}
                                            </a>
                                        @else
                                            <span style="color:#94a3b8;">Not provided</span>
                                        @endif
                                    </td>

                                    <td style="min-width:220px;max-width:300px;overflow-wrap:anywhere;">
                                        {{ $order->address ?: 'Address not provided' }}
                                    </td>

                                    <td>
                                        {{ $order->restaurantTable?->table_number ?? '-' }}
                                    </td>

                                    <td style="white-space:nowrap;font-weight:800;color:#172238;">
                                        ₹{{ number_format((float)$order->total_amount, 2) }}
                                    </td>

                                    <td>
                                        <span class="order-badge"
                                              style="{{ $statusColors[$order->status] ?? 'background:#f1f5f9;color:#475569;' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="order-badge"
                                              style="{{ $paymentColors[$order->payment_status] ?? 'background:#f1f5f9;color:#475569;' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>

                                    <td style="white-space:nowrap;">
                                        <a href="{{ route('orders.show', $order) }}"
                                           class="order-action"
                                           style="background:#059669;">
                                            View
                                        </a>

                                        <a href="{{ route('orders.invoice', $order) }}"
                                           class="order-action"
                                           style="background:#7c3aed;">
                                            Invoice
                                        </a>

                                        @if (Auth::user()->role === 'admin')
                                            <a href="{{ route('orders.edit', $order) }}"
                                               class="order-action"
                                               style="background:#2563eb;">
                                                Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="padding:40px;text-align:center;color:#94a3b8;">
                                        <div style="font-size:28px;margin-bottom:8px;">🛒</div>
                                        No orders found yet.
                                        <div style="margin-top:12px;">
                                            <a href="{{ route('orders.create') }}"
                                               style="color:#2563eb;font-weight:700;text-decoration:none;">
                                                Create your first order →
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="orders-pagination">
                    {{ $orders->links() }}
                </div>
            </section>

            <p style="text-align:center;color:#94a3b8;font-size:12px;margin-top:22px;">
                Restaurant Management System · Orders Workspace
            </p>
        </div>
    </div>
</x-app-layout>