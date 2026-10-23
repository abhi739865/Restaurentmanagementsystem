
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Spice Table | Fresh Food, Great Moments</title>
    <meta name="description" content="Discover delicious food, explore our menu and read stories from our kitchen.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #faf7f1;
            --dark: #29251f;
            --orange: #a94f2b;
            --orange-dark: #843a20;
            --muted: #756e65;
            --border: #e9e1d7;
            --white: #fff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .brand, .food-title {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .site-navbar {
            background: rgba(250, 247, 241, .96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 18px rgba(41, 37, 31, .03);
        }

        .brand {
            color: var(--dark);
            font-size: 1.7rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: -.5px;
            white-space: nowrap;
        }

        .brand span {
            color: var(--orange);
        }

        .nav-link {
            color: var(--dark);
            font-weight: 600;
            font-size: .94rem;
            padding: 10px 12px !important;
            transition: color .2s ease;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: var(--orange);
        }

        .navbar-toggler {
            border-color: var(--border);
            padding: 7px 10px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(169, 79, 43, .15);
        }

        .btn-food,
        .btn-outline-food {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px 23px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }

        .btn-food {
            background: var(--orange);
            color: var(--white);
            border: 1px solid var(--orange);
            box-shadow: 0 6px 16px rgba(169, 79, 43, .16);
        }

        .btn-food:hover {
            background: var(--orange-dark);
            border-color: var(--orange-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(169, 79, 43, .22);
        }

        .btn-outline-food {
            color: var(--dark);
            border: 1px solid #d8c9ba;
            background: transparent;
        }

        .btn-outline-food:hover {
            border-color: var(--orange);
            background: #f2e9df;
            color: var(--orange-dark);
            transform: translateY(-2px);
        }

        /* Hero */
        .hero {
            padding: 76px 0 82px;
            position: relative;
        }

        .hero-copy {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-block;
            color: var(--orange);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-size: .76rem;
            font-weight: 700;
        }

        .hero h1 {
            font-size: clamp(2.8rem, 5vw, 4.7rem);
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -1.7px;
            margin: 18px 0;
        }

        .hero h1 span {
            color: var(--orange);
        }

        .hero p {
            color: var(--muted);
            font-size: 1.06rem;
            line-height: 1.9;
            max-width: 480px;
        }

        .hero-visual {
            position: relative;
            padding: 0 10px 12px 0;
        }

        .hero-image {
            width: 100%;
            height: 490px;
            object-fit: cover;
            border-radius: 22px;
            display: block;
            box-shadow: 0 22px 50px rgba(41, 37, 31, .15);
        }

        .hero-image-badge {
            position: absolute;
            bottom: 0;
            left: -15px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px 20px;
            box-shadow: 0 10px 30px rgba(41, 37, 31, .1);
        }

        .hero-image-badge strong {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
        }

        .hero-image-badge small {
            color: var(--muted);
        }

        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 34px;
            padding-top: 25px;
            border-top: 1px solid var(--border);
        }

        .hero-stats strong {
            display: block;
            font-size: 1.15rem;
        }

        .hero-stats span {
            font-size: .83rem;
            color: var(--muted);
        }

        /* Sections */
        .section {
            padding: 76px 0;
        }

        .section-heading {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            letter-spacing: -.7px;
        }

        .section-intro {
            color: var(--muted);
            max-width: 600px;
            line-height: 1.85;
        }

        .section-heading-wrap {
            margin-bottom: 40px;
        }

        .food-card,
        .blog-card {
            height: 100%;
            overflow: hidden;
            background: var(--white);
            border: 1px solid #eee6dc;
            border-radius: 15px;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .food-card:hover,
        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 35px rgba(41, 37, 31, .10);
        }

        .food-image,
        .blog-image {
            width: 100%;
            object-fit: cover;
            display: block;
            background: #eee7df;
            transition: transform .4s ease;
        }

        .food-image {
            height: 235px;
        }

        .blog-image {
            height: 215px;
        }

        .food-card:hover .food-image,
        .blog-card:hover .blog-image {
            transform: scale(1.025);
        }

        .image-wrap {
            overflow: hidden;
            background: #eee7df;
        }

        .card-body-custom {
            padding: 24px;
        }

        .food-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .muted {
            color: var(--muted);
            line-height: 1.8;
        }

        .price {
            color: var(--orange);
            font-size: 1.15rem;
            font-weight: 700;
            margin-top: 12px;
        }

        .blog-link {
            color: var(--orange);
            font-weight: 700;
            text-decoration: none;
        }

        .blog-link:hover {
            color: var(--orange-dark);
            text-decoration: underline;
        }

        .empty-state {
            background: #fff;
            border: 1px dashed #d8c9ba;
            border-radius: 14px;
            padding: 35px 20px;
        }

        /* About */
        .about-section {
            background: #eee7dc;
            border: 1px solid #e4d9ca;
            border-radius: 22px;
            padding: 52px;
            overflow: hidden;
        }

        .about-image {
            width: 100%;
            height: 310px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(41, 37, 31, .10);
        }

        /* Footer */
        .site-footer {
            background: var(--dark);
            color: var(--white);
            padding: 48px 0 22px;
            margin-top: 35px;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem;
            font-weight: 700;
        }

        .footer-description {
            color: #c7bfb5;
            line-height: 1.8;
            max-width: 380px;
        }

        .site-footer a {
            color: #f1c5a8;
            text-decoration: none;
            transition: color .2s ease;
        }

        .site-footer a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid #514940;
            margin-top: 30px;
            padding-top: 20px;
            color: #c7bfb5;
            font-size: .88rem;
        }

        @media (max-width: 991px) {
            .navbar-nav {
                padding-top: 15px;
                align-items: stretch !important;
                gap: 4px !important;
            }

            .nav-link {
                padding: 10px 0 !important;
            }

            .nav-cta {
                margin: 8px 0 12px;
            }

            .hero {
                padding: 55px 0 65px;
            }

            .hero-image {
                height: 390px;
            }

            .about-section {
                padding: 35px;
            }
        }

        @media (max-width: 767px) {
            .brand {
                font-size: 1.4rem;
            }

            .hero {
                padding: 42px 0 48px;
            }

            .hero h1 {
                letter-spacing: -.8px;
            }

            .hero-image {
                height: 300px;
                border-radius: 16px;
            }

            .hero-image-badge {
                left: 0;
            }

            .hero-stats {
                gap: 20px;
            }

            .section {
                padding: 50px 0;
            }

            .food-image {
                height: 220px;
            }

            .about-section {
                padding: 24px;
                border-radius: 16px;
            }

            .about-image {
                height: 250px;
            }

            .card-body-custom {
                padding: 20px;
            }

            .site-footer {
                padding-top: 35px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top site-navbar">
    <div class="container py-2">
        <a class="brand" href="{{ route('home') }}">
            The Spice <span>Table.</span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
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
                <li class="nav-item nav-cta">
                    <a href="{{ route('menu.public') }}" class="btn-food">
                        Explore Menu <span aria-hidden="true">→</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Hero --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 hero-copy">
                <span class="eyebrow">Welcome to The Spice Table</span>

                <h1>
                    Good Food.<br>
                    <span>Great Moments.</span>
                </h1>

                <p>
                    Discover fresh ingredients, rich flavors and meals
                    prepared with care. Every dish is an invitation to
                    gather, share and enjoy.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('menu.public') }}" class="btn-food">
                        Explore Our Menu <span aria-hidden="true">→</span>
                    </a>
                    <a href="{{ route('blogs.index') }}" class="btn-outline-food">
                        Read Our Blog
                    </a>
                </div>

                <div class="hero-stats">
                    <div>
                        <strong>Fresh</strong>
                        <span>Quality ingredients</span>
                    </div>
                    <div>
                        <strong>Made with care</strong>
                        <span>Every single dish</span>
                    </div>
                    <div>
                        <strong>Made to share</strong>
                        <span>Moments that matter</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual">
                    <img
                        class="hero-image"
                     src="https://img.magnific.com/free-photo/fried-chicken-breast-cheese-tomato-french-fries-ketchup-green-salad-side-view-jpg_141793-1782.jpg?semt=ais_hybrid&w=740&q=80"
                        alt="A beautifully prepared restaurant meal"
                        fetchpriority="high">

                    <div class="hero-image-badge">
                        <strong>Made fresh, served with love</strong>
                        <small>A little flavor, a lot of happiness.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Menu --}}
