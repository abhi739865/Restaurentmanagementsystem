
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <h2 style="font-size:24px;font-weight:700;color:#111827;">
                Edit Inventory Item
            </h2>

            <a href="{{ route('inventory-items.index') }}"
               style="background:#f3f4f6;color:#374151;padding:10px 16px;border:1px solid #e5e7eb;border-radius:6px;text-decoration:none;">
                ← Back to Inventory
            </a>
        </div>
    </x-slot>

    <div style="background:#f9fafb;min-height:100vh;padding:30px 18px;color:#111827;">
        <div style="max-width:850px;margin:auto;">

            <div style="margin-bottom:24px;">
                <h1 style="font-size:28px;font-weight:700;color:#111827;">
                    Update Stock
                </h1>
                <p style="color:#6b7280;margin-top:6px;">
                    Update details for {{ $inventoryItem->name }}.
                </p>
            </div>

            <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;padding:26px;">

                @if ($errors->any())
                    <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;padding:14px;border-radius:8px;margin-bottom:20px;">
                        <strong>Please correct these errors:</strong>
                        <ul style="padding-left:20px;margin-top:8px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('inventory-items.update', $inventoryItem) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom:22px;">
                        <label for="name" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                            Ingredient Name *
                        </label>
                        <input id="name" name="name" type="text"
                               value="{{ old('name', $inventoryItem->name) }}" required
                               placeholder="e.g. Basmati Rice"
                               style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-bottom:22px;">
                        <div>
                            <label for="unit" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Unit *
                            </label>
                            <select id="unit" name="unit" required
                                    style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                                @foreach (['kg' => 'Kilogram (kg)', 'g' => 'Gram (g)', 'litre' => 'Litre', 'ml' => 'Millilitre (ml)', 'pieces' => 'Pieces', 'packets' => 'Packets'] as $value => $label)
                                    <option value="{{ $value }}"
                                        @selected(old('unit', $inventoryItem->unit) === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach

                                @if (!in_array($inventoryItem->unit, ['kg', 'g', 'litre', 'ml', 'pieces', 'packets']))
                                    <option value="{{ $inventoryItem->unit }}"
                                        @selected(old('unit', $inventoryItem->unit) === $inventoryItem->unit)>
                                        {{ $inventoryItem->unit }}
                                    </option>
                                @endif
                            </select>
                        </div>

                        <div>
                            <label for="quantity" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Current Quantity *
                            </label>
                            <input id="quantity" name="quantity" type="number"
                                   min="0" step="0.001"
                                   value="{{ old('quantity', $inventoryItem->quantity) }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>

                        <div>
                            <label for="minimum_stock" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Minimum Stock Alert *
                            </label>
                            <input id="minimum_stock" name="minimum_stock" type="number"
                                   min="0" step="0.001"
                                   value="{{ old('minimum_stock', $inventoryItem->minimum_stock) }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>

                        <div>
                            <label for="cost_per_unit" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Cost per Unit (₹) *
                            </label>
                            <input id="cost_per_unit" name="cost_per_unit" type="number"
                                   min="0" step="0.01"
                                   value="{{ old('cost_per_unit', $inventoryItem->cost_per_unit) }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>
                    </div>

                    <div style="margin-bottom:25px;">
                        <label for="notes" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                            Notes (Optional)
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                                  placeholder="Supplier details or other notes..."
                                  style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;resize:vertical;">{{ old('notes', $inventoryItem->notes) }}</textarea>
                    </div>

                    <div style="display:flex;gap:12px;flex-wrap:wrap;">
                        <button type="submit"
                                style="background:#16a34a;color:white;padding:11px 18px;border:0;border-radius:6px;font-weight:600;cursor:pointer;">
                            Update Inventory
                        </button>

                        <a href="{{ route('inventory-items.index') }}"
                           style="background:white;color:#374151;padding:11px 18px;border:1px solid #d1d5db;border-radius:6px;text-decoration:none;font-weight:600;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
