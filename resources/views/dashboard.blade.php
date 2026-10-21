
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:24px;font-weight:bold;color:#1f2937;">
            Restaurant Dashboard
        </h2>
    </x-slot>

    <div style="max-width:1200px;margin:30px auto;padding:20px;">

        <h3 style="font-size:22px;font-weight:bold;margin-bottom:8px;">
            Welcome to Restaurant Management System
        </h3>

        <p style="color:#6b7280;margin-bottom:25px;">
            Manage your restaurant activities from one place.
        </p>

        {{-- Dashboard Statistics --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:30px;">

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Total Orders</p>
                <h3 style="font-size:28px;font-weight:bold;">
                    {{ $stats['total_orders'] }}
                </h3>
            </div>

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Total Paid Sales</p>
                <h3 style="font-size:28px;font-weight:bold;color:#059669;">
                    ₹{{ number_format((float) $stats['total_sales'], 2) }}
                </h3>
            </div>

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Pending Orders</p>
                <h3 style="font-size:28px;font-weight:bold;color:#d97706;">
                    {{ $stats['pending_orders'] }}
                </h3>
            </div>

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Completed Orders</p>
                <h3 style="font-size:28px;font-weight:bold;color:#16a34a;">
                    {{ $stats['completed_orders'] }}
                </h3>
            </div>

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Paid Orders</p>
                <h3 style="font-size:28px;font-weight:bold;color:#2563eb;">
                    {{ $stats['paid_orders'] }}
                </h3>
            </div>

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;">Unpaid Orders</p>
                <h3 style="font-size:28px;font-weight:bold;color:#dc2626;">
                    {{ $stats['unpaid_orders'] }}
                </h3>
            </div>

        </div>

        {{-- Existing Navigation Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:30px;">

            <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                <p style="color:#6b7280;margin-bottom:10px;">Manage Orders</p>
                <h3 style="font-size:25px;font-weight:bold;margin-bottom:15px;">Orders</h3>
                <a href="{{ route('orders.index') }}"
                   style="display:inline-block;background:#2563eb;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
                    View Orders
                </a>
            </div>

            @if (Auth::user()->role === 'admin')

                <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                    <p style="color:#6b7280;margin-bottom:10px;">Manage Food</p>
                    <h3 style="font-size:25px;font-weight:bold;margin-bottom:15px;">Menu Items</h3>
                    <a href="{{ url('/menu-items') }}"
                       style="display:inline-block;background:#16a34a;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
                        View Menu
                    </a>
                </div>

                
<div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
    <p style="color:#6b7280;margin-bottom:10px;">Manage Stock</p>
    <h3 style="font-size:25px;font-weight:bold;margin-bottom:15px;">Food Inventory</h3>
    <a href="{{ route('inventory-items.index') }}"
       style="display:inline-block;background:#16a34a;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
        Manage Inventory
    </a>
</div>


                <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                    <p style="color:#6b7280;margin-bottom:10px;">Organize Menu</p>
                    <h3 style="font-size:25px;font-weight:bold;margin-bottom:15px;">Categories</h3>
                    <a href="{{ url('/categories') }}"
                       style="display:inline-block;background:#9333ea;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
                        View Categories
                    </a>
                </div>

                <div style="background:white;padding:22px;border-radius:10px;border:1px solid #e5e7eb;">
                    <p style="color:#6b7280;margin-bottom:10px;">Manage Seating</p>
                    <h3 style="font-size:25px;font-weight:bold;margin-bottom:15px;">Restaurant Tables</h3>
                    <a href="{{ url('/restaurant-tables') }}"
                       style="display:inline-block;background:#ea580c;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;">
                        View Tables
                    </a>
                </div>



            @endif

        </div>

        {{-- Quick Start --}}
        <div style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;">
            <h3 style="font-size:20px;font-weight:bold;margin-bottom:12px;">
                Quick Start
            </h3>

            <p style="color:#4b5563;margin-bottom:15px;">
                Create a new customer order here.
            </p>

            <a href="{{ route('orders.create') }}"
               style="display:inline-block;background:#111827;color:white;padding:12px 20px;border-radius:6px;text-decoration:none;">
                + Create New Order
            </a>
        </div>

    </div>
</x-app-layout>
