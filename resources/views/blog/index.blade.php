@extends('layouts.app')

@section('content')
    <h1 class="section-title">Blog</h1>
    <div class="grid">
        @forelse ($blogs as $blog)
            <div class="card">
                @php
                    $image = (string) ($blog->image ?? '');
                    $path = str_starts_with($image, 'http')
                        ? $image
                        : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/'));
                @endphp
                @if ($image !== '')
                    <img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}">
                @endif
                <strong>{{ $blog->name }}</strong>
                <div class="muted">{{ optional($blog->created_at)->format('M d, Y') }}</div>
                @if ($blog->slug)
                    <a href="{{ route('blog.show', $blog->slug) }}">Read More</a>
                @endif
            </div>
        @empty
            <div class="card">No blog posts found.</div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $blogs->links() }}
    </div>
@endsection