<section class="section" id="menu">
    <div class="container">
        <div class="text-center section-heading-wrap">
            <span class="eyebrow">Made with care</span>
            <h2 class="section-heading mt-2">A Taste of Something Special</h2>
            <p class="section-intro mx-auto mt-3 mb-0">
                Explore some of the delicious dishes available on our menu,
                prepared with fresh ingredients and plenty of care.
            </p>
        </div>

        <div class="row g-4">
            @forelse($menuItems as $item)
                <div class="col-sm-6 col-lg-4">
                    <article class="food-card">
                        <div class="image-wrap">
                            @if($item->image)
                                <img
                                    class="food-image"
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name ?? 'Menu item' }}"
                                    loading="lazy">
                            @else
                                <img
                                    class="food-image"
                                    src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=700&q=80"
                                    alt="Fresh restaurant dish"
                                    loading="lazy">
                            @endif
                        </div>

                        <div class="card-body-custom">
                            <h3 class="food-title">
                                {{ $item->name ?? 'Menu Item' }}
                            </h3>

                            <p class="muted mb-0">
                                {{ $item->description ?? 'Prepared fresh with care and quality ingredients.' }}
                            </p>

                            @if(isset($item->price))
                                <div class="price">
                                    ₹{{ number_format((float) $item->price, 2) }}
                                </div>
                            @endif
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center">
                        <h3 class="food-title">Something delicious is coming</h3>
                        <p class="muted mb-0">
                            Our menu is being updated. Please check back soon.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('menu.public') }}" class="btn-food">
                View Full Menu <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>

