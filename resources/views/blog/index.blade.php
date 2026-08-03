@extends('layouts.app')

@section('content')
    <h1 class="section-title">Blog</h1>
    <div class="grid blog-list-grid">
        @forelse ($blogs as $blog)
            @php
                $image = (string) ($blog->image ?? '');
                $path = str_starts_with($image, 'http')
                    ? $image
                    : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/'));
                $blogUrl = $blog->slug ? route('blog.show', $blog->slug) : null;
            @endphp
            <article class="card blog-list-card">
                @if ($image !== '')
                    @if ($blogUrl)
                        <a href="{{ $blogUrl }}" class="card-media-link">
                            <img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}">
                        </a>
                    @else
                        <img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}">
                    @endif
                @endif
                <strong>
                    @if ($blogUrl)
                        <a href="{{ $blogUrl }}" class="card-title-link">{{ $blog->name }}</a>
                    @else
                        {{ $blog->name }}
                    @endif
                </strong>
                <div class="muted">{{ optional($blog->created_at)->format('M d, Y') }}</div>
                @if ($blogUrl)
                    <a href="{{ $blogUrl }}">Read More</a>
                @endif
            </article>
        @empty
            <div class="card">No blog posts found.</div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $blogs->links() }}
    </div>
@endsection
