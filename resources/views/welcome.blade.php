
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant | Fresh Food, Great Moments</title>
    <meta name="description" content="Discover delicious food, explore our menu and read stories from our kitchen.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #faf7f1;
            --dark: #29251f;
            --orange: #a94f2b;
            --muted: #756e65;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
        }

        .navbar {
            background: var(--cream);
            border-bottom: 1px solid #e9e1d7;
        }

        .brand, h1, h2, h3, .food-title {
            font-family: 'Playfair Display', serif;
        }

        .brand {
            color: var(--dark);
            font-size: 1.6rem;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-link {
            color: var(--dark);
            font-weight: 600;
        }

        .nav-link:hover { color: var(--orange); }

        .btn-food {
            background: var(--orange);
            color: white;
            border: 1px solid var(--orange);
            border-radius: 7px;
            padding: 12px 22px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-food:hover {
            background: #843a20;
            color: white;
        }

        .btn-outline-food {
            color: var(--orange);
            border: 1px solid var(--orange);
            border-radius: 7px;
            padding: 12px 22px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }

        .hero {
            padding: 75px 0;
        }

        .eyebrow {
            color: var(--orange);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: .78rem;
            font-weight: 700;
        }

        .hero h1 {
            font-size: clamp(2.8rem, 5vw, 4.8rem);
            line-height: 1.12;
            font-weight: 700;
            margin: 18px 0;
        }

        .hero p {
            color: var(--muted);
            font-size: 1.08rem;
            line-height: 1.8;
            max-width: 480px;
        }

        .hero-image {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 18px;
        }

        .section {
            padding: 65px 0;
        }

        .section-heading {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
        }

        .section-intro {
            color: var(--muted);
            max-width: 600px;
            line-height: 1.8;
        }

        .food-card, .blog-card {
            height: 100%;
            overflow: hidden;
            background: white;
            border: 1px solid #eee6dc;
            border-radius: 14px;
            transition: transform .2s, box-shadow .2s;
        }

        .food-card:hover, .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px #29251f12;
        }

        .food-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #eee7df;
        }

        .blog-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
            background: #eee7df;
        }

        .card-body-custom { padding: 22px; }

        .food-title {
            font-size: 1.45rem;
            font-weight: 600;
        }

        .muted { color: var(--muted); }

        .price {
            color: var(--orange);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .blog-link {
            color: var(--orange);
            font-weight: 700;
            text-decoration: none;
        }

        .blog-link:hover { text-decoration: underline; }

        .about-section {
            background: #eee7dc;
            border-radius: 18px;
            padding: 45px;
        }

        .site-footer {
            background: #29251f;
            color: white;
            padding: 35px 0;
            margin-top: 50px;
        }

        .site-footer a {
            color: #f1c5a8;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .hero { padding: 40px 0; }
            .hero-image { height: 290px; margin-top: 25px; }
            .section { padding: 42px 0; }
            .about-section { padding: 25px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-2">
        <a class="brand" href="{{ route('home') }}">The Spice Table</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu.public') }}">Our Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                
<a href="{{ route('menu.public') }}"
   style="display:inline-block;padding:12px 24px;background:#a34d19;color:white;text-decoration:none;border-radius:6px;">
    Explore Our Menu
</a>

            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow">Welcome to our restaurant</span>
                <h1>Good Food.<br>Great Moments.</h1>
                <p>
                    Discover fresh ingredients, rich flavors and meals
                    prepared with care. Every dish is an invitation to
                    gather, share and enjoy.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('menu.public') }}" class="btn-food">Explore Our Menu</a>
                    <a href="{{ route('blogs.index') }}" class="btn-outline-food">
                        Read Our Blog
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <img
                    class="hero-image"
                    src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?auto=format&fit=crop&w=1100&q=85"
                    alt="A beautifully prepared Indian meal">
            </div>
        </div>
    </div>
</section>

<section class="section" id="menu">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow">Made with care</span>
            <h2 class="section-heading mt-2">A Taste of Something Special</h2>
            <p class="section-intro mx-auto">
                Explore some of the delicious dishes available in our menu.
            </p>
        </div>

        <div class="row g-4">
            @forelse($menuItems as $item)
                <div class="col-sm-6 col-lg-4">
                    <div class="food-card">
                        @if($item->image)
                            <img class="food-image"
                                 src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->name ?? 'Menu item' }}">
                        @else
                            <img class="food-image"
                                 src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80"
                                 alt="Restaurant dish">
                        @endif

                        <div class="card-body-custom">
                            <h3 class="food-title">
                                {{ $item->name ?? 'Menu Item' }}
                            </h3>

                            <p class="muted">
                                {{ $item->description ?? 'Prepared fresh with care and quality ingredients.' }}
                            </p>

                            @if(isset($item->price))
                                <div class="price">
                                    ₹{{ number_format((float) $item->price, 2) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="muted">
                        Our menu is being updated. Please check back soon.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="section pt-0" id="about">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="eyebrow">Our story</span>
                    <h2 class="section-heading mt-2">
                        Good Food Brings Us Together
                    </h2>
                    <p class="muted mt-3 mb-0" style="line-height: 1.9;">
                        We believe a great restaurant is about more than
                        food. It is about welcoming people, sharing
                        flavors and creating moments worth remembering.
                        Explore our menu and discover the stories behind
                        the dishes we love.
                    </p>
                </div>
                <div class="col-lg-5">
                    <img class="hero-image"
                         style="height: 280px;"
                         src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=900&q=85"
                         alt="Restaurant dining table">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
            <div>
                <span class="eyebrow">From our kitchen</span>
                <h2 class="section-heading mt-2 mb-0">Latest Stories</h2>
            </div>
            <a href="{{ route('blogs.index') }}" class="blog-link">
                View All Blogs →
            </a>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card">
                        @if($blog->image)
                            <img class="blog-image"
                                 src="{{ asset('storage/' . $blog->image) }}"
                                 alt="{{ $blog->title }}">
                        @else
                            <img class="blog-image"
                                 src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=700&q=80"
                                 alt="Food and ingredients">
                        @endif

                        <div class="card-body-custom">
                            <h3 class="food-title">{{ $blog->title }}</h3>

                            <p class="muted">
                                {{ \Illuminate\Support\Str::limit($blog->short_description ?? $blog->content, 120) }}
                            </p>

                            <a class="blog-link"
                               href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                                Read Article →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="muted">
                        New stories are coming soon.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <h3 class="mb-2">The Spice Table</h3>
                <p class="mb-0 text-white-50">
                    Fresh flavors. Memorable moments.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('home') }}" class="me-3">Home</a>
                <a href="#menu" class="me-3">Menu</a>
                <a href="{{ route('blogs.index') }}">Blog</a>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <p class="small text-white-50 mb-0">
            © {{ date('Y') }} The Spice Table. All rights reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
