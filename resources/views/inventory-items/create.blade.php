
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <h2 style="font-size:24px;font-weight:700;color:#111827;">
                Add Inventory Item
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
                    Register Stock
                </h1>
                <p style="color:#6b7280;margin-top:6px;">
                    Enter ingredient details and opening stock quantity.
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

                <form action="{{ route('inventory-items.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label for="name" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                            Ingredient Name *
                        </label>
                        <input id="name" name="name" type="text"
                               value="{{ old('name') }}" required
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
                                <option value="">Select unit</option>
                                <option value="kg" @selected(old('unit') === 'kg')>Kilogram (kg)</option>
                                <option value="g" @selected(old('unit') === 'g')>Gram (g)</option>
                                <option value="litre" @selected(old('unit') === 'litre')>Litre</option>
                                <option value="ml" @selected(old('unit') === 'ml')>Millilitre (ml)</option>
                                <option value="pieces" @selected(old('unit') === 'pieces')>Pieces</option>
                                <option value="packets" @selected(old('unit') === 'packets')>Packets</option>
                            </select>
                        </div>

                        <div>
                            <label for="quantity" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Opening Quantity *
                            </label>
                            <input id="quantity" name="quantity" type="number"
                                   min="0" step="0.001"
                                   value="{{ old('quantity', '0') }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>

                        <div>
                            <label for="minimum_stock" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Minimum Stock Alert *
                            </label>
                            <input id="minimum_stock" name="minimum_stock" type="number"
                                   min="0" step="0.001"
                                   value="{{ old('minimum_stock', '5') }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>

                        <div>
                            <label for="cost_per_unit" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                                Cost per Unit (₹) *
                            </label>
                            <input id="cost_per_unit" name="cost_per_unit" type="number"
                                   min="0" step="0.01"
                                   value="{{ old('cost_per_unit', '0') }}" required
                                   style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;">
                        </div>
                    </div>

                    <div style="margin-bottom:25px;">
                        <label for="notes" style="display:block;color:#374151;font-weight:600;margin-bottom:8px;">
                            Notes (Optional)
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                                  placeholder="Supplier details or other notes..."
                                  style="width:100%;background:white;border:1px solid #d1d5db;color:#111827;padding:12px;border-radius:6px;resize:vertical;">{{ old('notes') }}</textarea>
                    </div>

                    <div style="display:flex;gap:12px;flex-wrap:wrap;">
                        <button type="submit"
                                style="background:#16a34a;color:white;padding:11px 18px;border:0;border-radius:6px;font-weight:600;cursor:pointer;">
                            Save Inventory Item
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
