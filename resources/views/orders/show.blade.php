<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px;font-weight:bold;color:#1f2937;">
            Order Details
        </h2>
    </x-slot>

    <div style="max-width:1000px;margin:30px auto;padding:20px;">

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;gap:10px;flex-wrap:wrap;">
            <h3 style="font-size:24px;font-weight:bold;">
                {{ $order->order_number }}
            </h3>

            <a href="{{ route('orders.index') }}"
               style="background:#4b5563;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
                Back to Orders
            </a>
        </div>

        @if (session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px;margin-bottom:16px;border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:white;padding:22px;border:1px solid #e5e7eb;border-radius:10px;margin-bottom:22px;">
            <h3 style="font-size:19px;font-weight:bold;margin-bottom:15px;">
                Order Information
            </h3>

            <p style="margin-bottom:10px;">
                <strong>Customer:</strong>
                {{ $order->customer_name ?: 'Walk-in Customer' }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Order Type:</strong>
                {{ ucwords(str_replace('_', ' ', $order->order_type)) }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Table:</strong>
                {{ $order->restaurantTable?->table_number ?? 'N/A' }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Order Status:</strong>
                {{ ucfirst($order->status) }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Payment Status:</strong>
                {{ ucfirst($order->payment_status) }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Order Date:</strong>
                {{ $order->created_at?->format('d M Y, h:i A') }}
            </p>

            <p>
                <strong>Notes:</strong>
                {{ $order->notes ?: 'No notes' }}
            </p>
        </div>

        <div style="background:white;padding:22px;border:1px solid #e5e7eb;border-radius:10px;margin-bottom:22px;">
            <h3 style="font-size:19px;font-weight:bold;margin-bottom:15px;">
                Ordered Items
            </h3>

            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f3f4f6;">
                            <th style="padding:12px;text-align:left;">Item</th>
                            <th style="padding:12px;text-align:right;">Price</th>
                            <th style="padding:12px;text-align:center;">Quantity</th>
                            <th style="padding:12px;text-align:right;">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($order->items as $item)
                            <tr>
                                <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                                    {{ $item->item_name }}
                                </td>

                                <td style="padding:12px;text-align:right;border-bottom:1px solid #e5e7eb;">
                                    ₹{{ number_format((float) $item->price, 2) }}
                                </td>

                                <td style="padding:12px;text-align:center;border-bottom:1px solid #e5e7eb;">
                                    {{ $item->quantity }}
                                </td>

                                <td style="padding:12px;text-align:right;border-bottom:1px solid #e5e7eb;">
                                    ₹{{ number_format((float) $item->subtotal, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding:16px;text-align:center;">
                                    No items found for this order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="max-width:320px;margin:20px 0 0 auto;">
                <p style="display:flex;justify-content:space-between;margin-bottom:10px;">
                    <strong>Subtotal:</strong>
                    <span>₹{{ number_format((float) $order->subtotal, 2) }}</span>
                </p>

                <p style="display:flex;justify-content:space-between;margin-bottom:10px;">
                    <strong>Tax:</strong>
                    <span>₹{{ number_format((float) $order->tax, 2) }}</span>
                </p>

                <hr style="margin:12px 0;">

                <p style="display:flex;justify-content:space-between;font-size:20px;font-weight:bold;">
                    <span>Total:</span>
                    <span>₹{{ number_format((float) $order->total_amount, 2) }}</span>
                </p>
            </div>
        </div>

       
<div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;margin-top:20px;">
    <a href="{{ route('orders.invoice', $order) }}"
       style="display:inline-block;background:#059669;color:white;padding:12px 18px;border-radius:6px;text-decoration:none;font-weight:700;">
        View Invoice
    </a>

    @if (Auth::user()->role === 'admin')
        <a href="{{ route('orders.edit', $order) }}"
           style="display:inline-block;background:#2563eb;color:white;padding:12px 18px;border-radius:6px;text-decoration:none;font-weight:700;">
            Update Order Status
        </a>
    @endif
</div>


    </div>
</x-app-layout>
