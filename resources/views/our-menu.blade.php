
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Our Menu | Our Restaurant</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #fffaf5;
            color: #30231c;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .topbar {
            background: #21150f;
            color: #fff;
            padding: 12px 7%;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            font-size: 13px;
        }

        .navbar {
            background: #fff;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            box-shadow: 0 3px 15px #00000008;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            color: #8d3e1c;
        }

        .brand span {
            color: #30231c;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #40352f;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #b45325;
        }

        .nav-cta {
            background: #a74720;
            color: white !important;
            padding: 11px 18px;
            border-radius: 6px;
        }

        .hero {
            min-height: 390px;
            padding: 75px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            background:
                linear-gradient(120deg, #21150fef, #74371ed9),
                radial-gradient(circle at 80% 20%, #e8ad68, #482719);
        }

        .hero-content {
            max-width: 760px;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 12px;
            font-weight: bold;
            color: #efc18c;
        }

        .hero h1 {
            font-size: clamp(38px, 6vw, 64px);
            line-height: 1.12;
            margin: 18px 0;
        }

        .hero p {
            max-width: 600px;
            margin: 0 auto 28px;
            color: #f3e5dc;
            font-size: 17px;
        }

        .btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 6px;
            font-weight: bold;
            transition: .2s;
        }

        .btn-primary {
            background: #c66a35;
            color: white;
        }

        .btn-primary:hover {
            background: #a74720;
            transform: translateY(-2px);
        }

        .section {
            max-width: 1180px;
            margin: auto;
            padding: 65px 22px;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 32px;
        }

        .section-heading .eyebrow {
            color: #b45325;
            letter-spacing: 2px;
        }

        .section-heading h2 {
            font-size: clamp(28px, 4vw, 38px);
            margin: 8px 0;
            line-height: 1.25;
        }

        .section-heading p {
            color: #81746b;
            margin: 8px auto 0;
            max-width: 620px;
        }

        .flash-message {
            max-width: 900px;
            margin: 20px auto;
            padding: 14px 18px;
            border-radius: 8px;
        }

        .flash-success {
            background: #e4f6e8;
            color: #17652a;
            border: 1px solid #b9e5c2;
        }

        .flash-error {
            background: #fde8e8;
            color: #9b2020;
            border: 1px solid #f5c4c4;
        }

        .search-wrap {
            max-width: 650px;
            margin: 0 auto 30px;
        }

        .search-wrap input {
            width: 100%;
            border: 1px solid #e8d9cc;
            background: white;
            border-radius: 9px;
            padding: 16px 18px;
            font-size: 15px;
            outline: none;
        }

        .search-wrap input:focus {
            border-color: #b45325;
            box-shadow: 0 0 0 3px #b4532518;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 35px;
        }

        .filter-btn {
            padding: 10px 18px;
            border-radius: 30px;
            border: 1px solid #e8d9cc;
            background: white;
            color: #544239;
            cursor: pointer;
            font-size: 14px;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #a74720;
            border-color: #a74720;
            color: white;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 30px;
        }

        .food-card {
            background: white;
            border: 1px solid #f0e4da;
            border-radius: 13px;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }

        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px #40200d12;
        }

        /* Menu item image */
        .food-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            background: #f2dfcd;
        }

        .food-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease;
        }

        .food-card:hover .food-image img {
            transform: scale(1.04);
        }

        .food-placeholder {
            width: 100%;
            height: 100%;
            min-height: 175px;
            background: linear-gradient(135deg, #f2dfcd, #e7c5a6);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 54px;
        }

        .food-info {
            padding: 21px;
        }

        .food-info h3 {
            margin: 8px 0;
            font-size: 20px;
        }

        .food-info p {
            color: #7e7067;
            font-size: 14px;
            margin: 8px 0 16px;
        }

        .food-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            border-top: 1px solid #f0e7df;
            padding-top: 15px;
        }

        .category-label {
            font-size: 12px;
            color: #a74720;
            font-weight: bold;
        }

        .price {
            color: #a74720;
            font-size: 19px;
            font-weight: 800;
        }

        /* Add to Cart form */
        .add-to-cart-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .add-to-cart-form input {
            width: 65px;
            padding: 10px;
            border: 1px solid #e8d9cc;
            border-radius: 6px;
            font-size: 14px;
        }

        .add-to-cart-form button {
            flex: 1;
            background: #b45325;
            color: white;
            border: 0;
            padding: 11px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .add-to-cart-form button:hover {
            background: #8d3e1c;
        }

        .add-to-cart-form button:disabled {
            opacity: .65;
            cursor: wait;
        }

        .empty {
            text-align: center;
            padding: 35px 20px;
            background: white;
            border: 1px solid #f0e4da;
            border-radius: 12px;
            color: #81746b;
        }

        .features {
            background: #f4e8dc;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .feature {
            background: #fffaf5;
            text-align: center;
            padding: 32px 22px;
            border-radius: 12px;
        }

        .feature-icon {
            font-size: 34px;
        }

        .feature h3 {
            margin: 12px 0 8px;
        }

        .feature p {
            margin: 0;
            font-size: 14px;
            color: #81746b;
        }

        .cta {
            text-align: center;
            background: #2a1b13;
            color: white;
            padding: 65px 20px;
        }

        .cta h2 {
            font-size: clamp(28px, 4vw, 40px);
            margin: 0 0 12px;
        }

        .cta p {
            color: #e0cfc1;
            margin-bottom: 25px;
        }

        footer {
            background: #1a100b;
            color: #e9ddd4;
            padding: 35px 7%;
            text-align: center;
        }

        footer p {
            margin: 8px 0;
            font-size: 13px;
            color: #bca99c;
        }

        footer a {
            color: #f0bc8f;
            margin: 0 8px;
        }

        @media (max-width: 850px) {
            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .navbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-links {
                gap: 15px;
            }

            .hero {
                min-height: 330px;
                padding: 55px 20px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 45px 18px;
            }

            .food-meta {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        <span>Freshly prepared, made with care.</span>
        <span>Welcome to Our Restaurant</span>
    </div>

    <header class="navbar">
        <a href="{{ url('/') }}" class="brand">
            OUR <span>RESTAURANT</span>
        </a>

        <nav class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('menu.public') }}">Our Menu</a>
            <a href="{{ url('/blog') }}">Blog</a>
            <a href="{{ url('/about') }}">About Us</a>
            <a href="{{ route('cart.index') }}">🛒 My Cart</a>
            <a href="#menu" class="nav-cta">Explore Dishes</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <span class="eyebrow">Good Food, Great Moments</span>

            <h1>Discover Your Next Favourite Dish</h1>

            <p>
                From comforting classics to delicious restaurant specials,
                explore a menu made to bring people together.
            </p>

            <a href="#menu" class="btn btn-primary">
                Explore Our Menu ↓
            </a>
        </div>
    </section>

    <main>
        <section class="section" id="menu">

            {{-- Existing success/error messages, hidden because SweetAlert handles them --}}
            @if(session('success'))
                <div id="cart-success-message" hidden>{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div id="cart-error-message" hidden>{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div id="cart-validation-errors" hidden>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="section-heading">
                <span class="eyebrow">Made for Food Lovers</span>
                <h2>Our Delicious Menu</h2>

                <p>
                    Explore our selection of dishes and find something
                    delicious for your next meal.
                </p>
            </div>

            <div class="search-wrap">
                <input
                    type="search"
                    id="menuSearch"
                    placeholder="Search your favourite food..."
                    aria-label="Search menu items"
                >
            </div>

            <div class="category-list">
                <button
                    type="button"
                    class="filter-btn active"
                    data-category="all"
                >
                    All Dishes
                </button>

                @foreach($categories as $category)
                    <button
                        type="button"
                        class="filter-btn"
                        data-category="{{ $category->name }}"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            @if($menuItems->isEmpty())

                <div class="empty">
                    <h3>Our menu is getting ready!</h3>
                    <p>Please check back soon for our delicious dishes.</p>
                </div>

            @else

                <div class="menu-grid" id="menuGrid">

                    @foreach($menuItems as $item)

                        <article
                            class="food-card"
                            data-name="{{ strtolower($item->name) }}"
                            data-category="{{ $item->category->name ?? 'Our Special' }}"
                        >

                            <div class="food-image">
                                @if($item->image)
                                    <img
                                        src="{{ asset('storage/' . $item->image) }}"
                                        alt="{{ $item->name }}"
                                        loading="lazy"
                                        onerror="this.style.display='none'; this.nextElementSibling.hidden=false;"
                                    >
                                    <div class="food-placeholder" hidden>
                                        🍽️
                                    </div>
                                @else
                                    <div class="food-placeholder">
                                        🍽️
                                    </div>
                                @endif
                            </div>

                            <div class="food-info">

                                <span class="category-label">
                                    {{ $item->category->name ?? 'Our Special' }}
                                </span>

                                <h3>{{ $item->name }}</h3>

                                <p>
                                    {{ $item->description ?: 'Prepared fresh with care using quality ingredients.' }}
                                </p>

                                <div class="food-meta">
                                    <span>Fresh &amp; Delicious</span>

                                    <span class="price">
                                        ₹{{ number_format((float) $item->price, 2) }}
                                    </span>
                                </div>

                                @if($item->is_available)
                                    <form
                                        action="{{ route('cart.add', $item->id) }}"
                                        method="POST"
                                        class="add-to-cart-form"
                                    >
                                        @csrf

                                        <input
                                            type="number"
                                            name="quantity"
                                            value="1"
                                            min="1"
                                            max="20"
                                            required
                                            aria-label="Quantity for {{ $item->name }}"
                                        >

                                        <button type="submit">
                                            Add to Cart 🛒
                                        </button>
                                    </form>
                                @else
                                    <div style="margin-top:18px;color:#9b2020;font-weight:bold;">
                                        Currently Unavailable
                                    </div>
                                @endif

                            </div>
                        </article>

                    @endforeach

                </div>

                <div
                    class="empty"
                    id="noResults"
                    style="display:none;margin-top:20px;"
                >
                    No dishes match your search. Try another name or category.
                </div>

            @endif

        </section>

        <section class="features">
            <div class="section">

                <div class="section-heading">
                    <span class="eyebrow">Why Choose Us</span>
                    <h2>A Little More Than Just Food</h2>

                    <p>
                        Good ingredients, thoughtful preparation
                        and a welcoming experience.
                    </p>
                </div>

                <div class="feature-grid">

                    <div class="feature">
                        <div class="feature-icon">🥬</div>
                        <h3>Quality Ingredients</h3>
                        <p>
                            We believe great dishes start with carefully
                            selected ingredients.
                        </p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">👨‍🍳</div>
                        <h3>Made with Care</h3>
                        <p>
                            Every meal deserves attention, flavour
                            and a little extra love.
                        </p>
                    </div>

                    <div class="feature">
                        <div class="feature-icon">❤️</div>
                        <h3>Made for Sharing</h3>
                        <p>
                            A welcoming place to enjoy food and create
                            memorable moments.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="cta">
            <h2>Good Food Brings Us Together</h2>
            <p>Explore the menu and find your next favourite dish.</p>

            <a href="#menu" class="btn btn-primary">
                View the Menu
            </a>
        </section>
    </main>

    <footer>
        <strong>OUR RESTAURANT</strong>

        <p>Delicious moments start here.</p>

        <p>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('menu.public') }}">Our Menu</a>
            <a href="{{ url('/blog') }}">Blog</a>
            <a href="{{ url('/about') }}">About Us</a>
            <a href="{{ route('cart.index') }}">My Cart</a>
        </p>

        <p>
            © {{ date('Y') }} Our Restaurant. All rights reserved.
        </p>
    </footer>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Menu search and category filters
        const searchInput = document.getElementById('menuSearch');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const foodCards = document.querySelectorAll('.food-card');
        const noResults = document.getElementById('noResults');

        let activeCategory = 'all';

        function filterMenu() {
            if (!searchInput) return;

            const searchTerm = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            foodCards.forEach(card => {
                const name = card.dataset.name || '';
                const category = card.dataset.category || '';

                const matchesSearch = name.includes(searchTerm);

                const matchesCategory =
                    activeCategory === 'all' ||
                    category.toLowerCase() === activeCategory.toLowerCase();

                const visible = matchesSearch && matchesCategory;

                card.style.display = visible ? '' : 'none';

                if (visible) visibleCount++;
            });

            if (noResults) {
                noResults.style.display =
                    visibleCount === 0 ? 'block' : 'none';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterMenu);
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                activeCategory = button.dataset.category || 'all';

                filterButtons.forEach(item => {
                    item.classList.remove('active');
                });

                button.classList.add('active');
                filterMenu();
            });
        });

        // Add-to-cart confirmation popup
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                if (!form.reportValidity()) return;

                const itemName =
                    form.closest('.food-card')?.querySelector('h3')?.textContent.trim()
                    || 'this item';

                const submitButton = form.querySelector('button[type="submit"]');

                Swal.fire({
                    title: 'Add to Cart?',
                    text: `Would you like to add ${itemName} to your cart?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#b45325',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, add it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then(result => {
                    if (result.isConfirmed) {
                        submitButton.disabled = true;
                        submitButton.textContent = 'Adding...';
                        form.submit();
                    }
                });
            });
        });

        // Display Laravel session messages as SweetAlert popups
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage =
                document.getElementById('cart-success-message')?.textContent.trim();

            const errorMessage =
                document.getElementById('cart-error-message')?.textContent.trim();

            const validationContainer =
                document.getElementById('cart-validation-errors');

            const validationErrors = validationContainer
                ? Array.from(validationContainer.querySelectorAll('div'))
                    .map(el => el.textContent.trim())
                    .filter(Boolean)
                : [];

            if (successMessage) {
                Swal.fire({
                    title: 'Added to Cart!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonColor: '#b45325',
                    confirmButtonText: 'Continue Shopping'
                });
            } else if (errorMessage) {
                Swal.fire({
                    title: 'Unable to Add Item',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonColor: '#b45325'
                });
            } else if (validationErrors.length) {
                Swal.fire({
                    title: 'Please Check Your Input',
                    html: validationErrors.map(message =>
                        `<div>${escapeHtml(message)}</div>`
                    ).join(''),
                    icon: 'warning',
                    confirmButtonColor: '#b45325'
                });
            }
        });

        function escapeHtml(value) {
            const element = document.createElement('div');
            element.textContent = value;
            return element.innerHTML;
        }
    </script>

</body>
</html>
