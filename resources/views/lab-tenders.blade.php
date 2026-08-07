@extends('layouts.app')

@section('title', 'Lab Tenders - Ministry of Education & Government Lab Equipment | Atico India')
@section('meta_description', 'Atico India supplies Ministry of Education, Ministry of Health and World Bank lab tender materials — school science kits, physics, chemistry, biology, microscopes and engineering lab equipment.')

@section('full_width')
@endsection

@section('content')
    <section class="tender-hero">
        <div class="container">
            <nav class="tender-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Lab Tenders</span>
            </nav>
            <span class="tender-hero-badge">Government &amp; Institutional Supply</span>
            <h1>Lab Tenders — Ministry of Education Lab Equipment</h1>
            <p class="tender-hero-lead">
                <strong>Ministry of Education Lab Tenders – World Bank Tenders – Ministry of Health Tenders.</strong>
                Atico India supplies a wide range of lab tender materials for the Ministry of Education, Ministry of Health,
                and vocational training programmes — including school projects, school science kits, physics, chemistry,
                biology, microscopes, and general labware for bidding and tendering requirements.
            </p>
            <div class="tender-hero-actions">
                <button type="button" class="btn" data-open-enquiry-modal>Request Quotation</button>
                <a href="tel:+919896793832" class="btn btn-outline-light"><i class="fa fa-phone" aria-hidden="true"></i> +91-9896793832</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Why Atico India</p>
                <h2>Your Partner for <strong>Bulk Lab Tender Supply</strong></h2>
            </div>
            <div class="feature-grid">
                <div class="feature-box card-panel tender-feature-card">
                    <div class="feature-icon"><i class="fa fa-industry" aria-hidden="true"></i></div>
                    <h4>OEM Manufacturer</h4>
                    <p>Bulk lab tender supply and OEM manufacturing for educational, laboratory, analytical and research lab products from our Ambala facility.</p>
                </div>
                <div class="feature-box card-panel tender-feature-card">
                    <div class="feature-icon"><i class="fa fa-certificate" aria-hidden="true"></i></div>
                    <h4>ISO Certified Quality</h4>
                    <p>ISO 9001 certified manufacturing with equipment built to meet institutional tender specifications and quality standards.</p>
                </div>
                <div class="feature-box card-panel tender-feature-card">
                    <div class="feature-icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
                    <h4>Worldwide Export</h4>
                    <p>Regular bulk orders shipped to institutions across 30+ countries with export documentation and logistics support.</p>
                </div>
                <div class="feature-box card-panel tender-feature-card">
                    <div class="feature-icon"><i class="fa fa-life-ring" aria-hidden="true"></i></div>
                    <h4>Dedicated Support</h4>
                    <p>Our team assists with quotations, technical details, and post-delivery support for schools, colleges, and universities.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container tender-split">
            <div>
                <p class="section-eyebrow">What We Supply</p>
                <h2>Lab Tender Materials for <strong>Education &amp; Health Projects</strong></h2>
                <ul class="tender-checklist">
                    <li><strong>School Science Labs</strong> — physics, chemistry, biology kits, microscopes, glassware, and general lab apparatus.</li>
                    <li><strong>Engineering Laboratories</strong> — civil, mechanical, electrical, electronics, and automobile engineering equipment.</li>
                    <li><strong>Vocational &amp; TVET Workshops</strong> — trainers, testing systems, and workshop lab setups for skill development centres.</li>
                    <li><strong>Research &amp; Analytical Labs</strong> — incubators, ovens, centrifuges, spectrophotometers, and pharmacy lab instruments.</li>
                    <li><strong>Hospital &amp; Medical Labs</strong> — monitoring systems, physiotherapy equipment, and hospital laboratory apparatus.</li>
                    <li><strong>Complete School Projects</strong> — bundled supply for new lab installations under government and donor-funded tenders.</li>
                </ul>
            </div>
            <aside class="tender-contact-card card-panel">
                <h3>Contact Atico India</h3>
                <ul class="tender-contact-list">
                    <li><i class="fa fa-building-o" aria-hidden="true"></i> Atico India</li>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> 5309, Grain Market, Near B. D. Sen. Sec. School, Ambala Cantt-133001, Haryana, India.</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a></li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i> Order Help-Line: <a href="tel:+919896793832">+91-9896793832</a></li>
                    <li><i class="fa fa-fax" aria-hidden="true"></i> Fax: +91-0171-4004736</li>
                    <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="https://www.aticoindia.com" target="_blank" rel="noreferrer">www.aticoindia.com</a></li>
                </ul>
                <button type="button" class="btn btn-block" data-open-enquiry-modal>Contact Us</button>
            </aside>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Lab Categories</p>
                <h2>Equipment Categories for <strong>Tender Projects</strong></h2>
            </div>
            <div class="tender-scope-grid">
                @foreach ([
                    ['icon' => 'fa-flask', 'label' => 'Educational Lab Equipment'],
                    ['icon' => 'fa-cog', 'label' => 'Mechanical Engineering Lab'],
                    ['icon' => 'fa-building', 'label' => 'Civil Engineering Lab'],
                    ['icon' => 'fa-bolt', 'label' => 'Electrical Engineering Lab'],
                    ['icon' => 'fa-microchip', 'label' => 'Electronics Lab Trainers'],
                    ['icon' => 'fa-car', 'label' => 'Automobile Engineering Lab'],
                    ['icon' => 'fa-heartbeat', 'label' => 'Biology Lab Equipment'],
                    ['icon' => 'fa-graduation-cap', 'label' => 'Vocational Training Lab'],
                    ['icon' => 'fa-search', 'label' => 'Laboratory Microscopes'],
                    ['icon' => 'fa-tint', 'label' => 'Chemistry Lab Equipment'],
                    ['icon' => 'fa-calculator', 'label' => 'Maths Lab Instruments'],
                    ['icon' => 'fa-medkit', 'label' => 'Pharmacy Lab Equipment'],
                ] as $scope)
                    <div class="tender-scope-item card-panel">
                        <i class="fa {{ $scope['icon'] }}" aria-hidden="true"></i>
                        <span>{{ $scope['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Product Range</p>
                <h2>Our Lab Equipment <strong>Range Includes</strong></h2>
            </div>
            <div class="tender-range-grid">
                <article class="tender-range-card card-panel">
                    <h3>Educational Scientific Instruments</h3>
                    <ul class="tender-range-list">
                        <li>Preschool Kits</li>
                        <li>Biology Lab Equipment</li>
                        <li>School Lab Apparatus</li>
                        <li>Laboratory Equipment Supplies</li>
                        <li>Math Lab Equipment</li>
                        <li>Porcelain Ware</li>
                        <li>Anatomical Models</li>
                        <li>Laboratory Glassware</li>
                        <li>Electronics Lab Equipment</li>
                        <li>Lab Plasticware</li>
                        <li>Chemistry Lab Equipment</li>
                        <li>Physics Lab Equipment</li>
                        <li>Building Material Testing Equipment</li>
                        <li>Vocational Training Laboratory Equipment</li>
                        <li>Geography Lab Models</li>
                        <li>Microscopes</li>
                        <li>Laboratory Equipment Products</li>
                    </ul>
                </article>
                <article class="tender-range-card card-panel">
                    <h3>Analytical Lab Instruments</h3>
                    <ul class="tender-range-list">
                        <li>Electrochemistry Instruments</li>
                        <li>Flame Photometers</li>
                        <li>Pharmacology Instruments</li>
                        <li>Water Stills &amp; Distillation Plants</li>
                        <li>B.O.D. Incubators &amp; Egg Incubators</li>
                        <li>Industrial Drying Ovens &amp; Hot Air Ovens</li>
                        <li>Shakers, Hot Plates &amp; Water Baths</li>
                        <li>Deep Freezers &amp; Clean Air Equipment</li>
                        <li>Baths, Autoclaves &amp; Centrifuges</li>
                        <li>Moisture Meters &amp; Tissue Homogenizers</li>
                        <li>Pharmacy Laboratory Equipment</li>
                        <li>Clean Air Benches &amp; Bio Safety Cabinets</li>
                        <li>Laboratory Fume Hoods</li>
                        <li>Environmental Growth Chambers</li>
                        <li>COD Digesters &amp; Spectrophotometers</li>
                    </ul>
                </article>
                <article class="tender-range-card card-panel">
                    <h3>Engineering Lab Equipment</h3>
                    <ul class="tender-range-list">
                        <li>Metallurgical Equipment</li>
                        <li>Survey Instruments</li>
                        <li>Heat Transfer Lab Equipment</li>
                        <li>Fluid Mechanics &amp; Hydraulics Lab Equipment</li>
                        <li>CNC Trainer Machines</li>
                        <li>Training Workshop Labs</li>
                        <li>Mechanical Engineering Lab Equipment</li>
                        <li>Air Conditioning &amp; Refrigeration Equipment</li>
                        <li>Automotive &amp; Transportation Equipment</li>
                        <li>Soil Testing Equipment</li>
                        <li>Cement &amp; Concrete Testing Equipment</li>
                        <li>Bitumen Testing Equipment</li>
                        <li>Compression Testing Equipment</li>
                    </ul>
                </article>
                <article class="tender-range-card card-panel">
                    <h3>About Our Tender Supply</h3>
                    <p>Atico India is a leading manufacturer, exporter, and supplier of school lab equipment designed as per MOE tender specifications. We specialize in manufacturing and exporting Laboratory Equipment, Biology Lab Equipment, School Lab Equipment, and Math Lab Equipment.</p>
                    <p>We also supply Electronics Lab Trainers, Lab Microscopes, Engineering Lab Equipment, and Testing &amp; Training Systems for hospital lab equipment, medical monitoring systems, physiotherapy equipment, and lab glassware.</p>
                    <p>Our product range covers school labs, college labs, university labs, and research facilities worldwide.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Engineering Tenders</p>
                <h2>Specialist <strong>Testing &amp; Workshop Labs</strong></h2>
                <p class="tender-section-lead">
                    Alongside school and college science laboratories, we supply equipment for civil, material, and workshop
                    testing labs commonly specified in engineering and TVET tender documents.
                </p>
            </div>
            <div class="tender-accordion">
                @foreach ([
                    ['icon' => 'fa-map', 'title' => 'Soil & Geotechnical Testing', 'desc' => 'Equipment for soil mechanics, compaction, permeability, and geotechnical analysis in civil engineering laboratories.', 'items' => ['Soil Testing Equipment', 'CBR Testing', 'Consolidation Apparatus', 'Direct Shear Machine', 'Triaxial Test Setup', 'Sieve Shakers', 'Moisture Meters', 'Field Density Testing']],
                    ['icon' => 'fa-cubes', 'title' => 'Cement, Concrete & Aggregates', 'desc' => 'Compression machines, moulds, curing equipment, and aggregate testing apparatus for construction material labs.', 'items' => ['Cement Testing Equipment', 'Concrete Lab Testing Equipment', 'Compression Testing Equipment', 'Aggregate Testing Equipment', 'Curing Cabinet', 'Slump Cone Tester', 'Flexure Testing Machine']],
                    ['icon' => 'fa-road', 'title' => 'Bitumen & Highway Testing', 'desc' => 'Bitumen and road material testing instruments for highway and infrastructure laboratory tenders.', 'items' => ['Bitumen Testing Equipment', 'Highway Lab Equipment', 'Penetrometer', 'Ductility Tester', 'Marshall Stability Tester', 'Los Angeles Abrasion Machine']],
                    ['icon' => 'fa-wrench', 'title' => 'Mechanical & Material Testing', 'desc' => 'Strength of materials, hardness, impact, and universal testing equipment for engineering institutes.', 'items' => ['Universal Testing Machine', 'Rockwell Hardness Tester', 'Material Testing Lab Equipment', 'Strength of Material Lab', 'Survey Equipments', 'Metallurgical Microscope']],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Vocational & Workshop Labs', 'desc' => 'Trainer kits, workshop tools, and demonstration systems for technical and vocational education centres.', 'items' => ['Educational Lab Trainers', 'Power Electronics Trainer Kit', 'Communication Trainers', 'Robotic Kits Trainers', 'Vocational Training Lab', 'Process Control Engineering']],
                ] as $category)
                    <details class="tender-accordion-item">
                        <summary>
                            <span class="tender-accordion-title"><i class="fa {{ $category['icon'] }}" aria-hidden="true"></i> {{ $category['title'] }}</span>
                        </summary>
                        <div class="tender-accordion-body">
                            <p>{{ $category['desc'] }}</p>
                            <div class="tender-item-tags">
                                @foreach ($category['items'] as $item)
                                    <span>{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Global Presence</p>
                <h2>Exporting Lab Equipment <strong>Worldwide</strong></h2>
            </div>
            <div class="tender-global card-panel">
                <p>We supply educational scientific instruments to countries worldwide, including Afghanistan, Albania, Algeria, Angola, Argentina, Australia, Austria, Azerbaijan, Bahrain, Bangladesh, Belarus, Belgium, Bhutan, Bolivia, Botswana, Brazil, Bulgaria, Cambodia, Cameroon, Canada, Chile, China, Colombia, Croatia, Cyprus, Czech Republic, Denmark, Ecuador, Egypt, Estonia, Ethiopia, Fiji, Finland, France, Georgia, Germany, Ghana, Greece, Hong Kong, Hungary, Iceland, India, Indonesia, Iran, Iraq, Ireland, Israel, Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Libya, Lithuania, Luxembourg, Malaysia, Maldives, Malta, Mauritius, Mexico, Moldova, Mongolia, Morocco, Mozambique, Myanmar, Namibia, Nepal, Netherlands, New Zealand, Nigeria, Norway, Oman, Pakistan, Peru, Philippines, Poland, Portugal, Qatar, Romania, Russia, Rwanda, Saudi Arabia, Senegal, Serbia, Singapore, Slovakia, Slovenia, South Africa, South Korea, Spain, Sri Lanka, Sudan, Sweden, Switzerland, Syria, Taiwan, Tanzania, Thailand, Tunisia, Turkey, Uganda, Ukraine, United Arab Emirates, United Kingdom, United States, Uruguay, Uzbekistan, Venezuela, Vietnam, Yemen, Zambia, and Zimbabwe.</p>
                <p class="tender-global-cta">Discover the quality and innovation of Atico India’s laboratory and educational equipment today!</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">How It Works</p>
                <h2>Placing a <strong>Lab Tender Enquiry</strong></h2>
            </div>
            <div class="tender-process-grid">
                @foreach ([
                    ['icon' => 'fa-envelope-o', 'step' => '1', 'title' => 'Share Requirements', 'text' => 'Send your tender notice, BOQ, or equipment list to our sales team by email or enquiry form.'],
                    ['icon' => 'fa-file-text-o', 'step' => '2', 'title' => 'Receive Quotation', 'text' => 'We prepare a detailed quotation with product specifications matched to your tender requirements.'],
                    ['icon' => 'fa-truck', 'step' => '3', 'title' => 'Manufacture & Dispatch', 'text' => 'Orders are manufactured, inspected, packed, and shipped to your destination country.'],
                    ['icon' => 'fa-check-circle', 'step' => '4', 'title' => 'Delivery & Support', 'text' => 'We coordinate delivery and remain available for technical support after installation.'],
                ] as $process)
                    <div class="tender-process-card card-panel">
                        <span class="tender-process-step">{{ $process['step'] }}</span>
                        <div class="feature-icon"><i class="fa {{ $process['icon'] }}" aria-hidden="true"></i></div>
                        <h4>{{ $process['title'] }}</h4>
                        <p>{{ $process['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="stats-bar">
        <div class="container stats-grid stats-grid--four">
            <div><span class="stat-num">30+</span><span class="stat-label">Countries Served</span></div>
            <div><span class="stat-num">ISO</span><span class="stat-label">9001 Certified</span></div>
            <div><span class="stat-num">CE</span><span class="stat-label">Approved Products</span></div>
            <div><span class="stat-num">OEM</span><span class="stat-label">Bulk Tender Supply</span></div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container tender-split tender-split--reverse">
            <div>
                <p class="section-eyebrow">About Atico India</p>
                <h2>Scientific Lab Equipment <strong>Manufacturer &amp; Exporter</strong></h2>
                <p>Atico India is a premium company in the field of scientific lab equipment manufacturing, supplying institutions in India and across the globe. We manufacture school lab equipment as per MOE tender specifications and export a comprehensive range of educational and scientific laboratory instruments.</p>
                <p>We are a renowned manufacturer from India and China, offering laboratory instruments and workshop lab equipment for school labs, college labs, and university labs — from preschool kits to advanced research apparatus.</p>
                <p>Whether you are setting up a new science laboratory or responding to a government tender, our team can help you select the right equipment for your project.</p>
            </div>
            <div class="tender-category-cards">
                <div class="tender-mini-card card-panel"><i class="fa fa-flask" aria-hidden="true"></i><h4>Physics Lab Equipment</h4><p>Electrical instruments, optics, mechanics, and modern physics apparatus.</p></div>
                <div class="tender-mini-card card-panel"><i class="fa fa-tint" aria-hidden="true"></i><h4>Chemistry Lab Equipment</h4><p>Glassware, burners, spatulas, and complete chemistry lab setups.</p></div>
                <div class="tender-mini-card card-panel"><i class="fa fa-leaf" aria-hidden="true"></i><h4>Biology Lab Equipment</h4><p>Models, charts, microtomes, dissecting tools, and anatomy models.</p></div>
                <div class="tender-mini-card card-panel"><i class="fa fa-cogs" aria-hidden="true"></i><h4>Engineering Lab Equipment</h4><p>Civil, mechanical, electrical, and electronics trainers and test rigs.</p></div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <p class="section-eyebrow">Common Questions</p>
                <h2>Lab Tender <strong>FAQs</strong></h2>
            </div>
            <div class="faq-accordion tender-faq">
                @foreach ([
                    ['q' => 'What is the minimum order for lab tender supply?', 'a' => 'We generally expect minimum orders of at least US $500. Sample orders against cost are also available on request for buyers who wish to evaluate products before placing a full tender order.'],
                    ['q' => 'Do you supply equipment for Ministry of Education tenders?', 'a' => 'Yes. We supply school science kits, physics, chemistry, biology equipment, microscopes, and general labware for Ministry of Education and Ministry of Health tender projects.'],
                    ['q' => 'Can you supply equipment for World Bank funded projects?', 'a' => 'Yes. We supply laboratory and educational equipment for World Bank and donor-funded school and health laboratory projects with documentation to support procurement requirements.'],
                    ['q' => 'Which countries do you export to?', 'a' => 'Atico India exports to institutions in 30+ countries across Africa, Asia, the Middle East, Europe, and the Americas. Contact us with your destination and equipment list for a quotation.'],
                    ['q' => 'How can I request a quotation for a lab tender?', 'a' => 'Share your tender document or equipment requirements by email at sales@aticoindia.com, call our order help-line at +91-9896793832, or use the enquiry form on this website.'],
                ] as $faq)
                    <details class="faq-item">
                        <summary class="faq-question">{{ $faq['q'] }}</summary>
                        <div class="faq-answer"><p>{{ $faq['a'] }}</p></div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="tender-cta">
        <div class="container tender-cta-inner">
            <div>
                <p class="section-eyebrow">Get in Touch</p>
                <h2>Need a Quote for Your <strong>Lab Tender?</strong></h2>
                <p>Contact Atico India for quotations on Ministry of Education, Ministry of Health, and institutional laboratory equipment tenders. Our sales team will respond with pricing and product details for your requirements.</p>
                <ul class="tender-cta-points">
                    <li><i class="fa fa-check" aria-hidden="true"></i> Bulk OEM pricing</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Export documentation</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Technical specifications</li>
                </ul>
            </div>
            <div class="tender-cta-actions">
                <a href="tel:+919996186555" class="tender-cta-link card-panel"><i class="fa fa-phone" aria-hidden="true"></i><span>Call Us</span><strong>+91-9996186555</strong></a>
                <a href="mailto:sales@aticoindia.com" class="tender-cta-link card-panel"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Email Us</span><strong>sales@aticoindia.com</strong></a>
                <button type="button" class="btn btn-block" data-open-enquiry-modal>Send Enquiry</button>
            </div>
        </div>
    </section>
@endsection
