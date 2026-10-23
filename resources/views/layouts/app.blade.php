
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RestaurantPro') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .app-shell {
            min-height: 100vh;
            background: #f4f6fb;
        }

        .app-workspace {
            display: flex;
            min-height: calc(100vh - 68px);
        }

        .app-sidebar {
            width: 245px;
            flex: 0 0 245px;
            background: #172238;
            color: white;
            padding: 22px 14px;
        }

        .app-sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 26px;
            color: white;
            text-decoration: none;
            font-size: 19px;
            font-weight: 800;
        }

        .app-sidebar-logo {
            display: flex;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #30415f;
        }

        .app-sidebar-label {
            padding: 10px 12px;
            color: #8e9bb2;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.3px;
        }

        .app-sidebar-website-label {
            margin-top: 22px;
        }

        .app-sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .app-sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px;
            border-radius: 8px;
            border-left: 3px solid transparent;
            color: #c4cede;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .app-sidebar-link:hover,
        .app-sidebar-link.active {
            background: #30415f;
            color: white;
        }

        .app-sidebar-link.active {
            border-left-color: #60a5fa;
        }

        .app-content {
            flex: 1;
            min-width: 0;
        }

        .app-page-header {
            background: white;
            border-bottom: 1px solid #e8ecf3;
            padding: 20px 28px;
        }

        .app-page-main {
            min-width: 0;
        }

        @media(max-width: 800px) {
            .app-workspace {
                display: block;
            }

            .app-sidebar {
                width: 100%;
                padding: 12px;
            }

            .app-sidebar-brand {
                padding: 4px 8px 14px;
            }

            .app-sidebar-nav {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 5px;
            }

            .app-sidebar-link {
                flex: 0 0 auto;
                white-space: nowrap;
            }

            .app-sidebar-website-label {
                margin-top: 5px;
            }

            .app-page-header {
                padding: 16px;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="app-shell">


        <div class="app-workspace">

            <x-app-sidebar />

            <div class="app-content">

                @isset($header)
                    <header class="app-page-header">
                        {{ $header }}
                    </header>
                @endisset

                <main class="app-page-main">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </div>
</body>
</html>
