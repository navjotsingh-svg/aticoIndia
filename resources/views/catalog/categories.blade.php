@extends('layouts.app')

@section('title', 'Categories - Atico India')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Categories</span>
            </nav>
            <h1>Categories</h1>
        </div>
    </div>
@endsection

@section('content')
    <section class="inner-page">
        <div class="content-with-sidebar content-with-sidebar--catalog">
            <div>
                <p class="category-lead">
                    If you are a college or university looking to setup a complete lab, please contact us with your details for a custom quotation.
                </p>
                <div class="category-grid category-grid--all">
                    @forelse ($categories as $category)
                        @php
                            $image = (string) ($category->image ?? '');
                            $imagePath = $image !== ''
                                ? asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/'))
                                : asset('assets/frontend/images/no_product.png');
                        @endphp
                        <article class="category-card category-card--media">
                            <a href="{{ route('category.show', $category->slug) }}" class="category-card-media">
                                <img
                                    src="{{ $imagePath }}"
                                    alt="{{ $category->img_alt ?? $category->name }}"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/frontend/images/no_product.png') }}';"
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
                        <div class="card">No categories found.</div>
                    @endforelse
                </div>
            </div>
            @include('partials.catalog-sidebar')
        </div>
    </section>
@endsection
