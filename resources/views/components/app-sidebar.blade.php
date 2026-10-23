
<aside class="app-sidebar">
    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
       class="app-sidebar-brand">
        <span class="app-sidebar-logo">🍽️</span>
        <span>RestaurantPro</span>
    </a>

    <div class="app-sidebar-label">WORKSPACE</div>

    <nav class="app-sidebar-nav">
        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
           class="app-sidebar-link {{ request()->routeIs('dashboard', 'admin.dashboard') ? 'active' : '' }}">
            <span>▦</span> Dashboard
        </a>

        <a href="{{ route('orders.index') }}"
           class="app-sidebar-link {{ request()->is('orders*') ? 'active' : '' }}">
            <span>🛒</span> Orders
        </a>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('menu-items.index') }}"
               class="app-sidebar-link {{ request()->is('menu-items*') ? 'active' : '' }}">
                <span>🍴</span> Menu Items
            </a>

            <a href="{{ route('categories.index') }}"
               class="app-sidebar-link {{ request()->is('categories*') ? 'active' : '' }}">
                <span>▤</span> Categories
            </a>

            <a href="{{ route('inventory-items.index') }}"
               class="app-sidebar-link {{ request()->is('inventory-items*') ? 'active' : '' }}">
                <span>📦</span> Food Inventory
            </a>

            <a href="{{ route('restaurant-tables.index') }}"
               class="app-sidebar-link {{ request()->is('restaurant-tables*') ? 'active' : '' }}">
                <span>🪑</span> Restaurant Tables
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="app-sidebar-link {{ request()->is('users*') ? 'active' : '' }}">
                <span>👥</span> Manage Users
            </a>

            <a href="{{ route('admin.blogs.index') }}"
               class="app-sidebar-link {{ request()->is('blogs*') ? 'active' : '' }}">
                <span>📝</span> Blog Posts
            </a>
        @endif
    </nav>

    <div class="app-sidebar-label app-sidebar-website-label">WEBSITE</div>

    <a href="{{ route('home') }}" class="app-sidebar-link">
        <span>↗</span> View Website
    </a>
</aside>
