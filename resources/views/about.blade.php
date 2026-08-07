@extends('layouts.app')

@section('title', 'About Us - Scientific Lab Equipment Manufacturer | Atico India')
@section('meta_description', 'Learn about Atico India — a leading manufacturer, supplier and exporter of scientific lab equipments serving 30+ countries with quality, innovation and trusted expertise.')
@section('canonical', route('about'))

@section('content')
    <section class="about-hero">
        <div class="container">
            <nav class="about-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>About Us</span>
            </nav>
            <span class="about-hero-badge">About Atico India</span>
            <h1>Scientific Lab Equipments Manufacturer, Supplier &amp; Exporter</h1>
            <p class="about-hero-lead">We are a leading company in this field. We provide specific solutions for every customer — from schools and universities to research institutions worldwide.</p>
        </div>
    </section>

    <section class="section about-intro-section">
        <div class="container about-intro-grid">
            <div class="about-intro-copy">
                <p class="section-eyebrow">Who We Are</p>
                <h2>We are leading company in this field, We provide specific solutions for our every customers.</h2>
                <p>Atico is a leading Manufacturer, Supplier, and Exporter of Scientific Lab Equipments. We have a major presence in India and Worldwide across 30 countries. Having such a vast base of clients we are bound to keep up with the competition and constantly growing needs of our customers across the globe.</p>
                <p>ATICO keeps innovating and keeps up with the technology to manufacture and supply a safe and latest equipment to our customers. We also have the best expertise on board to test the final equipment to provide high-performance equipment to the technicians.</p>
                <div class="about-intro-stats">
                    <div class="about-intro-stat">
                        <strong>30+</strong>
                        <span>Countries</span>
                    </div>
                    <div class="about-intro-stat">
                        <strong>100%</strong>
                        <span>Customer Focus</span>
                    </div>
                    <div class="about-intro-stat">
                        <strong>ISO</strong>
                        <span>Certified Quality</span>
                    </div>
                </div>
            </div>
            <aside class="about-intro-visual card-panel">
                <img
                    src="{{ asset('assets/frontend/images/Bio-2-Image1.webp') }}"
                    alt="Atico India laboratory equipment manufacturing"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ asset('assets/frontend/images/microscope-2-Image1.webp') }}';"
                >
                <div class="about-intro-visual-cta">
                    <div>
                        <h3>Contact Us</h3>
                        <p>Speak with our team for quotations, tenders, and lab setup support.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="btn">Contact Us</a>
                </div>
            </aside>
        </div>
    </section>

    <section class="section section-muted about-founder-section">
        <div class="container about-founder-grid">
            <div class="about-founder-image-wrap">
                <img
                    src="{{ asset('assets/frontend/images/civil-1-Image1.webp') }}"
                    alt="Atico India scientific laboratory instruments"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ asset('assets/frontend/images/elec-testing-Image1.webp') }}';"
                >
                <div class="about-founder-quote-mark" aria-hidden="true">“</div>
            </div>
            <div class="about-founder-copy">
                <p class="section-eyebrow">Founder's Message</p>
                <h2>Word from the <strong>Founder</strong></h2>
                <blockquote class="about-founder-quote">
                    <p>We at Atico are Manufacturer, Suppliers, and Exporters of Scientific Laboratory Instruments. We aim to keep up with the technology and meet with the increasing needs of our customers through continuous improvement and innovation.</p>
                </blockquote>
                <blockquote class="about-founder-quote">
                    <p>Quality, excellence, innovation, and improvement are the quintessential part of ATICO policies thereby making Atico an expert and a trusted organization worldwide. Our products are of the utmost quality and the manufacturing processes conform to the highest compliance that gives our Customers 100% Satisfaction.</p>
                </blockquote>
            </div>
        </div>
    </section>

    <section class="section about-pillars-section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">About Us</p>
                <h2>We Are <strong>The Trusted Experts</strong></h2>
            </div>
            <div class="about-pillars-grid">
                <article class="about-pillar card-panel">
                    <div class="about-pillar-icon"><i class="fa fa-bullseye" aria-hidden="true"></i></div>
                    <h3>Our Mission</h3>
                    <p>Quality, excellence, innovation, and improvement are the quintessential part of ATICO policies. We aim to achieve our goal of 100% customer satisfaction in terms of quality, timely delivery, and exceptional customer support.</p>
                </article>
                <article class="about-pillar card-panel">
                    <div class="about-pillar-icon"><i class="fa fa-eye" aria-hidden="true"></i></div>
                    <h3>Our Vision</h3>
                    <p>To reach each part of the globe to provide the latest, cost-efficient Scientific Lab Equipments.</p>
                </article>
                <article class="about-pillar card-panel">
                    <div class="about-pillar-icon"><i class="fa fa-line-chart" aria-hidden="true"></i></div>
                    <h3>Our Company Strategies</h3>
                    <p>Our team of highly dedicated &amp; professionally trained technical staff is committed to meeting our customer's expectations and achieve excellence in every aspect of Scientific Lab Equipment production and supplies.</p>
                </article>
            </div>
        </div>
    </section>

    @if (!empty($groups) && count($groups))
        <section class="section section-muted about-groups-section">
            <div class="container">
                <div class="section-head section-head-center">
                    <p class="section-eyebrow">Product Expertise</p>
                    <h2>Our <strong>Lab Equipment Range</strong></h2>
                </div>
                <div class="about-groups-grid">
                    @foreach ($groups as $group)
                        <article class="about-group-card card-panel">
                            <h3>
                                <a href="{{ groupMenuUrl($group) }}">{!! $group->name !!}</a>
                            </h3>
                            @if (!empty($group->categories) && count($group->categories))
                                <ul>
                                    @foreach ($group->categories->take(8) as $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}">
                                                {{ $category->short_name ?: $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($group->categories) > 8)
                                    <a href="{{ groupMenuUrl($group) }}" class="about-group-more">View more</a>
                                @endif
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="about-cta-band">
        <div class="container about-cta-band-inner">
            <div>
                <h2>Ready to set up or upgrade your laboratory?</h2>
                <p>Contact Atico India for quotations, bulk orders, OEM supply, and government lab tender requirements.</p>
            </div>
            <div class="about-cta-band-actions">
                <button type="button" class="btn btn-light" data-open-enquiry-modal>Send Enquiry</button>
                <a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
                <a href="{{ route('certificates') }}" class="btn btn-outline-light">View Certificates</a>
            </div>
        </div>
    </section>
@endsection
