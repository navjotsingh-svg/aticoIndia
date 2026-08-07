@extends('layouts.app')

@section('title', (optional($groupContent)->meta_title ?: ($group->meta_title ?: $group->name)) . ' - Atico India')
@section('meta_description', strip_tags(optional($groupContent)->meta_description ?: ($group->meta_description ?: ($group->name . ' — laboratory equipment categories from Atico India.'))))

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>{{ $group->name }}</span>
            </nav>
            <h1>{{ optional($groupContent)->name ?: $group->name }}</h1>
        </div>
    </div>
@endsection

@section('content')
    @php
        $contentImage = (string) (optional($groupContent)->image ?? $group->image ?? '');
        $contentImagePath = $contentImage !== ''
            ? asset(ltrim(str_contains($contentImage, '/') ? $contentImage : 'uploads/product_images/' . $contentImage, '/'))
            : asset('assets/frontend/images/no_product.png');
        $contentDescription = trim((string) (optional($groupContent)->description ?? ''));
        $noImage = asset('assets/frontend/images/no_product.png');
    @endphp
    <section class="inner-page">
        <div class="content-with-sidebar content-with-sidebar--catalog">
            <div class="catalog-main">
                <p class="results-copy">
                    Showing {{ $categories->count() }}
                    categor{{ $categories->count() === 1 ? 'y' : 'ies' }}
                    in <strong>"{{ $group->name }}"</strong>
                </p>

                @if($contentDescription !== '' || $contentImage !== '')
                    <div class="category-img-desc">
                        @if($contentImage !== '')
                            <img
                                src="{{ $contentImagePath }}"
                                alt="{{ optional($groupContent)->img_alt ?? $group->name }}"
                                width="362"
                                height="262"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ $noImage }}';"
                            >
                        @endif
                        @if($contentDescription !== '')
                            <div class="category-img-desc-text">{!! $contentDescription !!}</div>
                        @elseif(!empty($group->meta_description))
                            <div class="category-img-desc-text">
                                <p>{{ $group->meta_description }}</p>
                            </div>
                        @endif
                        <p class="category-img-desc-note">
                            If you are a college or university looking to setup a complete lab, please contact us with your details for a custom quotation.
                        </p>
                    </div>
                @else
                    <p class="category-lead">
                        If you are a college or university looking to setup a complete lab, please contact us with your details for a custom quotation.
                    </p>
                @endif

                <div class="catalog-section">
                    <h2 class="catalog-section-title">Browse Categories</h2>
                    <div class="category-grid category-grid--all">
                        @forelse ($categories as $category)
                            @php
                                $image = (string) ($category->image ?? '');
                                $imagePath = $image !== ''
                                    ? asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/'))
                                    : $noImage;
                            @endphp
                            <article class="category-card category-card--media">
                                <a href="{{ route('category.show', $category->slug) }}" class="category-card-media">
                                    <img
                                        src="{{ $imagePath }}"
                                        alt="{{ $category->img_alt ?? $category->name }}"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $noImage }}';"
                                    >
                                </a>
                                <div class="category-card-body">
                                    <h3>
                                        <a href="{{ route('category.show', $category->slug) }}">
                                            {{ $category->short_name ?: $category->name }}
                                        </a>
                                    </h3>
                                    @if(!empty($category->description))
                                        <p class="muted">{{ \Illuminate\Support\Str::limit(trim(strip_tags($category->description)), 90) }}</p>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="catalog-empty">No categories found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            @include('partials.catalog-sidebar')
        </div>
    </section>
@endsection
