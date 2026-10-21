
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px;font-weight:700;color:#1f2937;">
            Update Order Status
        </h2>
    </x-slot>

    <div style="max-width:800px;margin:30px auto;padding:20px;">

        <div style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;">

            <h3 style="font-size:22px;font-weight:700;margin-bottom:20px;">
                {{ $order->order_number }}
            </h3>

            <p style="margin-bottom:10px;">
                <strong>Customer:</strong>
                {{ $order->customer_name ?: 'Walk-in Customer' }}
            </p>

            <p style="margin-bottom:10px;">
                <strong>Total Amount:</strong>
                ₹{{ number_format((float) $order->total_amount, 2) }}
            </p>

            <p style="margin-bottom:20px;">
                <strong>Current Status:</strong>
                {{ ucfirst($order->status) }}
            </p>

            @if ($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:6px;margin-bottom:18px;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('orders.update', $order) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom:20px;">
                    <label for="status" style="display:block;font-weight:700;margin-bottom:8px;">
                        Order Status
                    </label>

                    <select id="status" name="status" required
                            style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:6px;">
                        <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="preparing" {{ old('status', $order->status) === 'preparing' ? 'selected' : '' }}>
                            Preparing
                        </option>
                        <option value="ready" {{ old('status', $order->status) === 'ready' ? 'selected' : '' }}>
                            Ready
                        </option>
                        <option value="completed" {{ old('status', $order->status) === 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                        <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>
                </div>

                <div style="margin-bottom:24px;">
                    <label for="payment_status" style="display:block;font-weight:700;margin-bottom:8px;">
                        Payment Status
                    </label>

                    <select id="payment_status" name="payment_status" required
                            style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:6px;">
                        <option value="unpaid" {{ old('payment_status', $order->payment_status) === 'unpaid' ? 'selected' : '' }}>
                            Unpaid
                        </option>
                        <option value="paid" {{ old('payment_status', $order->payment_status) === 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>
                        <option value="refunded" {{ old('payment_status', $order->payment_status) === 'refunded' ? 'selected' : '' }}>
                            Refunded
                        </option>
                    </select>
                </div>

                <div style="margin-bottom:24px;">
                    <label for="notes" style="display:block;font-weight:700;margin-bottom:8px;">
                        Order Notes
                    </label>

                    <textarea id="notes" name="notes" rows="4"
                              style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:6px;">{{ old('notes', $order->notes) }}</textarea>
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="submit"
                            style="background:#2563eb;color:white;padding:12px 20px;border:0;border-radius:6px;font-weight:700;cursor:pointer;">
                        Save Changes
                    </button>

                    <a href="{{ route('orders.show', $order) }}"
                       style="background:#e5e7eb;color:#1f2937;padding:12px 20px;border-radius:6px;text-decoration:none;font-weight:700;">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
