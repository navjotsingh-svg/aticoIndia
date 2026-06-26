@extends('layouts.app')

@section('title', $category->name . ' - Atico India')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('categories.index') }}">Categories</a>
                <span>/</span>
                <span>{{ $category->name }}</span>
            </nav>
            <h1>{{ $category->name }}</h1>
        </div>
    </div>
@endsection

@section('content')
    @php
        $categoryImage = (string) ($category->image ?? '');
        $categoryImagePath = $categoryImage !== ''
            ? asset(ltrim(str_contains($categoryImage, '/') ? $categoryImage : 'uploads/product_images/' . $categoryImage, '/'))
            : asset('assets/frontend/images/no_product.png');
        $noImage = asset('assets/frontend/images/no_product.png');
    @endphp
    <section class="inner-page">
        <div class="content-with-sidebar content-with-sidebar--catalog">
            <div class="catalog-main">
                <p class="results-copy">
                    Showing {{ $childCategories->count() > 0 ? $childCategories->count() : $products->total() }}
                    result{{ ($childCategories->count() > 0 ? $childCategories->count() : $products->total()) === 1 ? '' : 's' }}
                    for <strong>"{{ $category->name }}"</strong>
                </p>

                @if(!empty($category->description) || $categoryImage !== '')
                    <div class="category-img-desc">
                        @if($categoryImage !== '')
                            <img
                                src="{{ $categoryImagePath }}"
                                alt="{{ $category->img_alt ?? $category->name }}"
                                width="362"
                                height="262"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ $noImage }}';"
                            >
                        @endif
                        @if(!empty($category->description))
                            <div class="category-img-desc-text">{!! $category->description !!}</div>
                        @endif
                        <p class="category-img-desc-note">
                            If you are a college or university looking to setup a complete lab, please contact us with your details for a custom quotation.
                        </p>
                    </div>
                @endif

                <form class="list-search" method="get" action="{{ route('category.show', $category->slug) }}">
                    <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search in this category">
                    <button type="submit"><i class="fa fa-search"></i> Search</button>
                </form>

                @if($childCategories->isNotEmpty())
                    <div class="catalog-product-grid">
                        @foreach($childCategories as $child)
                            @php
                                $childImage = (string) ($child->image ?? '');
                                $childImagePath = $childImage !== ''
                                    ? asset(ltrim(str_contains($childImage, '/') ? $childImage : 'uploads/product_images/' . $childImage, '/'))
                                    : $noImage;
                                $childUrl = route('category.show', $child->slug);
                            @endphp
                            <article class="catalog-product-card">
                                <a href="{{ $childUrl }}" class="catalog-product-card-img">
                                    <img
                                        src="{{ $childImagePath }}"
                                        alt="{{ $child->img_alt ?? $child->name }}"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $noImage }}';"
                                    >
                                </a>
                                <div class="catalog-product-card-body">
                                    <h3><a href="{{ $childUrl }}">{{ $child->short_name ?: $child->name }}</a></h3>
                                    @if(!empty($child->description))
                                        <p class="muted">{{ \Illuminate\Support\Str::limit(trim(strip_tags($child->description)), 90) }}</p>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="catalog-product-grid">
                        @forelse ($products as $product)
                            @php
                                $productUrl = $product->slug ? route('products.show', $product->slug) : null;
                                $image = (string) ($product->image ?? '');
                                $path = $image !== ''
                                    ? (str_starts_with($image, 'http')
                                        ? $image
                                        : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/')))
                                    : $noImage;
                            @endphp
                            <article class="catalog-product-card">
                                @if ($productUrl)
                                    <a href="{{ $productUrl }}" class="catalog-product-card-img">
                                        <img
                                            src="{{ $path }}"
                                            alt="{{ $product->img_alt ?? $product->name }}"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ $noImage }}';"
                                        >
                                    </a>
                                @else
                                    <div class="catalog-product-card-img">
                                        <img
                                            src="{{ $path }}"
                                            alt="{{ $product->img_alt ?? $product->name }}"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ $noImage }}';"
                                        >
                                    </div>
                                @endif
                                <div class="catalog-product-card-body">
                                    <h3>
                                        @if ($productUrl)
                                            <a href="{{ $productUrl }}">{{ $product->name }}</a>
                                        @else
                                            {{ $product->name }}
                                        @endif
                                    </h3>
                                    @if(!empty($product->description))
                                        <p class="muted">{{ \Illuminate\Support\Str::limit(trim(strip_tags($product->description)), 90) }}</p>
                                    @elseif(!empty($product->product_code))
                                        <p class="muted">{{ $product->product_code }}</p>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="catalog-empty">No products found in this category.</div>
                        @endforelse
                    </div>
                    <div class="pagination-wrap">{{ $products->links() }}</div>
                @endif
            </div>

            @include('partials.catalog-sidebar')
        </div>
    </section>
@endsection

@push('scripts')
<script>
    requestAnimationFrame(() => {
        const active = document.querySelector('.main-menu-header a.is-active, .sub-menu a.is-active');
        active?.scrollIntoView({ inline: 'center', block: 'nearest', behavior: 'smooth' });
    });
</script>
@endpush
