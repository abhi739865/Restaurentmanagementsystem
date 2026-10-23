
@extends('layouts.blog')

@section('title', 'Restaurant Blog')

@push('styles')
<style>
    .blog-page {
        padding: 10px 0 35px;
    }

    .blog-hero {
        background: linear-gradient(135deg, #29231f, #594538);
        color: #fff;
        padding: 65px 20px;
        border-radius: 16px;
        margin-bottom: 40px;
        text-align: center;
    }

    .blog-hero h1 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        margin-bottom: 14px;
    }

    .blog-hero p {
        color: #eee4dc;
        font-size: 1.05rem;
        margin-bottom: 0;
    }

    .blog-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        height: 100%;
        background: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(41, 35, 31, 0.12) !important;
    }

    .blog-image {
        height: 230px;
        width: 100%;
        object-fit: cover;
    }

    .blog-image-placeholder {
        height: 230px;
        background: #e9dfd5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c5848;
        font-size: 3rem;
    }

    .blog-card .card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .blog-card h2 {
        color: #29231f;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .blog-description {
        color: #6b625c;
        line-height: 1.7;
        flex-grow: 1;
    }

    .blog-read-more {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 18px;
        background: #29231f;
        color: #fff;
        text-decoration: none;
        border-radius: 7px;
        transition: background 0.2s ease;
    }

    .blog-read-more:hover {
        background: #594538;
        color: #fff;
    }

    .blog-empty {
        background: #fff;
        border-radius: 14px;
        padding: 50px 20px;
    }

    .blog-back-home {
        display: inline-block;
        margin-top: 30px;
        padding: 11px 20px;
        background: #29231f;
        color: #fff;
        text-decoration: none;
        border-radius: 7px;
    }

    .blog-back-home:hover {
        background: #594538;
        color: #fff;
    }

    .blog-pagination {
        margin-top: 30px;
    }
</style>
@endpush

@section('content')
<div class="blog-page">

    <header class="blog-hero">
        <h1>Our Restaurant Stories</h1>
        <p>
            Discover our food, kitchen, recipes and dining experience.
        </p>
    </header>

    <section aria-label="Restaurant blog posts">
        <div class="row g-4">

            @forelse($blogs as $blog)
                <div class="col-sm-6 col-lg-4">
                    <article class="card blog-card shadow-sm">

                        @if($blog->image)
                            <img
                                class="blog-image"
                                src="{{ asset('storage/' . $blog->image) }}"
                                alt="{{ $blog->title }}"
                                loading="lazy"
                            >
                        @else
                            <div class="blog-image-placeholder">
                                <span aria-hidden="true">🍽️</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h2 class="mb-3">
                                {{ $blog->title }}
                            </h2>

                            <p class="blog-description mb-3">
                                {{ $blog->short_description }}
                            </p>

                            <a
                                href="{{ route('blogs.show', $blog->slug) }}"
                                class="blog-read-more"
                            >
                                Read More →
                            </a>
                        </div>

                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="blog-empty text-center shadow-sm">
                        <h2 class="h4 fw-bold">No published blogs yet</h2>
                        <p class="text-muted mb-0">
                            Our restaurant stories will appear here soon.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>
    </section>

    @if($blogs->hasPages())
        <div class="blog-pagination">
            {{ $blogs->links() }}
        </div>
    @endif

    <a href="{{ url('/') }}" class="blog-back-home">
        ← Back to Home
    </a>

</div>
@endsection
