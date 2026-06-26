@extends('layouts.app')

@section('title', $product->name . ' - Atico India')

@section('body_class')
page-catalog
@endsection

@section('page_head')
    <div class="page-head">
        <div class="container">
            <nav class="page-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>{{ $product->name }}</span>
            </nav>
            <h1>{{ $product->name }}</h1>
        </div>
    </div>
@endsection

@section('content')
    @php
        $image = (string) ($product->image ?? '');
        $imagePath = $image !== ''
            ? (str_starts_with($image, 'http')
                ? $image
                : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/')))
            : asset('assets/frontend/images/no_product.png');
        $noImage = asset('assets/frontend/images/no_product.png');
        $productCategories = getAllProductCats($product->id);
        $relatedProducts = getRelatedProducts($product->id);
        $trustBadges = [
            ['src' => asset('assets/frontend/images/ISO-certified.png'), 'alt' => 'ISO Certified'],
            ['src' => asset('assets/frontend/images/24X7-Support.png'), 'alt' => '24x7 Support'],
            ['src' => asset('assets/frontend/images/High-Quality.png'), 'alt' => 'High Quality'],
            ['src' => asset('assets/frontend/images/after-sales-service.png'), 'alt' => 'After Sales Service'],
        ];
    @endphp

    <section class="inner-page">
        <div class="content-with-sidebar content-with-sidebar--catalog">
            <div class="product-page">
                <nav class="product-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>{{ $product->name }}</span>
                </nav>

                <div class="product-detail-top">
                    <div class="product-detail-gallery">
                        <img
                            src="{{ $imagePath }}"
                            alt="{{ $product->img_alt ?? $product->name }}"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ $noImage }}';"
                        >
                    </div>

                    <div class="product-detail-summary">
                        <h2 class="product-detail-title">{{ $product->name }}</h2>

                        @if($productCategories->isNotEmpty())
                            <p class="product-detail-cats">
                                <span>Categories:</span>
                                @foreach($productCategories as $cat)
                                    <a href="{{ route('category.show', $cat->slug) }}">{{ $cat->short_name ?: $cat->name }}</a>@if(!$loop->last), @endif
                                @endforeach
                            </p>
                        @endif

                        <hr class="product-detail-divider">

                        @if(!empty($product->description))
                            <div class="product-detail-excerpt">
                                {{ \Illuminate\Support\Str::limit(trim(strip_tags($product->description)), 200) }}
                            </div>
                        @endif

                        @if(!empty($product->product_code))
                            <p class="product-detail-code">
                                Product Code: <strong>{{ $product->product_code }}</strong>
                            </p>
                        @endif

                        <ul class="product-detail-icons">
                            @foreach($trustBadges as $badge)
                                <li>
                                    <img src="{{ $badge['src'] }}" alt="{{ $badge['alt'] }}" loading="lazy" onerror="this.parentElement.style.display='none'">
                                </li>
                            @endforeach
                        </ul>

                        <div class="product-detail-actions">
                            <ul class="product-detail-btns">
                                <li>
                                    <button type="button" class="btn btn-buy" data-open-product-query>Buy This Product</button>
                                </li>
                                <li>
                                    <a href="#product-about" class="product-detail-btn-link" data-product-tab-trigger="about">About this product</a>
                                </li>
                                <li>
                                    <a href="#related-prod" class="product-detail-btn-link" data-product-tab-trigger="related">Related Products</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="product-detail-tabs-wrap" id="product-detail-tabs">
                    <ul class="product-detail-tabs" role="tablist">
                        <li>
                            <button type="button" class="product-detail-tab is-active" data-product-tab="about" aria-selected="true">
                                About this product
                            </button>
                        </li>
                        <li>
                            <button type="button" class="product-detail-tab" data-product-tab="related" aria-selected="false">
                                Related Products
                            </button>
                        </li>
                    </ul>

                    <div class="product-detail-panels">
                        <section
                            id="product-about"
                            class="product-detail-panel is-active"
                            data-product-panel="about"
                            role="tabpanel"
                        >
                            <div class="product-section-head">
                                <span class="product-section-eyebrow">Product</span>
                                <h3>About this product</h3>
                            </div>
                            <div class="product-detail-body">
                                @if(!empty($product->description))
                                    {!! $product->description !!}
                                @else
                                    <p class="muted">Detailed description is not available for this product yet.</p>
                                @endif
                            </div>
                        </section>

                        <section
                            id="related-prod"
                            class="product-detail-panel"
                            data-product-panel="related"
                            role="tabpanel"
                            hidden
                        >
                            <div class="product-section-head">
                                <span class="product-section-eyebrow">Related</span>
                                <h3>Related Products</h3>
                            </div>

                            @if($relatedProducts->isNotEmpty())
                                <div class="catalog-product-grid">
                                    @foreach($relatedProducts as $related)
                                        @php
                                            $relatedImage = (string) ($related->image ?? '');
                                            $relatedImagePath = $relatedImage !== ''
                                                ? asset(ltrim(str_contains($relatedImage, '/') ? $relatedImage : 'uploads/product_images/' . $relatedImage, '/'))
                                                : $noImage;
                                            $relatedUrl = route('products.show', $related->slug);
                                        @endphp
                                        <article class="catalog-product-card">
                                            <a href="{{ $relatedUrl }}" class="catalog-product-card-img">
                                                <img
                                                    src="{{ $relatedImagePath }}"
                                                    alt="{{ $related->img_alt ?? $related->name }}"
                                                    loading="lazy"
                                                    onerror="this.onerror=null;this.src='{{ $noImage }}';"
                                                >
                                            </a>
                                            <div class="catalog-product-card-body">
                                                <h3><a href="{{ $relatedUrl }}">{{ $related->name }}</a></h3>
                                                @if(!empty($related->description))
                                                    <p class="muted">{{ \Illuminate\Support\Str::limit(trim(strip_tags($related->description)), 90) }}</p>
                                                @endif
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <div class="product-related-empty">No related products found for this item.</div>
                            @endif
                        </section>
                    </div>
                </div>
            </div>

            <aside class="sidebar-card catalog-sidebar product-sidebar">
                <h3 class="sidebar-title sidebar-title--enquiry">Send Enquiry</h3>
                <form class="sidebar-form" method="post" action="{{ route('product-query.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('partials.inquiry-meta')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input class="input" name="name" placeholder="Your Name" required value="{{ old('name') }}">
                    <input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                    <input class="input" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
                    @include('partials.inquiry-country')
                    <input class="input" name="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
                    <textarea name="message" rows="3" placeholder="Your message">{{ old('message') }}</textarea>
                    @include('partials.inquiry-attachment')
                    @include('partials.inquiry-recaptcha')
                    <button class="btn" type="submit">Submit</button>
                </form>

                @include('partials.sidebar-categories')
            </aside>
        </div>
    </section>

    @include('partials.product-query-modal')
@endsection

@push('scripts')
<script>
    (() => {
        const wrap = document.getElementById('product-detail-tabs');
        if (!wrap) return;

        const tabs = wrap.querySelectorAll('[data-product-tab]');
        const panels = wrap.querySelectorAll('[data-product-panel]');
        const triggers = document.querySelectorAll('[data-product-tab-trigger]');

        const activate = (name) => {
            tabs.forEach((tab) => {
                const active = tab.getAttribute('data-product-tab') === name;
                tab.classList.toggle('is-active', active);
                tab.setAttribute('aria-selected', active ? 'true' : 'false');
            });

            panels.forEach((panel) => {
                const active = panel.getAttribute('data-product-panel') === name;
                panel.classList.toggle('is-active', active);
                panel.hidden = !active;
            });
        };

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                activate(tab.getAttribute('data-product-tab'));
            });
        });

        triggers.forEach((trigger) => {
            trigger.addEventListener('click', (event) => {
                event.preventDefault();
                const name = trigger.getAttribute('data-product-tab-trigger');
                if (!name) return;
                activate(name);
                wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    })();
</script>
@endpush
