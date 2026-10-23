@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart | Restaurant</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f8f7f4;
            color: #292929;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        a { color: #b84a27; text-decoration: none; }

        .cart-item {
            background: white;
            padding: 20px;
            margin: 16px 0;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            box-shadow: 0 3px 12px #0000000a;
        }

        input {
            width: 75px;
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button, .checkout {
            display: inline-block;
            padding: 10px 15px;
            border: 0;
            border-radius: 6px;
            background: #b84a27;
            color: white;
            cursor: pointer;
        }

        .remove { background: #555; }

        .summary {
            background: white;
            padding: 22px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .message {
            background: #e4f6e8;
            color: #17652a;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
        }

        .error {
            background: #fde8e8;
            color: #9b2020;
        }

        .checkout-btn {
    display: inline-block;
    width: 100%;
    padding: 14px 20px;
    background-color: #16a34a;
    color: #ffffff;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.checkout-btn:hover {
    background-color: #15803d;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(22, 163, 74, 0.25);
}

.checkout-btn:active {
    transform: translateY(0);
}
    </style>
</head>
<body>
<div class="container">

    <div class="top">
        <h1>🛒 My Cart</h1>
        <a href="{{ route('menu.public') }}">← Continue Shopping</a>
    </div>

    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)

        @foreach($cart as $id => $item)
            <div class="cart-item">
                <div>
                    <h3>{{ $item['name'] }}</h3>
                    <p>Price: ₹{{ number_format($item['price'], 2) }}</p>
                    <strong>
                        Subtotal: ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </strong>
                </div>

                <div>
                    <form action="{{ route('cart.update', $id) }}"
                          method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('PATCH')

                        <input type="number"
                               name="quantity"
                               value="{{ $item['quantity'] }}"
                               min="1"
                               max="20"
                               required>

                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('cart.remove', $id) }}"
                          method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="remove">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="summary">
            <h2>Total: ₹{{ number_format($total, 2) }}</h2>
            <p>Delivery charges and taxes, if applicable, will be calculated during checkout.</p>

            <a href="{{ route('checkout.index') }}" class="checkout-btn">
                Proceed to Checkout
            </a>
        </div>

    @else
        <div class="summary">
            <h2>Your cart is empty</h2>
            <p>Add your favourite dishes from our menu.</p>
            <a class="checkout" href="{{ route('menu.public') }}">Explore Menu</a>
        </div>
    @endif

</div>
</body>
</html>
