
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Our Restaurant</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #30231c;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .panel {
            background: white;
            border: 1px solid #f0e4da;
            border-radius: 12px;
            padding: 25px;
            margin: 20px 0;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font: inherit;
        }

        button {
            background: #a74720;
            color: white;
            padding: 13px 20px;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        a { color: #a74720; }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .error {
            color: #a32020;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Checkout</h1>
    <a href="{{ route('cart.index') }}">← Back to My Cart</a>

    <div class="panel">
        <h2>Order Summary</h2>

        @foreach($cart as $item)
            <div class="item">
                <span>
                    {{ $item['name'] }} × {{ $item['quantity'] }}
                </span>

                <strong>
                    ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                </strong>
            </div>
        @endforeach

        <h2>Total: ₹{{ number_format($total, 2) }}</h2>
    </div>

    <div class="panel">
        <h2>Customer Details</h2>

       <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

            <label for="customer_name">Full Name</label>
            <input
                id="customer_name"
                type="text"
                name="customer_name"
                value="{{ old('customer_name') }}"
                maxlength="255"
                required
            >
            @error('customer_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="phone">Mobile Number</label>
            <input
                id="phone"
                type="tel"
                name="phone"
                value="{{ old('phone') }}"
                maxlength="20"
                required
            >
            @error('phone')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="address">Delivery Address</label>
            <textarea
                id="address"
                name="address"
                rows="4"
                maxlength="2000"
                required
            >{{ old('address') }}</textarea>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="notes">Order Notes (Optional)</label>
            <textarea
                id="notes"
                name="notes"
                rows="2"
                maxlength="1000"
            >{{ old('notes') }}</textarea>

            <p><strong>Payment Method:</strong> Cash on Delivery (COD)</p>

           <button type="submit" class="place-order-btn">
                Place Order
            </button>
        </form>
    </div>

</div>
</body>
</html>
