
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:24px;font-weight:700;color:#1f2937;">
            Create New Order
        </h2>
    </x-slot>

    <div style="padding:32px 16px;background:#f3f4f6;min-height:80vh;">
        <div style="max-width:850px;margin:0 auto;">
            <div style="background:#fff;padding:28px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.08);">

                @if ($errors->any())
                    <div style="background:#fee2e2;color:#991b1b;padding:16px;border-radius:8px;margin-bottom:20px;">
                        <strong>Please fix these errors:</strong>
                        <ul style="padding-left:20px;list-style:disc;margin-top:8px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom:20px;">
                        <label for="customer_name" style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Customer Name</label>
                        <input id="customer_name" type="text" name="customer_name"
                               value="{{ old('customer_name') }}"
                               placeholder="Enter customer name"
                               style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;font-size:15px;">
                    </div>

                    <div style="margin-bottom:20px;">
                        <label for="order_type" style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Order Type</label>
                        <select name="order_type" id="order_type" required
                                style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;background:#fff;font-size:15px;">
                            <option value="dine_in" @selected(old('order_type', 'dine_in') === 'dine_in')>Dine In</option>
                            <option value="takeaway" @selected(old('order_type') === 'takeaway')>Takeaway</option>
                            <option value="delivery" @selected(old('order_type') === 'delivery')>Delivery</option>
                        </select>
                    </div>

                    <div id="table_field" style="margin-bottom:24px;">
                        <label for="restaurant_table_id" style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Restaurant Table</label>
                        <select name="restaurant_table_id" id="restaurant_table_id"
                                style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;background:#fff;font-size:15px;">
                            <option value="">Select Table</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}" @selected((string) old('restaurant_table_id') === (string) $table->id)>
                                    Table {{ $table->table_number }} — Capacity: {{ $table->capacity }}
                                </option>
                            @endforeach
                        </select>
                        @if ($tables->isEmpty())
                            <p style="color:#b91c1c;margin-top:6px;font-size:13px;">No available tables. Add an available table first.</p>
                        @endif
                    </div>

                    <div style="border-top:1px solid #e5e7eb;margin:28px 0;"></div>

                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:18px;">
                        <h3 style="font-size:19px;font-weight:700;color:#111827;margin:0;">Menu Items</h3>
                        <button type="button" id="add_item"
                                style="background:#374151;color:#fff;border:0;border-radius:7px;padding:10px 15px;font-weight:600;cursor:pointer;">
                            + Add Item
                        </button>
                    </div>

                    @if ($menuItems->isEmpty())
                        <p style="color:#b91c1c;background:#fee2e2;padding:12px;border-radius:7px;margin-bottom:16px;">
                            No available menu items. Please add an available menu item first.
                        </p>
                    @endif

                    <div id="items_container">
                        <div class="item-row" style="display:grid;grid-template-columns:minmax(0,2fr) minmax(100px,1fr);gap:14px;margin-bottom:18px;">
                            <div>
                                <label style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Menu Item</label>
                                <select name="items[0][menu_item_id]" required
                                        style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;background:#fff;font-size:14px;">
                                    <option value="">Select Item</option>
                                    @foreach ($menuItems as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }} — ₹{{ number_format((float) $item->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Quantity</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" max="100" required
                                       style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;font-size:15px;">
                            </div>
                        </div>
                    </div>

                    <div style="margin:24px 0;">
                        <label for="notes" style="display:block;font-weight:600;margin-bottom:8px;color:#374151;">Order Notes</label>
                        <textarea name="notes" id="notes" rows="3"
                                  placeholder="Special instructions..."
                                  style="display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d1d5db;border-radius:7px;font-size:15px;resize:vertical;">{{ old('notes') }}</textarea>
                    </div>

                    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:28px;">
                        <button type="submit"
                                style="background:#2563eb;color:#fff;border:0;border-radius:7px;padding:12px 22px;font-size:15px;font-weight:700;cursor:pointer;">
                            Create Order
                        </button>

                        <a href="{{ route('orders.index') }}"
                           style="display:inline-block;background:#e5e7eb;color:#1f2937;border-radius:7px;padding:12px 22px;text-decoration:none;font-weight:600;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const orderType = document.getElementById('order_type');
        const tableField = document.getElementById('table_field');
        const tableSelect = document.getElementById('restaurant_table_id');
        const container = document.getElementById('items_container');
        const addButton = document.getElementById('add_item');

        function updateTableField() {
            const isDineIn = orderType.value === 'dine_in';
            tableField.style.display = isDineIn ? 'block' : 'none';
            tableSelect.required = isDineIn;

            if (!isDineIn) {
                tableSelect.value = '';
            }
        }

        updateTableField();
        orderType.addEventListener('change', updateTableField);

        let itemIndex = 1;

        addButton.addEventListener('click', function () {
            const firstRow = container.querySelector('.item-row');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('select, input').forEach(function (field) {
                field.name = field.name.replace(/items\[\d+\]/, 'items[' + itemIndex + ']');
                field.value = field.name.includes('[quantity]') ? '1' : '';
            });

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Remove Item';
            removeButton.style.cssText = 'grid-column:1/-1;background:#dc2626;color:white;border:0;border-radius:6px;padding:9px 12px;cursor:pointer;justify-self:start;';
            removeButton.addEventListener('click', function () {
                newRow.remove();
            });

            newRow.appendChild(removeButton);
            container.appendChild(newRow);
            itemIndex++;
        });
    </script>
</x-app-layout>
