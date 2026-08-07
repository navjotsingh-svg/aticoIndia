@extends('layouts.app')

@section('title', 'FAQ - Ordering, Payment & Shipping | Atico India')
@section('meta_description', 'Frequently asked questions about ordering, payment, shipping, certifications, and quotations from Atico India — scientific lab equipment manufacturer and exporter.')
@section('canonical', route('faq'))

@section('content')
    <section class="faq-hero">
        <div class="container">
            <nav class="faq-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>FAQ</span>
            </nav>
            <span class="faq-hero-badge">Help Center</span>
            <h1>Frequently Asked Questions</h1>
            <p class="faq-hero-lead">Find answers about minimum orders, payment terms, shipping, certifications, quotations, and how to contact Atico India.</p>
        </div>
    </section>

    <section class="section faq-section">
        <div class="container faq-layout">
            <div class="faq-main">
                <div class="faq-search-wrap card-panel">
                    <label class="faq-search-label" for="faqSearch">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Search questions
                    </label>
                    <input
                        type="search"
                        id="faqSearch"
                        class="faq-search-input"
                        placeholder="Type a keyword — payment, shipping, quote, ISO..."
                        autocomplete="off"
                    >
                    <p class="faq-search-hint" id="faqSearchCount">{{ $faqs->count() }} questions available</p>
                </div>

                <div class="faq-topics" aria-label="Popular topics">
                    <span class="faq-topics-label">Popular topics:</span>
                    <button type="button" class="faq-topic" data-faq-filter="order">Orders</button>
                    <button type="button" class="faq-topic" data-faq-filter="payment">Payment</button>
                    <button type="button" class="faq-topic" data-faq-filter="shipping">Shipping</button>
                    <button type="button" class="faq-topic" data-faq-filter="quote">Quotations</button>
                    <button type="button" class="faq-topic" data-faq-filter="iso">Certifications</button>
                    <button type="button" class="faq-topic" data-faq-filter="contact">Contact</button>
                    <button type="button" class="faq-topic faq-topic--clear" data-faq-filter="">Clear</button>
                </div>

                <div class="faq-accordion" id="faqAccordion">
                    @forelse ($faqs as $faq)
                        @php
                            $searchText = strtolower(strip_tags($faq->name . ' ' . $faq->description));
                        @endphp
                        <details
                            class="faq-item card-panel"
                            data-faq-item
                            data-search="{{ $searchText }}"
                            @if($loop->first) open @endif
                        >
                            <summary class="faq-question">
                                <span class="faq-question-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-question-text">{!! $faq->name !!}</span>
                                <span class="faq-question-icon" aria-hidden="true"></span>
                            </summary>
                            <div class="faq-answer">{!! $faq->description !!}</div>
                        </details>
                    @empty
                        <div class="faq-empty card-panel">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <p>No FAQs available at the moment. Please <a href="{{ route('contact') }}">contact us</a> for assistance.</p>
                        </div>
                    @endforelse
                </div>

                <div class="faq-no-results card-panel" id="faqNoResults" hidden>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <h3>No matching questions found</h3>
                    <p>Try another keyword or reach out to our team — we are happy to help.</p>
                    <button type="button" class="btn" data-open-enquiry-modal>Send Enquiry</button>
                </div>
            </div>

            <aside class="faq-sidebar">
                <div class="faq-help-card card-panel">
                    <div class="faq-help-card-icon"><i class="fa fa-life-ring" aria-hidden="true"></i></div>
                    <h3>Need more help?</h3>
                    <p>Our support team can assist with quotations, bulk orders, tenders, and technical product queries.</p>
                    <ul class="faq-help-list">
                        <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+919896793832">+91-9896793832</a></li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+919996186555">+91-9996186555</a></li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a></li>
                    </ul>
                    <button type="button" class="btn btn-block" data-open-enquiry-modal>Send Enquiry</button>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-block">Contact Us</a>
                </div>

                <div class="faq-quick-links card-panel">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('lab-tenders') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Lab Tenders</a></li>
                        <li><a href="{{ route('certificates') }}"><i class="fa fa-certificate" aria-hidden="true"></i> Certificates</a></li>
                        <li><a href="{{ route('about') }}"><i class="fa fa-building-o" aria-hidden="true"></i> About Us</a></li>
                        <li><a href="{{ route('categories.index') }}"><i class="fa fa-th-large" aria-hidden="true"></i> Categories</a></li>
                    </ul>
                </div>

                <div class="faq-highlight card-panel">
                    <strong>Minimum order</strong>
                    <p>We expect minimum orders of at least US $500. Sample orders are available on request for new customers.</p>
                </div>
            </aside>
        </div>
    </section>

    <section class="faq-cta-band">
        <div class="container faq-cta-band-inner">
            <div>
                <h2>Still have a question?</h2>
                <p>Send us your enquiry and a business representative will get back to you swiftly with the information you need.</p>
            </div>
            <div class="faq-cta-band-actions">
                <button type="button" class="btn btn-light" data-open-enquiry-modal>Request a Quote</button>
                <a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
(() => {
    const searchInput = document.getElementById('faqSearch');
    const items = [...document.querySelectorAll('[data-faq-item]')];
    const noResults = document.getElementById('faqNoResults');
    const countEl = document.getElementById('faqSearchCount');
    const topicButtons = [...document.querySelectorAll('[data-faq-filter]')];

    const topicKeywords = {
        order: ['order', 'minimum', 'sample', 'quantity'],
        payment: ['payment', 'bank', 'advance', 'credit', 'wire', 'transfer'],
        shipping: ['shipping', 'freight', 'dispatch', 'delivery', 'air', 'sea'],
        quote: ['quote', 'quotation', 'price', 'catalogue', 'catalog'],
        iso: ['iso', 'ce', 'certified', 'certification', 'approval'],
        contact: ['contact', 'email', 'phone', 'fax', 'reach'],
    };

    const applyFilter = (queries) => {
        const terms = (Array.isArray(queries) ? queries : [queries])
            .map((term) => term.trim().toLowerCase())
            .filter(Boolean);
        let visible = 0;

        items.forEach((item) => {
            const haystack = item.dataset.search || '';
            const match = terms.length === 0 || terms.some((term) => haystack.includes(term));
            item.hidden = !match;
            if (match) visible += 1;
        });

        if (noResults) {
            noResults.hidden = visible > 0 || items.length === 0;
        }

        if (countEl) {
            countEl.textContent = visible === items.length
                ? `${visible} questions available`
                : `${visible} of ${items.length} questions shown`;
        }
    };

    searchInput?.addEventListener('input', () => {
        topicButtons.forEach((btn) => btn.classList.remove('is-active'));
        applyFilter([searchInput.value]);
    });

    topicButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const key = button.dataset.faqFilter || '';
            topicButtons.forEach((btn) => btn.classList.toggle('is-active', btn === button && key !== ''));

            if (key === '') {
                if (searchInput) searchInput.value = '';
                applyFilter([]);
                return;
            }

            const keywords = topicKeywords[key] || [key];
            if (searchInput) searchInput.value = keywords[0];
            applyFilter(keywords);
        });
    });
})();
</script>
@endpush
