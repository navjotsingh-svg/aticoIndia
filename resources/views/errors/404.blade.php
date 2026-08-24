@extends('layouts.app')

@section('title', 'Page Not Found - Atico India')
@section('meta_description', 'The page you are looking for could not be found. Search our lab equipment catalog or browse categories at Atico India.')

@section('full_width')
@endsection

@section('content')
    <section class="error-hero">
        <div class="container error-hero-inner">
            <nav class="error-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Page Not Found</span>
            </nav>
            <div class="error-hero-copy">
                <span class="error-code" aria-hidden="true">404</span>
                <h1>This page could not be found</h1>
                <p class="error-lead">
                    The link may be outdated or the page may have moved. Search our catalog or explore popular lab equipment categories below.
                </p>
                <form class="error-search" method="get" action="{{ route('products.index') }}">
                    <label class="sr-only" for="errorSearch">Search products</label>
                    <input
                        id="errorSearch"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search lab equipment, microscopes, physics kits..."
                        autofocus
                    >
                    <button type="submit" class="btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Search
                    </button>
                </form>
                <div class="error-hero-actions">
                    <a href="{{ route('home') }}" class="btn btn-outline-light">Back to Home</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-light">Browse Categories</a>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($groups) && count($groups))
        <section class="section section-muted error-categories">
            <div class="container">
                <div class="section-head section-head-center">
                    <p class="section-eyebrow">Explore Our Range</p>
                    <h2>Popular <strong>Categories</strong></h2>
                </div>
                <div class="home-category-showcase error-category-showcase">
                    @foreach ($groups->take(6) as $group)
                        <article class="home-category-block card-panel">
                            <h3>
                                <a href="{{ groupMenuUrl($group) }}">{!! $group->name !!}</a>
                            </h3>
                            @if (!empty($group->categories) && count($group->categories))
                                <ul>
                                    @foreach ($group->categories->take(4) as $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}">
                                                {{ $category->short_name ?: $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ groupMenuUrl($group) }}" class="home-category-more">View all</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($featuredCategories) && count($featuredCategories))
        <section class="section error-featured">
            <div class="container">
                <div class="section-head">
                    <h2>Featured <strong>Categories</strong></h2>
                    <a href="{{ route('categories.index') }}" class="link-more">View all</a>
                </div>
                <div class="home-featured-grid">
                    @foreach ($featuredCategories->take(8) as $category)
                        @php
                            $image = (string) ($category->image ?? '');
                            $path = $image !== ''
                                ? mediaUrl(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image)
                                : mediaUrl('assets/frontend/images/no_product.png');
                        @endphp
                        <a href="{{ route('category.show', $category->slug) }}" class="home-featured-card">
                            <div class="home-featured-card-img">
                                <img src="{{ $path }}" alt="{{ $category->img_alt ?? $category->name }}" loading="lazy" onerror="this.src='{{ asset('assets/frontend/images/no_product.png') }}'">
                            </div>
                            <h3>{{ $category->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="error-cta-band">
        <div class="container error-cta-band-inner">
            <div>
                <p class="section-eyebrow">Need a quotation?</p>
                <h2>Get a free quote for lab equipment</h2>
                <p>Share your requirements and our team will respond with pricing, availability, and export support.</p>
            </div>
            <div class="error-cta-band-actions">
                <button type="button" class="btn btn-light" data-open-enquiry-modal>Request a Quote</button>
                <a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
            </div>
        </div>
    </section>
@endsection
