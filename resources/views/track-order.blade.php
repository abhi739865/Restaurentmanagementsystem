
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #222;
        }

        .container {
            max-width: 760px;
            margin: 50px auto;
            padding: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 18px #0000000d;
            margin-bottom: 20px;
        }

        h1, h2 { margin-top: 0; }

        .search-form {
            display: flex;
            gap: 10px;
        }

        input {
            flex: 1;
            min-width: 0;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        button, .home-btn {
            display: inline-block;
            background: #b45309;
            color: white;
            border: 0;
            padding: 13px 18px;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
        }

        .error {
            color: #b91c1c;
            margin-top: 15px;
        }

        .details p { margin: 12px 0; }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: #fef3c7;
            color: #92400e;
            text-transform: capitalize;
            font-weight: bold;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items th, .items td {
            text-align: left;
            padding: 12px 6px;
            border-bottom: 1px solid #eee;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        @media (max-width: 520px) {
            .container { margin: 15px auto; padding: 12px; }
            .card { padding: 20px; }
            .search-form { flex-direction: column; }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="card">
        <h1>Track Your Order</h1>
        <p>Enter your order number to check your order status.</p>

        <form action="{{ route('order-tracking.search') }}"
              method="GET" class="search-form">

            <input
                type="text"
                name="order_number"
                placeholder="e.g. ORD-XLF4ATHXWF"
                value="{{ $orderNumber }}"
                required
            >

            <button type="submit">Track Order</button>
        </form>

        @if($error)
            <p class="error">{{ $error }}</p>
        @endif
    </div>

    @if($order)
        <div class="card">
            <h2>Order Details</h2>

            <div class="details">
                <p>
                    <strong>Order Number:</strong>
                    {{ $order->order_number }}
                </p>

                <p>
                    <strong>Customer:</strong>
                    {{ $order->customer_name ?? 'N/A' }}
                </p>

                        
            <div class="order-progress">
                @php
                    $steps = [
                        'pending' => 'Order Received',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'completed' => 'Completed',
                    ];

                    $stepOrder = array_keys($steps);
                    $currentStatus = $order->status;
                    $currentIndex = array_search($currentStatus, $stepOrder);
                @endphp

                <h3>Order Progress</h3>

                @if($currentStatus === 'cancelled')
                    <p class="status" style="background:#fee2e2;color:#991b1b;">
                        Order Cancelled
                    </p>
                @elseif($currentIndex !== false)
                    <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:18px;">
                        @foreach($steps as $key => $label)
                            <div style="flex:1;min-width:100px;padding:14px 8px;text-align:center;border-radius:8px;background:{{ array_search($key, $stepOrder) <= $currentIndex ? '#dcfce7' : '#f3f4f6' }};color:{{ array_search($key, $stepOrder) <= $currentIndex ? '#166534' : '#6b7280' }};">
                                <div style="font-size:22px;">
                                    {{ array_search($key, $stepOrder) <= $currentIndex ? '✓' : '○' }}
                                </div>
                                <strong>{{ $label }}</strong>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="status">
                        {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
                    </p>
                @endif
            </div>


                <p>
                    <strong>Payment:</strong>
                    {{ ucfirst($order->payment_status ?? 'unpaid') }}
                </p>
            </div>

            <h2>Items Ordered</h2>

            <table class="items">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                ₹{{ number_format((float) $item->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="total">
                Total: ₹{{ number_format((float) $order->total_amount, 2) }}
            </p>

            @if($order->address)
                <p>
                    <strong>Delivery Address:</strong>
                    {{ $order->address }}
                </p>
            @endif

            <p>
                <a href="{{ url('/') }}" class="home-btn">
                    Back to Home
                </a>
            </p>
        </div>
    @endif

</div>
</body>
</html>
