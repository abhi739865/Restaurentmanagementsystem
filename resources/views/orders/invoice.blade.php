
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 30px 15px;
        }

        .invoice {
            max-width: 850px;
            margin: auto;
            padding: 35px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .top, .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .top {
            padding-bottom: 22px;
            border-bottom: 2px solid #2563eb;
            margin-bottom: 25px;
        }

        h1 { margin: 0 0 8px; color: #1d4ed8; }
        h2 { margin-top: 0; }
        p { margin: 7px 0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 13px 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th { background: #f3f4f6; }
        .right { text-align: right; }

        .totals {
            max-width: 330px;
            margin: 25px 0 0 auto;
        }

        .row { padding: 8px 0; }
        .grand-total {
            border-top: 2px solid #1f2937;
            margin-top: 8px;
            padding-top: 15px;
            font-size: 21px;
            font-weight: bold;
        }

        .actions {
            max-width: 850px;
            margin: 20px auto 0;
            display: flex;
            gap: 12px;
        }

        .btn {
            border: 0;
            border-radius: 6px;
            padding: 12px 18px;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }

        .print { background: #2563eb; color: white; }
        .back { background: #e5e7eb; color: #1f2937; }

        @media print {
            body { background: white; padding: 0; }
            .invoice { border: 0; border-radius: 0; padding: 10px; }
            .actions { display: none; }
            @page { margin: 12mm; }
        }

        @media (max-width: 600px) {
            .invoice { padding: 18px; }
            .top { flex-direction: column; }
            th, td { padding: 9px 6px; font-size: 13px; }
        }
    </style>
</head>
<body>

    <div class="invoice">
        <div class="top">
            <div>
                <h1>Restaurant Manager</h1>
                <p>Restaurant Invoice</p>
                <p>Thank you for your order!</p>
            </div>

            <div>
                <h2>INVOICE</h2>
                <p><strong>Order No:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at?->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <h3>Order Details</h3>
        <p><strong>Customer:</strong> {{ $order->customer_name ?: 'Walk-in Customer' }}</p>
        <p><strong>Order Type:</strong> {{ ucwords(str_replace('_', ' ', $order->order_type)) }}</p>
        <p><strong>Table:</strong> {{ $order->restaurantTable?->table_number ?? 'N/A' }}</p>
        <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>

        <table>
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th class="right">Price</th>
                    <th class="right">Qty</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td class="right">₹{{ number_format((float) $item->price, 2) }}</td>
                        <td class="right">{{ $item->quantity }}</td>
                        <td class="right">₹{{ number_format((float) $item->subtotal, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals">
            <div class="row">
                <span>Subtotal</span>
                <span>₹{{ number_format((float) $order->subtotal, 2) }}</span>
            </div>
            <div class="row">
                <span>Tax</span>
                <span>₹{{ number_format((float) $order->tax, 2) }}</span>
            </div>
            <div class="row grand-total">
                <span>Total</span>
                <span>₹{{ number_format((float) $order->total_amount, 2) }}</span>
            </div>
        </div>

        @if ($order->notes)
            <div style="margin-top:25px;">
                <strong>Notes:</strong>
                <p>{{ $order->notes }}</p>
            </div>
        @endif

        <p style="text-align:center;margin-top:35px;color:#6b7280;">
            Thank you for dining with us!
        </p>
    </div>

    <div class="actions">
        <button class="btn print" onclick="window.print()">Print / Save as PDF</button>
        <a class="btn back" href="{{ route('orders.show', $order) }}">Back to Order</a>
    </div>

</body>
</html>
