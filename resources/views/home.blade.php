@extends('layouts.app')

@section('title', 'Educational Science Lab Equipment Manufacturer, Supplier & Exporter in India')
@section('meta_description', 'Leading educational lab equipment manufacturer in India, supplying high quality scientific, engineering and school lab equipment worldwide.')
@section('canonical', url('/'))

@section('body_class')
page-home
@endsection

@section('full_width')
@endsection

@section('content')
    <section class="home-industry-hero" aria-label="Industries we serve">
        <div class="home-industry-slider">
            @foreach ($industrySlides as $index => $slide)
                @php
                    $image = mediaUrl($slide['image']);
                @endphp
                <div class="home-industry-slide {{ $index === 0 ? 'is-active' : '' }}" style="--slide-image: url('{{ $image }}')">
                    <div class="container home-industry-slide-inner">
                        <div class="home-industry-caption">
                            <h2>
                                <span>{{ $slide['title'] }}</span>
                                <strong>{{ $slide['subtitle'] }}</strong>
                            </h2>
                            <p>{{ $slide['description'] }}</p>
                            <a href="{{ $slide['url'] }}" class="btn btn-light">Our Industries</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="home-industry-controls">
            <button type="button" class="home-industry-arrow home-industry-arrow--prev" aria-label="Previous slide">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="home-industry-dots">
                @foreach ($industrySlides as $index => $slide)
                    <button type="button" class="home-industry-dot {{ $index === 0 ? 'is-active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <button type="button" class="home-industry-arrow home-industry-arrow--next" aria-label="Next slide">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
    </section>

    <section class="home-quick-actions" aria-label="Quick links">
        <div class="container home-quick-actions-grid">
            <a href="{{ route('lab-tenders') }}" class="home-quick-action">
                <span class="home-quick-action-icon"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                <span class="home-quick-action-text">
                    <strong>OEM &amp; Tenders</strong>
                    <small>Get A Quote</small>
                </span>
            </a>
            <button type="button" class="home-quick-action" data-open-enquiry-modal>
                <span class="home-quick-action-icon"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
                <span class="home-quick-action-text">
                    <strong>Dealership</strong>
                    <small>Request Now!</small>
                </span>
            </button>
            <a href="tel:+919896793832" class="home-quick-action">
                <span class="home-quick-action-icon"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                <span class="home-quick-action-text">
                    <strong>Support Team</strong>
                    <small>+91-9896793832</small>
                </span>
            </a>
            <a href="{{ route('contact') }}" class="home-quick-action">
                <span class="home-quick-action-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <span class="home-quick-action-text">
                    <strong>Contact Us</strong>
                    <small>Email to Sales</small>
                </span>
            </a>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Latest <strong>Categories</strong></h2>
                <a href="{{ route('categories.index') }}" class="link-more">View all</a>
            </div>
            <div class="home-featured-grid">
                @forelse ($featuredCategories->take(8) as $category)
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
                @empty
                    <p class="muted">No categories found.</p>
                @endforelse
            </div>
        </div>
    </section>

    @if (!empty($groups) && count($groups))
        <section class="section home-category-showcase-section">
            <div class="container">
                <div class="section-head section-head-center">
                    <p class="section-eyebrow">Product Range</p>
                    <h2>Our <strong>Category</strong></h2>
                </div>
                <div class="home-category-showcase">
                    @foreach ($groups->take(4) as $group)
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

    <section class="home-about-section">
        <div class="home-about-bg" aria-hidden="true"></div>
        <div class="container">
            <div class="home-about-shell">
                <div class="home-about-content">
                    <span class="home-about-badge">About Atico India</span>
                    <h2 class="home-about-title">
                        Atico India is a <span class="text-accent">Premium Company</span> in the Field of
                        <span class="text-primary">Scientific Lab Equipments</span> Manufacturer, Supplier, and Exporter in India &amp; Worldwide.
                    </h2>
                    <p class="home-about-lead">Atico India is a leading Manufacturer, Supplier, and Exporter of Scientific Lab Equipments. We are nationally and internationally spread across 30 countries with a vast base of clients. Our exceptional customer services, post-purchase services and brand quality are at a peak.</p>

                    <ul class="home-about-highlights">
                        <li><i class="fa fa-globe" aria-hidden="true"></i><span><strong>30+ countries</strong> with a vast global client base</span></li>
                        <li><i class="fa fa-flask" aria-hidden="true"></i><span><strong>Premium quality</strong> scientific and educational lab equipment</span></li>
                        <li><i class="fa fa-cogs" aria-hidden="true"></i><span><strong>Advanced technology</strong> with expert-tested final products</span></li>
                    </ul>

                    <div class="home-about-details" id="home-about-more">
                        <p>At Atico India, we are competitive and are constantly growing according to the needs of our customers across the globe.</p>
                        <p>We keep on innovating advanced technology to manufacture and supply a safe and latest equipment to our customers. At Atico India, we have the best expertise on board to test the final equipment to provide High-performance equipment to the technicians.</p>
                        <h4>About Us</h4>
                        <p>Atico India is a leading Scientific Lab Equipment, Biology Lab equipment, Educational Laboratory Equipment Supplier, offering a wide catalogue of lab Instruments and Equipments in India and worldwide.</p>
                        <p>We design and supply lab equipments for schools, colleges, universities, research labs, and private high tech science labs. Atico India manufactures an entire range of lab apparatuses and lab gears.</p>
                        <p>At Atico India, we have redefined lab experiments by manufacturing premium quality and user-friendly scientific lab equipments. The quality of your lab depends upon the quality of supplier brand and Atico India is a leading company in India and worldwide.</p>
                    </div>

                    <div class="home-about-actions">
                        <button type="button" class="btn home-about-toggle" data-about-toggle aria-expanded="false">Read more</button>
                        <a href="{{ route('about') }}" class="btn btn-outline-dark">Know More About Company</a>
                    </div>
                </div>

                <div class="home-about-visual">
                    <div class="home-about-image-wrap">
                        <div class="home-about-image-accent" aria-hidden="true"></div>
                        <img
                            class="home-about-image"
                            src="{{ asset('assets/frontend/images/microscope-2-Image1.webp') }}"
                            alt="Scientific laboratory equipment by Atico India"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('assets/frontend/images/Bio-2-Image1.webp') }}';"
                        >
                        <div class="home-about-image-badge">
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            <span>Trusted Lab Equipment Manufacturer</span>
                        </div>
                    </div>

                    <div class="home-about-float-card home-about-float-card--top">
                        <strong>30+</strong>
                        <span>Countries Served</span>
                    </div>
                    <div class="home-about-float-card home-about-float-card--bottom">
                        <strong>56+</strong>
                        <span>Export Destinations</span>
                    </div>

                    <div class="home-about-cert-strip" aria-label="Certifications">
                        <img src="{{ asset('assets/frontend/images/certificates/ISO-9001.webp') }}" alt="ISO 9001" loading="lazy">
                        <img src="{{ asset('assets/frontend/images/certificates/WHO-GMP.webp') }}" alt="WHO GMP" loading="lazy">
                        <img src="{{ asset('assets/frontend/images/certificates/ISO-14001.webp') }}" alt="ISO 14001" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-stats" aria-label="Company highlights">
        <div class="container home-stats-grid">
            <div class="home-stat">
                <strong>30+</strong>
                <span>Countries Served</span>
            </div>
            <div class="home-stat">
                <strong>56+</strong>
                <span>Export Destinations</span>
            </div>
            <div class="home-stat">
                <strong>Premium</strong>
                <span>Lab Equipment Quality</span>
            </div>
            <div class="home-stat">
                <strong>Trusted</strong>
                <span>Manufacturer &amp; Exporter</span>
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
                <img src="{{ asset('assets/frontend/images/map-01.png') }}" alt="Atico India global presence map" loading="lazy">
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
                        $path = $image !== ''
                            ? (str_starts_with($image, 'http')
                                ? $image
                                : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/')))
                            : '';
                    @endphp
                    <article class="blog-card card-panel">
                        @if ($path !== '')
                            <a href="{{ $blog->slug ? route('blog.show', $blog->slug) : '#' }}"><img src="{{ $path }}" alt="{{ $blog->img_alt ?? $blog->name }}" loading="lazy"></a>
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

    <section class="home-contact-cta">
        <div class="container home-contact-cta-inner">
            <div>
                <p class="section-eyebrow">Let's Talk Business!</p>
                <h2>Please take a quick moment to complete our enquiry form and a business representative will get back to you swiftly.</h2>
                <p>If you are a college or university looking to setup a complete lab, please contact us with your details for custom quotation. <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a></p>
            </div>
            <div class="home-contact-cta-actions">
                <button type="button" class="btn btn-light" data-open-enquiry-modal>Send Enquiry</button>
                <a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
            </div>
        </div>
    </section>

    <button type="button" class="enquiry-fab" id="enquiryFab" aria-label="Send enquiry">
        <i class="fa fa-commenting-o" aria-hidden="true"></i>
        <span>Send Enquiry</span>
    </button>
@endsection

@push('scripts')
<script>
(() => {
    const slides = [...document.querySelectorAll('.home-industry-slide')];
    const dots = [...document.querySelectorAll('.home-industry-dot')];
    const prev = document.querySelector('.home-industry-arrow--prev');
    const next = document.querySelector('.home-industry-arrow--next');
    let index = 0;
    let timer;

    const go = (nextIndex) => {
        if (!slides.length) return;
        slides[index]?.classList.remove('is-active');
        dots[index]?.classList.remove('is-active');
        index = (nextIndex + slides.length) % slides.length;
        slides[index]?.classList.add('is-active');
        dots[index]?.classList.add('is-active');
    };

    const restart = () => {
        clearInterval(timer);
        if (slides.length > 1) {
            timer = setInterval(() => go(index + 1), 7000);
        }
    };

    prev?.addEventListener('click', () => { go(index - 1); restart(); });
    next?.addEventListener('click', () => { go(index + 1); restart(); });
    dots.forEach((dot, n) => dot.addEventListener('click', () => { go(n); restart(); }));
    restart();

    const aboutToggle = document.querySelector('[data-about-toggle]');
    const aboutMore = document.getElementById('home-about-more');
    aboutToggle?.addEventListener('click', () => {
        const open = aboutMore?.classList.toggle('is-open');
        aboutToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        aboutToggle.textContent = open ? 'Read less' : 'Read more';
    });
})();
</script>
@endpush
