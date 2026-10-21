
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:24px;font-weight:bold;color:#111827;">
            Admin Dashboard
        </h2>
    </x-slot>

    <div style="max-width:1200px;margin:30px auto;padding:20px;">

        <h3 style="font-size:24px;font-weight:bold;margin-bottom:8px;">
            Welcome, {{ Auth::user()->name }}!
        </h3>

        <p style="color:#6b7280;margin-bottom:25px;">
            Manage your restaurant from the admin panel.
        </p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;">

            <a href="{{ route('orders.index') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Orders</h3>
                <p style="color:#6b7280;">View and manage restaurant orders.</p>
            </a>

            <a href="{{ url('/menu-items') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Menu Items</h3>
                <p style="color:#6b7280;">Manage food items and prices.</p>
            </a>

            <a href="{{ url('/categories') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Categories</h3>
                <p style="color:#6b7280;">Organize your restaurant menu.</p>
            </a>

            <a href="{{ url('/restaurant-tables') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Restaurant Tables</h3>
                <p style="color:#6b7280;">Manage seating and table availability.</p>
            </a>

            <a href="{{ route('inventory-items.index') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Food Inventory</h3>
                <p style="color:#6b7280;">Manage restaurant stock.</p>
            </a>

            <a href="{{ route('admin.users.index') }}"
               style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#111827;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;">Manage Users</h3>
                <p style="color:#6b7280;">Manage restaurant user accounts.</p>
            </a>

            {{-- Blog Management --}}
            <div style="background:white;padding:24px;border:1px solid #e5e7eb;border-radius:10px;">
                <h3 style="font-size:20px;font-weight:bold;margin-bottom:10px;color:#111827;">
                    Blog Management
                </h3>

                <p style="color:#6b7280;margin-bottom:18px;">
                    Create new blogs and edit existing blog posts.
                </p>

                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    <a href="{{ route('admin.blogs.create') }}"
                       style="display:inline-block;padding:10px 14px;background:#16a34a;color:white;text-decoration:none;border-radius:6px;">
                        + Add Blog
                    </a>

                    <a href="{{ route('admin.blogs.index') }}"
                       style="display:inline-block;padding:10px 14px;background:#7c3aed;color:white;text-decoration:none;border-radius:6px;">
                        Manage / Edit Blogs
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
