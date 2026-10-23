
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Restaurant Blog')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #faf8f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .blog-navbar {
            background: #29231f;
        }

        .blog-main {
            flex: 1;
            width: 100%;
        }

        .blog-footer {
            background: #29231f;
            color: white;
            text-align: center;
            padding: 16px;
            margin-top: 30px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark blog-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/blog') }}">
                Restaurant Blog
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#blogNavbar"
                aria-controls="blogNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="blogNavbar">
                <div class="ms-auto mt-3 mt-lg-0">
                    <a class="btn btn-outline-light" href="{{ url('/') }}">
                        Home
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="blog-main container py-4">
        @yield('content')
    </main>

    <footer class="blog-footer">
        <div class="container">
            Restaurant Management System
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
