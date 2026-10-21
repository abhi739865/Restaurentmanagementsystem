
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restaurant Blog')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/blog') }}">
                Restaurant Blog
            </a>

            <a class="btn btn-outline-light" href="{{ url('/') }}">
                Home
            </a>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3">
        Restaurant Management System
    </footer>

</body>
</html>