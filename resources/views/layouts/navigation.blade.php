
<nav style="background:#ffffff;border-bottom:1px solid #e5e7eb;box-shadow:0 2px 5px rgba(0,0,0,0.04);">
    <div style="max-width:1280px;margin:0 auto;padding:12px 24px;">

        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;">

            <!-- Logo -->
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
               style="font-size:20px;font-weight:700;color:#111827;text-decoration:none;white-space:nowrap;">
                🍽️ Restaurant Manager
            </a>

            <!-- Navigation Links -->
            <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">

                 
                    <a href="{{ url('/') }}"
                    target="_blank"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                        Home
                    </a>


                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                   style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->routeIs('dashboard','admin.dashboard') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                    Dashboard
                </a>

                <a href="{{ route('orders.index') }}"
                   style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->routeIs('orders.*') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                    Orders
                </a>

                @if (Auth::user()->role === 'admin')

                    <a href="{{ url('/menu-items') }}"
                       style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->is('menu-items*') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                        Menu Items
                    </a>

                    <a href="{{ url('/categories') }}"
                       style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->is('categories*') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                        Categories
                    </a>

                    <a href="{{ url('/restaurant-tables') }}"
                       style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->is('restaurant-tables*') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                        Tables
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       style="display:inline-block;padding:10px 14px;border-radius:7px;text-decoration:none;font-weight:600;{{ request()->routeIs('admin.users.*') ? 'background:#dbeafe;color:#1d4ed8;' : 'color:#374151;' }}">
                        Manage Users
                    </a>

                @endif

            </div>

            <!-- User Profile and Logout -->
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">

                <div style="display:flex;flex-direction:column;gap:3px;">
                    <span style="font-size:14px;font-weight:700;color:#111827;">
                        {{ Auth::user()->name }}
                    </span>
                    <span style="font-size:12px;color:#6b7280;">
                        {{ ucfirst(Auth::user()->role) }} Account
                    </span>
                </div>

                <a href="{{ route('profile.edit') }}"
                   style="display:inline-block;padding:9px 14px;border:1px solid #d1d5db;border-radius:7px;background:#ffffff;color:#2563eb;text-decoration:none;font-weight:600;">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                            style="display:inline-block;padding:10px 15px;background:#dc2626;color:#ffffff;border:0;border-radius:7px;font-weight:600;cursor:pointer;">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>