{{-- About --}}
<section class="section pt-0" id="about">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="eyebrow">Our story</span>

                    <h2 class="section-heading mt-2">
                        Good Food Brings Us Together
                    </h2>

                    <p class="muted mt-3 mb-4">
                        We believe a great restaurant is about more than
                        food. It is about welcoming people, sharing flavors
                        and creating moments worth remembering. Explore our
                        menu and discover the stories behind the dishes we love.
                    </p>

                    <a href="{{ route('about') }}" class="btn-food">
                        Discover Our Story <span aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="col-lg-5">
                    <img
                        class="about-image"
                        src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=900&q=85"
                        alt="Restaurant dining table"
                        loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Blog --}}
<section class="section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 section-heading-wrap">
            <div>
                <span class="eyebrow">From our kitchen</span>
                <h2 class="section-heading mt-2 mb-0">Latest Stories</h2>
                <p class="section-intro mt-3 mb-0">
                    Recipes, inspiration and little stories from our restaurant.
                </p>
            </div>

            <a href="{{ route('blogs.index') }}" class="blog-link">
                View All Blogs →
            </a>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="blog-card">
                        <div class="image-wrap">
                            @if($blog->image)
                                <img
                                    class="blog-image"
                                    src="{{ asset('storage/' . $blog->image) }}"
                                    alt="{{ $blog->title }}"
                                    loading="lazy">
                            @else
                                <img
                                    class="blog-image"
                                    src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=700&q=80"
                                    alt="Food and fresh ingredients"
                                    loading="lazy">
                            @endif
                        </div>

                        <div class="card-body-custom">
                            <h3 class="food-title">{{ $blog->title }}</h3>

                            <p class="muted">
                                {{ \Illuminate\Support\Str::limit($blog->short_description ?? $blog->content, 120) }}
                            </p>

                            <a
                                class="blog-link"
                                href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                                Read Article →
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <h3 class="food-title">New stories are coming soon</h3>
                        <p class="muted mb-0">
                            Check back for news, recipes and stories from our kitchen.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-7">
                <div class="footer-brand">The Spice Table.</div>
                <p class="footer-description mt-3 mb-0">
                    Fresh flavors, thoughtful cooking and memorable moments.
                    We look forward to welcoming you.
                </p>
            </div>

            <div class="col-md-5">
                <h3 class="h5 mb-3">Quick Links</h3>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('menu.public') }}">Our Menu</a>
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('blogs.index') }}">Blog</a>
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom d-flex justify-content-between flex-wrap gap-2">
            <span>© {{ date('Y') }} The Spice Table. All rights reserved.</span>
            <span>Made with care, served with love.</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
