
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us | The Spice Table</title>
    <meta name="description" content="Discover the story, values and passion behind The Spice Table restaurant.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #faf7f1;
            --dark: #29251f;
            --orange: #a94f2b;
            --muted: #756e65;
            --border: #e9e1d7;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
        }

        h1, h2, h3, .brand {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background: var(--cream);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            color: var(--dark);
            font-size: 1.55rem;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-link {
            color: var(--dark);
            font-weight: 600;
        }

        .nav-link:hover { color: var(--orange); }

        .btn-food {
            display: inline-block;
            padding: 12px 22px;
            background: var(--orange);
            color: white;
            border: 1px solid var(--orange);
            border-radius: 7px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .btn-food:hover {
            background: #843a20;
            color: white;
        }

        .eyebrow {
            color: var(--orange);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: .78rem;
            font-weight: 700;
        }

        .hero {
            padding: 75px 0;
        }

        .hero h1 {
            margin: 18px 0;
            font-size: clamp(2.7rem, 5vw, 4.5rem);
            font-weight: 700;
            line-height: 1.15;
        }

        .intro, .section-text {
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.9;
        }

        .hero-image {
            width: 100%;
            height: 430px;
            object-fit: cover;
            border-radius: 18px;
        }

        .section {
            padding: 65px 0;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3.1rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .story-image {
            width: 100%;
            height: 390px;
            object-fit: cover;
            border-radius: 16px;
        }

        .value-card {
            height: 100%;
            padding: 30px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: .2s;
        }

        .value-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px #29251f10;
        }

        .value-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            background: #f5e5d9;
            border-radius: 12px;
            font-size: 25px;
        }

        .value-card h3 {
            font-size: 1.45rem;
            margin-bottom: 12px;
        }

        .value-card p {
            color: var(--muted);
            line-height: 1.8;
            margin: 0;
        }

        .mission {
            padding: 55px;
            background: #eee7dc;
            border-radius: 18px;
        }

        .mission p {
            max-width: 760px;
            color: var(--muted);
            line-height: 1.9;
            font-size: 1.08rem;
        }

        .cta {
            padding: 55px 25px;
            background: var(--dark);
            color: white;
            border-radius: 18px;
            text-align: center;
        }

        .cta p {
            color: #ded5ca;
            line-height: 1.8;
        }

        .site-footer {
            margin-top: 65px;
            padding: 35px 0;
            background: var(--dark);
            color: white;
        }

        .site-footer a {
            color: #f1c5a8;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .hero { padding: 40px 0; }
            .hero-image { height: 290px; }
            .section { padding: 42px 0; }
            .story-image { height: 290px; }
            .mission { padding: 28px; }
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
                    <a class="nav-link" href="{{ route('home') }}#menu">Our Menu</a>
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
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow">Our Story</span>
                <h1>More Than Food.<br>A Place to Connect.</h1>
                <p class="intro">
                    At The Spice Table, we believe the best moments in life
                    happen around a table. We bring people together through
                    delicious food, warm hospitality and memorable experiences.
                </p>
                <a href="{{ route('menu.public') }}" class="btn-food mt-3">
                    Discover Our Menu
                </a>
            </div>

            <div class="col-lg-6">
                <img class="hero-image"
                     src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=1100&q=85"
                     alt="A welcoming restaurant dining experience">
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img class="story-image"
                     src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1000&q=85"
                     alt="Restaurant team preparing and serving food">
            </div>

            <div class="col-lg-6">
                <span class="eyebrow">Who We Are</span>
                <h2 class="section-title mt-3 mb-4">
                    A Love for Food, A Passion for Hospitality
                </h2>

                <p class="section-text">
                    Great food starts with thoughtful preparation, quality
                    ingredients and a genuine love for cooking. Our aim is
                    to create a welcoming place where guests can relax and
                    enjoy every bite.
                </p>

                <p class="section-text">
                    From the first greeting to the final bite, we want every
                    visit to feel special. Whether you join us for a quick
                    meal or a gathering with loved ones, we are here to make
                    the experience enjoyable.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow">What Matters to Us</span>
            <h2 class="section-title mt-3">The Values Behind Every Dish</h2>
            <p class="section-text mx-auto" style="max-width: 620px;">
                Every detail matters when it comes to serving food and
                welcoming our guests.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">🍲</div>
                    <h3>Quality Ingredients</h3>
                    <p>
                        We value carefully selected ingredients and thoughtful
                        preparation to bring out the best in every dish.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">❤️</div>
                    <h3>Made with Care</h3>
                    <p>
                        We believe attention to detail and a passion for food
                        help turn an everyday meal into something memorable.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Warm Hospitality</h3>
                    <p>
                        Every guest deserves a friendly welcome and a
                        comfortable place to enjoy good food and company.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission -->
<section class="section">
    <div class="container">
        <div class="mission text-center">
            <span class="eyebrow">Our Mission</span>
            <h2 class="section-title mt-3 mb-4">
                Making Every Meal a Moment to Remember
            </h2>
            <p class="mx-auto mb-0">
                Our mission is to bring people together through enjoyable
                food, thoughtful service and a welcoming atmosphere. We
                strive to make every meal feel meaningful, whether it is
                an everyday lunch, a family dinner or a special celebration.
            </p>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="section pt-0">
    <div class="container">
        <div class="cta">
            <span class="eyebrow">Come Join Us</span>
            <h2 class="section-title mt-3 mb-3">
                Your Next Favorite Meal Awaits
            </h2>
            <p class="mx-auto mb-4" style="max-width: 600px;">
                Explore our menu, discover new flavors and read the stories
                behind our kitchen.
            </p>
            <a href="{{ route('menu.public') }}" class="btn-food">
                Explore Our Menu
            </a>
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-light ms-2">
                Read Our Blog
            </a>
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
                <a href="{{ route('about') }}" class="me-3">About Us</a>
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
