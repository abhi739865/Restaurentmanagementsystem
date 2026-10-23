
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .success {
            text-align: center;
            border-top: 5px solid #16a34a;
        }

        .check {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50%;
            font-size: 35px;
        }

        h1 {
            margin: 10px 0;
            font-size: 28px;
        }

        h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .muted {
            color: #6b7280;
            line-height: 1.6;
        }

        .order-number {
            display: inline-block;
            padding: 10px 16px;
            margin-top: 10px;
            background: #f3f4f6;
            border-radius: 8px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 600;
        }

        .item-details {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }

        .price {
            font-weight: 600;
            white-space: nowrap;
        }

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .detail-value {
            font-weight: 600;
            overflow-wrap: anywhere;
            line-height: 1.5;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding-top: 20px;
            margin-top: 10px;
            border-top: 2px solid #e5e7eb;
            font-size: 20px;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 13px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 13px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
        }

        .btn-primary {
            background: #16a34a;
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #1f2937;
        }

        @media (max-width: 600px) {
            .container {
                margin: 15px auto;
                padding: 12px;
            }

            .card {
                padding: 20px;
            }

            h1 {
                font-size: 23px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .item {
                align-items: flex-start;
            }
        }

        .btn-track {
    background: #2563eb;
    color: white;
}

.btn-track:hover {
    background: #1d4ed8;
    color: white;
}
    </style>
</head>

<body>
    <div class="container">

        <div class="card success">
            <div class="check">&#10003;</div>

            <h1>Order Placed Successfully!</h1>

            <p class="muted">
                Thank you for your order. Your order has been received.
            </p>

            <div class="order-number">
                Order No: {{ $order->order_number }}
            </div>

            <p class="muted">
                Please keep your order number for future reference.
            </p>
        </div>

        <div class="card">
            <h2>Order Summary</h2>

            @foreach ($order->items as $item)
                <div class="item">
                    <div>
                        <div class="item-name">
                            {{ $item->item_name }}
                        </div>

                        <div class="item-details">
                            ₹{{ number_format((float) $item->price, 2) }}
                            × {{ $item->quantity }}
                        </div>
                    </div>

                    <div class="price">
                        ₹{{ number_format((float) $item->subtotal, 2) }}
                    </div>
                </div>
            @endforeach

            <div class="total-row">
                <span>Total Amount</span>
                <span>
                    ₹{{ number_format((float) $order->total_amount, 2) }}
                </span>
            </div>

            <p style="margin-bottom: 0;">
                <strong>Payment Status:</strong>
                <span class="badge">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>

            <p>
                <strong>Order Status:</strong>
                {{ ucfirst($order->status) }}
            </p>
        </div>

        <div class="card">
            <h2>Delivery Details</h2>

            <div class="details">
                <div>
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">
                        {{ $order->customer_name ?? 'Not provided' }}
                    </div>
                </div>

                <div>
                    <div class="detail-label">Mobile Number</div>
                    <div class="detail-value">
                        {{ $order->phone ?? 'Not provided' }}
                    </div>
                </div>

                <div style="grid-column: 1 / -1;">
                    <div class="detail-label">Delivery Address</div>
                    <div class="detail-value">
                        {{ $order->address ?? 'Not provided' }}
                    </div>
                </div>

                @if ($order->notes)
                    <div style="grid-column: 1 / -1;">
                        <div class="detail-label">Additional Notes</div>
                        <div class="detail-value">
                            {{ $order->notes }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

       <div class="buttons">
            <a href="{{ route('order-tracking.search', ['order_number' => $order->order_number]) }}"
            class="btn btn-track">
                Track Order
            </a>

            <a href="{{ url('/our-menu') }}" class="btn btn-primary">
                Order More Food
            </a>

            <a href="{{ url('/') }}" class="btn btn-secondary">
                Back to Home
            </a>
        </div>

    </div>
</body>
</html>
