
<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <h2 style="font-size:24px;font-weight:700;color:#111827;">
                Food Inventory
            </h2>

            <a href="{{ route('inventory-items.create') }}"
               style="background:#16a34a;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;font-weight:600;">
                + Add Stock Item
            </a>
        </div>
    </x-slot>

    <div style="background:#f9fafb;min-height:100vh;padding:28px 18px;color:#111827;">
        <div style="max-width:1400px;margin:auto;">

            @if (session('success'))
                <div style="background:#dcfce7;border:1px solid #bbf7d0;color:#166534;padding:14px 18px;border-radius:8px;margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;padding:14px 18px;border-radius:8px;margin-bottom:20px;">
                    Please check the form for errors.
                </div>
            @endif

            <div style="margin-bottom:24px;">
                <h1 style="font-size:28px;font-weight:700;color:#111827;">
                    Inventory Overview
                </h1>
                <p style="color:#6b7280;margin-top:6px;">
                    Manage ingredients, stock quantities and inventory value.
                </p>
            </div>

            {{-- Statistics --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-bottom:25px;">

                <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;padding:22px;">
                    <p style="color:#6b7280;font-size:14px;">Total Stock Items</p>
                    <h3 style="font-size:30px;font-weight:700;color:#111827;margin-top:10px;">
                        {{ number_format($totalItems) }}
                    </h3>
                    <p style="color:#6b7280;font-size:12px;margin-top:6px;">Registered ingredients</p>
                </div>

                <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;padding:22px;">
                    <p style="color:#6b7280;font-size:14px;">Total Stock Value</p>
                    <h3 style="font-size:28px;font-weight:700;color:#15803d;margin-top:10px;">
                        ₹{{ number_format((float)$totalStockValue, 2) }}
                    </h3>
                    <p style="color:#6b7280;font-size:12px;margin-top:6px;">Quantity × unit cost</p>
                </div>

                <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;padding:22px;">
                    <p style="color:#6b7280;font-size:14px;">Low Stock Alerts</p>
                    <h3 style="font-size:30px;font-weight:700;color:#dc2626;margin-top:10px;">
                        {{ number_format($lowStockItems) }}
                    </h3>
                    <p style="color:#6b7280;font-size:12px;margin-top:6px;">Items at or below minimum stock</p>
                </div>
            </div>

            {{-- Inventory Table --}}
            <div style="background:white;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">
                <div style="padding:20px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                    <div>
                        <h3 style="font-size:19px;font-weight:700;color:#111827;">Stock Register</h3>
                        <p style="font-size:13px;color:#6b7280;margin-top:5px;">Your registered inventory items</p>
                    </div>

                    <span style="background:#f3f4f6;color:#374151;padding:7px 12px;border-radius:6px;font-size:13px;">
                        {{ $items->total() }} items
                    </span>
                </div>

                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;min-width:800px;">
                        <thead>
                            <tr style="background:#f9fafb;color:#4b5563;text-align:left;font-size:12px;">
                                <th style="padding:15px 20px;">ITEM NAME</th>
                                <th style="padding:15px 20px;">QUANTITY</th>
                                <th style="padding:15px 20px;">MIN. STOCK</th>
                                <th style="padding:15px 20px;">UNIT COST</th>
                                <th style="padding:15px 20px;">STOCK VALUE</th>
                                <th style="padding:15px 20px;">STATUS</th>
                                <th style="padding:15px 20px;">ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($items as $item)
                                @php
                                    $isLow = (float)$item->quantity <= (float)$item->minimum_stock;
                                @endphp

                                <tr style="border-top:1px solid #e5e7eb;color:#111827;">
                                    <td style="padding:18px 20px;">
                                        <div style="font-weight:600;">{{ $item->name }}</div>
                                        <div style="font-size:12px;color:#6b7280;margin-top:4px;">
                                            Unit: {{ $item->unit }}
                                        </div>
                                    </td>

                                    <td style="padding:18px 20px;font-weight:600;">
                                        {{ number_format((float)$item->quantity, 3) }}
                                        <span style="font-size:12px;color:#6b7280;">{{ $item->unit }}</span>
                                    </td>

                                    <td style="padding:18px 20px;color:#4b5563;">
                                        {{ number_format((float)$item->minimum_stock, 3) }} {{ $item->unit }}
                                    </td>

                                    <td style="padding:18px 20px;">
                                        ₹{{ number_format((float)$item->cost_per_unit, 2) }}
                                    </td>

                                    <td style="padding:18px 20px;color:#15803d;font-weight:600;">
                                        ₹{{ number_format((float)$item->quantity * (float)$item->cost_per_unit, 2) }}
                                    </td>

                                    <td style="padding:18px 20px;">
                                        @if ($isLow)
                                            <span style="background:#fee2e2;color:#b91c1c;padding:6px 10px;border-radius:5px;font-size:11px;font-weight:700;">
                                                LOW STOCK
                                            </span>
                                        @else
                                            <span style="background:#dcfce7;color:#166534;padding:6px 10px;border-radius:5px;font-size:11px;font-weight:700;">
                                                IN STOCK
                                            </span>
                                        @endif
                                    </td>

                                    <td style="padding:18px 20px;white-space:nowrap;">
                                        <a href="{{ route('inventory-items.edit', $item) }}"
                                           style="background:#2563eb;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;font-size:12px;font-weight:600;">
                                            Edit
                                        </a>

                                        <form action="{{ route('inventory-items.destroy', $item) }}"
                                              method="POST"
                                              style="display:inline-block;margin-left:5px;"
                                              onsubmit="return confirm('Are you sure you want to delete this inventory item?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                style="background:#dc2626;color:white;padding:8px 12px;border:0;border-radius:5px;cursor:pointer;font-size:12px;font-weight:600;">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding:45px 20px;text-align:center;">
                                        <div style="font-size:18px;font-weight:700;color:#111827;">
                                            No inventory items yet
                                        </div>
                                        <p style="color:#6b7280;margin:10px 0 20px;">
                                            Add your first ingredient to start tracking stock.
                                        </p>
                                        <a href="{{ route('inventory-items.create') }}"
                                           style="background:#16a34a;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;font-weight:600;">
                                            + Add First Item
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($items->hasPages())
                    <div style="padding:20px;border-top:1px solid #e5e7eb;">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>

            <div style="margin-top:18px;">
                <a href="{{ route('dashboard') }}"
                   style="color:#4b5563;text-decoration:none;font-size:14px;">
                    ← Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
