
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <style>
        body { background: #faf8f5; }
        .hero { background: #29231f; color: white; padding: 65px 20px; }
        .blog-card { border: 0; border-radius: 14px; overflow: hidden; height: 100%; }
        .blog-image { height: 230px; object-fit: cover; width: 100%; }
        .blog-card .card-body { padding: 22px; }
    </style>
</head>
<body>




    <header class="hero text-center">
        <h1>Our Restaurant Stories</h1>
        <p class="mb-0">Discover our food, kitchen and dining experience.</p>
    </header>

    <main class="container py-5">
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="card blog-card shadow-sm">
                        @if($blog->image)
                            <img class="blog-image"
                                 src="{{ asset('storage/'.$blog->image) }}"
                                 alt="{{ $blog->title }}">
                        @endif

                        <div class="card-body">
                            <h2 class="h5">{{ $blog->title }}</h2>
                            <p>{{ $blog->short_description }}</p>
                            <a href="{{ route('blogs.show', $blog->slug) }}"
                               class="btn btn-dark">Read More</a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h2>No published blogs yet</h2>
                    <p>Our restaurant stories will appear here soon.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $blogs->links() }}
        </div>

        <a href="{{ url('/') }}"
   style="display:inline-block; margin-bottom:20px; padding:10px 18px; background:#2563eb; color:white; text-decoration:none; border-radius:6px;">
    ← Back to Home
</a>
    </main>
</body>
</html>
