@extends('layouts.app')

@section('title', $blog->name . ' - Atico India')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}">Blog</a>
                <span>/</span>
                <span>{{ $blog->name }}</span>
            </nav>
            <h1>{{ $blog->name }}</h1>
        </div>
    </div>
@endsection

@section('content')
    @php
        $image = (string) ($blog->image ?? '');
        $path = str_starts_with($image, 'http')
            ? $image
            : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/'));
    @endphp

    <section class="inner-page">
        <div class="content-with-sidebar content-with-sidebar--catalog">
            <article class="blog-detail">
                <p class="blog-detail-meta muted">{{ optional($blog->created_at)->format('M d, Y') }}</p>

                @if ($image !== '')
                    <div class="blog-detail-image">
                        <img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}" loading="lazy">
                    </div>
                @endif

                <div class="blog-detail-body card">
                    {!! $blog->description !!}
                </div>
            </article>

            @include('partials.blog-sidebar')
        </div>
    </section>
@endsection
