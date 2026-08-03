@extends('layouts.app')

@section('title', 'Educational Science Lab Equipment Manufacturer, Supplier & Exporter in India')
@section('meta_description', 'Leading educational lab equipment manufacturer in India, supplying high quality scientific, engineering and school lab equipment worldwide.')
@section('canonical', url('/'))

@section('full_width')
@endsection

@section('content')
    <section class="hero">
        <div class="hero-slider">
            @foreach($heroSlides as $index => $slide)
                <div class="hero-slide {{ $index === 0 ? 'is-active' : '' }}">
                    <img src="{{ asset($slide) }}" alt="Atico India — slide {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        <div class="hero-dots">
            @foreach($heroSlides as $index => $slide)
                <button type="button" class="hero-dot {{ $index === 0 ? 'is-active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container intro-grid">
            <div class="intro-main card-panel">
                <h1>Atico India is a Premium Company in the Field of Scientific Lab Equipments Manufacturer, Supplier, and Exporter in India &amp; Worldwide.</h1>
                <p>Atico India is a leading Manufacturer, Supplier, and Exporter of Scientific Lab Equipments. We are nationally and internationally spread across 30 countries with a vast base of clients. Our exceptional customer services, post-purchase services and brand quality are at a peak.</p>
                <p>At Atico India, we are competitive and are constantly growing according to the needs of our customers across the globe.</p>
                <p>We keep on innovating advanced technology to manufacture and supply a safe and latest equipment to our customers. At Atico India, we have the best expertise on board to test the final equipment to provide High-performance equipment to the technicians.</p>
                <h4 class="cta-subtitle">About Us</h4>
                <p>Atico India is a leading Scientific Lab Equipment, Biology Lab equipment, Educational Laboratory Equipment Supplier, offering a wide catalogue of lab Instruments and Equipments in India and worldwide.</p>
                <p>We design and supply lab equipments for schools, colleges, universities, research labs, and private high tech science labs. Atico India manufactures an entire range of lab apparatuses and lab gears.</p>
                <p>At Atico India, we have redefined lab experiments by manufacturing premium quality and user-friendly scientific lab equipments. The quality of your lab depends upon the quality of supplier brand and Atico India is a leading company in India and worldwide.</p>
            </div>
            <aside class="cta-panel card-panel">
                <a href="#">Know More About Company</a>
                <img class="cta-image" src="{{ asset('assets/frontend/images/Welcome-to-atico-section_1.png') }}" alt="Atico India">
            </aside>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Latest <strong>Categories</strong></h2>
                <a href="{{ route('categories.index') }}" class="link-more">View all</a>
            </div>
            <div class="product-grid">
                @forelse ($featuredCategories->take(8) as $category)
                    @php
                        $image = (string) ($category->image ?? '');
                        $path = str_starts_with($image, 'http')
                            ? $image
                            : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/product_images/' . $image, '/'));
                    @endphp
                    <a href="{{ route('category.show', $category->slug) }}" class="product-card">
                        <div class="product-card-img">
                            <img src="{{ $path }}" alt="{{ $category->img_alt ?? $category->name }}" onerror="this.src='{{ asset('assets/frontend/images/no_product.png') }}'">
                        </div>
                        <h3>{{ $category->name }}</h3>
                    </a>
                @empty
                    <p class="muted">No categories found.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Evaluation of the Current Safety</p>
                <h2>We Are the <strong>Trusted Experts</strong></h2>
            </div>
            <div class="feature-grid feature-grid--six">
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-phone"></i></div>
                    <h4>Order Now</h4>
                    <p>Phone: +91-9896793832<br>Email: sales@aticoindia.com</p>
                </div>
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-file-text-o"></i></div>
                    <h4>OEM / Tenders</h4>
                    <p>Bulk Lab Tender Supply and OEM Manufacturers for Educational, Laboratoy, Analytical &amp; Research Lab Products.</p>
                </div>
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-life-ring"></i></div>
                    <h4>Support Team</h4>
                    <p>24×7 Support Team just a call away. Contact Now or fill inquiry form for all your technical/ troubleshooting inquiries.</p>
                </div>
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-cubes"></i></div>
                    <h4>Bulk Orders</h4>
                    <p>Special Discounts on bulk orders. Regular Bulk Orders to over 56 countries worldwide. Reasonably priced, good quality products, impressive packaging and prompt delivery of Consignments.</p>
                </div>
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-truck"></i></div>
                    <h4>Payment &amp; Shipping</h4>
                    <p>We accept Wire or Telegraphic Transfer/ Letter of Credit/ Paypal etc. Shipping is based on your consignment size &amp; other factors, contact for further details.</p>
                </div>
                <div class="feature-box card-panel">
                    <div class="feature-icon"><i class="fa fa-building-o"></i></div>
                    <h4>Dealership</h4>
                    <p>Be a part of our success story and contact to become one of our authorized dealers.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container trust-wrap">
            <div class="card-panel trust-meters">
                <h2>We Are Trusted by <strong>World's Leading Companies</strong></h2>
                <div class="meter"><div class="meter-label"><span>Cost-efficient Lab Equipment</span><span>90%</span></div><div class="meter-bar"><span style="width:90%"></span></div></div>
                <div class="meter"><div class="meter-label"><span>High-quality Lab Equipment</span><span>80%</span></div><div class="meter-bar"><span style="width:80%"></span></div></div>
                <div class="meter"><div class="meter-label"><span>Assured and Tested</span><span>80%</span></div><div class="meter-bar"><span style="width:80%"></span></div></div>
                <div class="meter"><div class="meter-label"><span>Purchase Convenience</span><span>80%</span></div><div class="meter-bar"><span style="width:80%"></span></div></div>
            </div>
            <div class="trust-map card-panel">
                <img src="{{ asset('assets/frontend/images/map-01.png') }}" alt="Atico India global presence map">
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Latest News &amp; <strong>Blogs</strong></h2>
                <a href="{{ route('blog.index') }}" class="link-more">View all</a>
            </div>
            <div class="blog-grid">
                @forelse ($blogs as $blog)
                    @php
                        $image = (string) ($blog->image ?? '');
                        $path = str_starts_with($image, 'http')
                            ? $image
                            : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/'));
                    @endphp
                    <article class="blog-card card-panel">
                        @if ($image !== '')
                            <a href="{{ $blog->slug ? route('blog.show', $blog->slug) : '#' }}"><img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}"></a>
                        @endif
                        <div class="blog-card-body">
                            <div class="blog-meta">{{ optional($blog->created_at)->format('M d, Y') }}</div>
                            @if ($blog->slug)
                                <h3><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->name }}</a></h3>
                            @else
                                <h3>{{ $blog->name }}</h3>
                            @endif
                            @if ($blog->slug)
                                <a class="blog-read-more" href="{{ route('blog.show', $blog->slug) }}">Read more</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="muted">No blogs found.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- <section id="quote" class="section contact-section">
        <div class="container contact-grid contact-grid--quote">
            <div class="contact-intro">
                <h2>Get Your Free Quote</h2>
            </div>
            <form class="contact-form card-panel" method="post" action="{{ route('request-quote.store') }}" enctype="multipart/form-data">
                @csrf
                @include('partials.inquiry-meta')
                <input class="input" name="name" placeholder="Your name" required>
                <input class="input" type="email" name="email" placeholder="Email address">
                <input class="input" name="mobile_no" placeholder="Mobile number">
                <select class="input" name="country">
                    <option value="">Select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                <input class="input" name="product" placeholder="Product interest">
                <textarea name="query" rows="4" placeholder="Your message"></textarea>
                @include('partials.inquiry-attachment')
                <button class="btn btn-block" type="submit">Submit</button>
                <p class="quote-note">If you are a college or university looking to setup a complete lab. Please contact us with your details for custom quotation. <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a></p>
            </form>
        </div>
    </section> -->

    <button type="button" class="enquiry-fab" id="enquiryFab">Send Enquiry</button>
    <div class="enquiry-modal" id="enquiryModal" aria-hidden="true">
        <div class="enquiry-modal-backdrop" data-close-modal="1"></div>
        <div class="enquiry-modal-card">
            <button type="button" class="enquiry-modal-close" id="enquiryModalClose" aria-label="Close">&times;</button>
            <h3>Send Enquiry</h3>
            <p class="muted">Share your requirement and our team will contact you.</p>
            <form method="post" action="{{ route('enquiry.store') }}" enctype="multipart/form-data">
                @csrf
                @include('partials.inquiry-meta')
                <input class="input" name="name" placeholder="Name" required>
                <input class="input" name="email" placeholder="Email">
                <input class="input" name="mobile_no" placeholder="Phone">
                <select class="input" name="country">
                    <option value="">Select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                <textarea name="message" rows="4" placeholder="Message"></textarea>
                @include('partials.inquiry-attachment')
                <button class="btn btn-block" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(() => {
    const slides = [...document.querySelectorAll('.hero-slide')];
    const dots = [...document.querySelectorAll('.hero-dot')];
    if (slides.length < 2) return;
    let i = 0;
    const go = (n) => {
        slides[i].classList.remove('is-active');
        dots[i]?.classList.remove('is-active');
        i = n;
        slides[i].classList.add('is-active');
        dots[i]?.classList.add('is-active');
    };
    setInterval(() => go((i + 1) % slides.length), 5000);
    dots.forEach((d, n) => d.addEventListener('click', () => go(n)));
})();

(() => {
    const modal = document.getElementById('enquiryModal');
    const openBtn = document.getElementById('enquiryFab');
    const closeBtn = document.getElementById('enquiryModalClose');
    if (!modal || !openBtn || !closeBtn) return;
    const open = () => { modal.classList.add('is-open'); document.body.style.overflow = 'hidden'; };
    const close = () => { modal.classList.remove('is-open'); document.body.style.overflow = ''; };
    openBtn.addEventListener('click', open);
    closeBtn.addEventListener('click', close);
    modal.addEventListener('click', e => { if (e.target?.dataset?.closeModal === '1') close(); });
    setTimeout(open, 10000);
})();
</script>
@endpush
