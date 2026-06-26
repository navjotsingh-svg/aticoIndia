@extends('layouts.app')

@section('content')
    <section class="inner-page">
        <div class="content-with-sidebar">
            <div>
                <h1 class="section-title">Products</h1>
                <form class="list-search" method="get" action="{{ route('products.index') }}">
                    <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search products">
                    <button type="submit">Search</button>
                </form>
                <div class="grid">
                    @forelse ($products as $product)
                        <div class="card">
                            @php
                                $image = (string) ($product->image ?? '');
                                $path = str_starts_with($image, 'http')
                                    ? $image
                                    : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/'));
                            @endphp
                            @if ($image !== '')
                                <img src="{{ $path }}" alt="{{ $product->img_alt ?? $product->name }}">
                            @endif
                            <strong>{{ $product->name }}</strong>
                            <div class="muted">{{ $product->product_code }}</div>
                            @if ($product->slug)
                                <a href="{{ route('products.show', $product->slug) }}">View Details</a>
                            @endif
                        </div>
                    @empty
                        <div class="card">No products found.</div>
                    @endforelse
                </div>
                <div class="pagination-wrap">{{ $products->links() }}</div>
            </div>
            <aside class="sidebar-card">
                <h3 class="sidebar-title">Product Catalog</h3>
                <ul class="sidebar-list">
                    @foreach($menuCategories as $cat)
                        <li><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->short_name ?: $cat->name }}</a></li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </section>
@endsection
