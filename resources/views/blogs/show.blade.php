
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $blog->title }}</title>
    <meta name="description" content="{{ $blog->short_description }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --bg: #faf8f5;
            --surface: #ffffff;
            --text: #29251f;
            --muted: #746e66;
            --accent: #a64b2a;
            --border: #e9e2d9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Navigation */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .navbar-brand {
            color: var(--text);
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .navbar-brand:hover {
            color: var(--accent);
        }

        .home-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .home-link:hover {
            color: var(--accent);
        }

        /* Article */
        .article {
            max-width: 900px;
            margin: 0 auto;
            padding: 48px 24px 80px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            padding: 10px 16px;
            color: var(--text);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: var(--accent);
            border-color: var(--accent);
            transform: translateX(-2px);
        }

        .article-header {
            margin-bottom: 30px;
        }

        .article-title {
            margin: 0 0 20px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.1rem, 5vw, 3.5rem);
            font-weight: 700;
            line-height: 1.18;
            letter-spacing: -1.2px;
            overflow-wrap: anywhere;
        }

        .article-description {
            max-width: 760px;
            margin: 0;
            color: var(--muted);
            font-size: clamp(1.05rem, 2vw, 1.25rem);
            line-height: 1.8;
        }

        /* Cover image */
        .cover-wrapper {
            margin: 30px 0 38px;
            overflow: hidden;
            background: #eee7df;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(45, 35, 25, 0.08);
        }

        .cover {
            display: block;
            width: 100%;
            max-height: 500px;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        /* Content */
        .article-content {
            padding: 0 4px;
            color: #403a33;
            font-size: 1.08rem;
            line-height: 2;
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-footer {
            margin-top: 45px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .footer-note {
            margin: 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .article {
                padding: 28px 18px 50px;
            }

            .back-link {
                margin-bottom: 24px;
            }

            .article-title {
                letter-spacing: -0.6px;
            }

            .cover-wrapper {
                margin: 24px 0 28px;
                border-radius: 12px;
            }

            .cover {
                aspect-ratio: 4 / 3;
                max-height: 360px;
            }

            .article-content {
                padding: 0;
                font-size: 1rem;
                line-height: 1.85;
            }
        }
    </style>
</head>

<body>

    <nav class="topbar">
        <div class="container py-3 d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-decoration-none"
               href="{{ route('blogs.index') }}">
                Restaurant Journal
            </a>

            <a class="home-link" href="{{ url('/') }}">
                Home &rarr;
            </a>
        </div>
    </nav>

    <main class="article">

        <a href="{{ route('blogs.index') }}" class="back-link">
            &larr; All Blogs
        </a>

        <header class="article-header">
            <h1 class="article-title">{{ $blog->title }}</h1>

            @if($blog->short_description)
                <p class="article-description">
                    {{ $blog->short_description }}
                </p>
            @endif
        </header>

        @if($blog->image)
            <div class="cover-wrapper">
                <img
                    class="cover"
                    src="{{ asset('storage/'.$blog->image) }}"
                    alt="{{ $blog->title }}"
                    fetchpriority="high"
                >
            </div>
        @endif

        <article class="article-content">{{ $blog->content }}</article>

        <footer class="article-footer">
            <p class="footer-note">
                Thank you for reading. Explore more stories from our restaurant.
            </p>

            <a href="{{ route('blogs.index') }}"
               class="btn btn-dark mt-3">
                Explore More Blogs
            </a>
        </footer>

    </main>

</body>
</html>
