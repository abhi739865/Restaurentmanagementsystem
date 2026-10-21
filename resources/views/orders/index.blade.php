
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
            <h2 style="font-size:22px;font-weight:700;color:#1f2937;">
                Orders Management
            </h2>

            <a href="{{ route('orders.create') }}"
               style="display:inline-block;background:#2563eb;color:white;padding:12px 20px;border-radius:8px;font-size:15px;font-weight:700;text-decoration:none;">
                + Create Order
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 16px;">
        <div style="max-width:1200px;margin:0 auto;">

            @if (session('success'))
                <div style="background:#dcfce7;color:#166534;padding:14px;border-radius:8px;margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:14px;border-radius:8px;margin-bottom:20px;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;overflow-x:auto;box-shadow:0 2px 6px rgba(0,0,0,0.06);">
                <table style="width:100%;border-collapse:collapse;text-align:left;min-width:950px;">
                    <thead>
                        <tr style="background:#f3f4f6;color:#374151;">
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Order No.</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Customer</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Table</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Total</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Status</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Payment</th>
                            <th style="padding:14px;border-bottom:1px solid #e5e7eb;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;">
                                    {{ $order->order_number }}
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;">
                                    {{ $order->customer_name ?? 'Walk-in Customer' }}
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;">
                                    {{ $order->restaurantTable?->table_number ?? '-' }}
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;white-space:nowrap;">
                                    ₹{{ number_format((float) $order->total_amount, 2) }}
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;">
                                    @php
                                        $statusColors = [
                                            'pending' => 'background:#fef3c7;color:#92400e;',
                                            'preparing' => 'background:#dbeafe;color:#1d4ed8;',
                                            'ready' => 'background:#ede9fe;color:#6d28d9;',
                                            'completed' => 'background:#dcfce7;color:#166534;',
                                            'cancelled' => 'background:#fee2e2;color:#991b1b;',
                                        ];
                                    @endphp

                                    <span style="display:inline-block;padding:5px 10px;border-radius:20px;font-size:12px;font-weight:700;{{ $statusColors[$order->status] ?? 'background:#f3f4f6;color:#374151;' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;">
                                    @php
                                        $paymentColors = [
                                            'unpaid' => 'background:#fee2e2;color:#991b1b;',
                                            'paid' => 'background:#dcfce7;color:#166534;',
                                            'refunded' => 'background:#f3f4f6;color:#374151;',
                                        ];
                                    @endphp

                                    <span style="display:inline-block;padding:5px 10px;border-radius:20px;font-size:12px;font-weight:700;{{ $paymentColors[$order->payment_status] ?? 'background:#f3f4f6;color:#374151;' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>

                                <td style="padding:14px;border-bottom:1px solid #e5e7eb;white-space:nowrap;">
                                    <a href="{{ route('orders.show', $order) }}"
                                       style="display:inline-block;background:#059669;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;margin-right:5px;">
                                        View
                                    </a>

                                    
<a href="{{ route('orders.invoice', $order) }}"
   style="display:inline-block;background:#7c3aed;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;margin-right:5px;">
    Invoice
</a>


                                    @if (Auth::user()->role === 'admin')
                                        <a href="{{ route('orders.edit', $order) }}"
                                           style="display:inline-block;background:#2563eb;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">
                                            Edit
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding:30px;text-align:center;color:#6b7280;">
                                    Abhi koi order nahi hai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top:20px;">
                {{ $orders->links() }}
            </div>

        </div>
        
    </div>
</x-app-layout>
