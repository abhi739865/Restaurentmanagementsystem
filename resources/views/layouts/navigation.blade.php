<nav class="restaurant-navbar">
    <style>
        .restaurant-navbar {
            background: #172238;
            border-bottom: 1px solid #263650;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .12);
            color: white;
            position: relative;
            z-index: 40;
        }

        .restaurant-navbar * {
            box-sizing: border-box;
        }

        .restaurant-nav-inner {
            max-width: 1600px;
            margin: 0 auto;
            padding: 13px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .restaurant-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .restaurant-logo-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #30415f;
            border-radius: 12px;
            font-size: 22px;
        }

        .restaurant-nav-links {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .restaurant-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 12px;
            color: #c4cede;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            transition: background .2s, color .2s;
        }

        .restaurant-nav-link:hover {
            background: #263650;
            color: white;
        }

        .restaurant-nav-link.active {
            background: #30415f;
            color: white;
            box-shadow: inset 0 -2px #60a5fa;
        }

        .restaurant-user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .restaurant-avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 50%;
            font-weight: 800;
            font-size: 16px;
        }

        .restaurant-user-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .restaurant-user-name {
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        .restaurant-user-role {
            color: #9eabc0;
            font-size: 11px;
        }

        .restaurant-profile-link,
        .restaurant-logout-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s;
        }

        .restaurant-profile-link {
            border: 1px solid #43516a;
            color: white;
            background: transparent;
        }

        .restaurant-profile-link:hover {
            background: #30415f;
        }

        .restaurant-logout-button {
            border: 0;
            background: #dc2626;
            color: white;
            cursor: pointer;
        }

        .restaurant-logout-button:hover {
            background: #b91c1c;
        }

        @media (max-width: 1100px) {
            .restaurant-nav-inner {
                gap: 14px;
            }

            .restaurant-nav-links {
                order: 3;
                width: 100%;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 3px;
            }

            .restaurant-nav-link {
                white-space: nowrap;
            }
        }

        @media (max-width: 600px) {
            .restaurant-nav-inner {
                padding: 12px 14px;
                gap: 12px;
            }

            .restaurant-logo {
                font-size: 17px;
            }

            .restaurant-logo-icon {
                width: 36px;
                height: 36px;
            }

            .restaurant-user-area {
                gap: 8px;
                flex-wrap: wrap;
            }

            .restaurant-user-info {
                display: none;
            }

            .restaurant-profile-link,
            .restaurant-logout-button {
                padding: 9px 10px;
            }

            .restaurant-nav-link {
                padding: 10px;
            }
        }
    </style>

    <div class="restaurant-nav-inner">

        {{-- BRAND --}}
        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
           class="restaurant-logo">
            <span class="restaurant-logo-icon">🍽️</span>
            <span>Restaurant Manager</span>
        </a>

        {{-- NAVIGATION --}}
        <div class="restaurant-nav-links">

            <a href="{{ url('/') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="restaurant-nav-link">
                🏠 Home
            </a>

            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
               class="restaurant-nav-link {{ request()->routeIs('dashboard', 'admin.dashboard') ? 'active' : '' }}">
                ▦ Dashboard
            </a>

            <a href="{{ route('orders.index') }}"
               class="restaurant-nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                🛒 Orders
            </a>

            @if (Auth::user()->role === 'admin')

                <a href="{{ route('menu-items.index') }}"
                   class="restaurant-nav-link {{ request()->is('menu-items*') ? 'active' : '' }}">
                    🍴 Menu Items
                </a>

                <a href="{{ route('categories.index') }}"
                   class="restaurant-nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                    ▤ Categories
                </a>

                <a href="{{ route('restaurant-tables.index') }}"
                   class="restaurant-nav-link {{ request()->is('restaurant-tables*') ? 'active' : '' }}">
                    🪑 Tables
                </a>

                <a href="{{ route('inventory-items.index') }}"
                   class="restaurant-nav-link {{ request()->is('inventory-items*') ? 'active' : '' }}">
                    📦 Inventory
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="restaurant-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    👥 Users
                </a>

            @endif

        </div>

        {{-- USER PROFILE + LOGOUT --}}
        <div class="restaurant-user-area">

            <div class="restaurant-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="restaurant-user-info">
                <span class="restaurant-user-name">
                    {{ Auth::user()->name }}
                </span>
                <span class="restaurant-user-role">
                    {{ ucfirst(Auth::user()->role) }} Account
                </span>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="restaurant-profile-link">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf

                <button type="submit" class="restaurant-logout-button">
                    ↪ Logout
                </button>
            </form>

        </div>
    </div>
</nav>