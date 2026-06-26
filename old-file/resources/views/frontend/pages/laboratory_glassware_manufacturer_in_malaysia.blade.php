@extends('frontend.layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
<section class="hero-final">
<style>
  div,p,span{

  font-family: "Outfit", sans-serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;


  }
</style>
  <!-- full-bleed background -->
  <div class="hero-bg"></div>

  <div class="container-fluid">
    <div class="row hero-row">

      <!-- LEFT: 6 columns with heading/desc/cta -->
      <div class="col-md-12 hero-left">
        <div class="hero-left-inner">
          <h1 class="hero-head">Laboratory Glassware Manufacturer in Malaysia </h1>

          <p class="hero-lead">
           Atico India is a reliable laboratory glassware supplier in Malaysia and provides world-class laboratory glassware specifically made for continued scientific performance. 

          </p>

          <a href="#contact" class="hero-btn">Get a Quote</a>
        </div>
      </div>

      <!-- RIGHT: empty col-md-6 so background image sits on the right -->
     
    </div>
  </div>

  <!-- BELOW: centered overlapping three-box card (icons inline left) -->
  <div class="threebox-wrap">
    <div class="container">
      <div class="threebox-card">
        <div class="row">

          <!-- BOX 1 -->
          <div class="col-md-4 threebox-col">
            <div class="threebox-inner">
              <div class="threebox-icon">
                <img src="{{ asset('/assets/frontend/images/q2.png') }}"/>
              </div>

              <div class="threebox-content">
                <h4 class="threebox-title">Quality Equipment</h4>
                <p class="threebox-desc">We use high-grade borosilicate glass to ensure excellent heat resistance, chemical stability, and long service life in our laboratory glassware. </p>
              </div>
            </div>
          </div>

          <!-- BOX 2 (middle with dashed separators) -->
          <div class="col-md-4 threebox-col threebox-mid">
            <div class="threebox-inner">
              <div class="threebox-icon">
                <img src="{{ asset('/assets/frontend/images/q1.png') }}"/>
              </div>

              <div class="threebox-content">
                <h4 class="threebox-title">Advanced Technology</h4>
                <p class="threebox-desc">Our production is supported by advanced technology. Manufacturing includes precision molding and automated calibration systems to achieve precise measurement accuracy.</p>
              </div>
            </div>
          </div>

          <!-- BOX 3 -->
          <div class="col-md-4 threebox-col">
            <div class="threebox-inner">
              <div class="threebox-icon">
                <img src="{{ asset('/assets/frontend/images/q2.png') }}"/>
              </div>

              <div class="threebox-content">
                <h4 class="threebox-title">Recognized Globally</h4>
                <p class="threebox-desc">We export glassware to nearly every country in the world. Incomparable exports have garnered a reputation as a preferred global supplier due to timely delivery and exceptional reliability.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</section>

<style>
/* ---------------- HERO (full image background) ---------------- */
.hero-final { position: relative; overflow: visible; }
.hero-bg {
  position: absolute; left:0; right:0; top:0;
  height: 760px;
  background-image: url("{{ asset('/assets/frontend/images/slide1.png') }}");
  background-position: right center;
  background-size: cover;
  background-repeat: no-repeat;
  z-index: 0;
}
@media (max-width: 767px) {
  .hero-bg {
    background-image: url("{{ asset('/assets/frontend/images/mal-slide1-mob.png') }}");
    background-position: center;
   /* height: 520px; *//* adjust if needed */
  }
}
.hero-final::before {
  content: "";
  position: absolute; left:0; top:0; bottom:0;
  width:50%;
  background: linear-gradient(to right, rgba(255,255,255,0.99) 0%, rgba(255,255,255,0.72) 55%, rgba(255,255,255,0) 100%);
  z-index:1; pointer-events:none;
}
.hero-row { position: relative; z-index:2; padding: 90px 15px; min-height:640px; display:flex; align-items:center; }
.hero-left { display:flex; align-items:center; }
.hero-left-inner { /*max-width:640px;*/ padding-left:12px; }
.hero-head { font-family: "Montserrat",sans-serif; font-size:30px; font-weight:800; margin:0 0 18px; color:#111; line-height:1.03; }
.hero-lead { color:#666; font-size:16px; max-width:620px; margin-bottom:22px; }
.hero-btn { background:#36115f; color:#fff; padding:12px 26px; border-radius:12px; font-weight:600; text-decoration:none; box-shadow:0 12px 34px rgba(53,17,95,0.14); }

/* ---------------- THREE-BOX CARD (icons on left) ---------------- */
.threebox-wrap { position: relative; z-index:5; margin-top: -56px; } /* overlap hero */
.threebox-card {
  max-width: 1200px;
  margin: 0 auto;
  background: #FAFAFA;
  border-radius: 6px;
  padding: 22px 18px;
  box-shadow: 0 18px 40px rgba(17,17,17,0.06);
  position: relative;
  overflow: visible;
}

/* subtle slanted accents left & right */
.threebox-card:before,
.threebox-card:after {
  content: "";
  position: absolute;
  top: 20px;
  width: 48px;
  height: 48px;
  background: #efefef;
  z-index: -1;
}
.threebox-card:before { left: -36px; transform: skewX(-22deg); }
.threebox-card:after  { right: -36px; transform: skewX(22deg); }

/* row */
.threebox-card .row { display:flex; align-items: stretch; }

/* each column */
.threebox-col { padding: 20px 18px; position: relative; }

/* layout inside each column: icon (left) + text (right) */
.threebox-inner { display:flex; align-items:flex-start; justify-content:flex-start; }

/* circular icon - smaller inline on left */
.threebox-icon {
  width: 64px;
  height: 64px;
  min-width: 64px;
  border-radius: 50%;
  background: #3c1168;
  display:flex;
  margin-top:40px;
  justify-content:center;
  margin-right: 20px;
  box-shadow: 0 8px 22px rgba(60,17,104,0.12);
}
.threebox-icon svg { display:block; }

/* heading and text */
.threebox-content { flex:1; }
.threebox-title {
  font-size:18px;
  font-weight:700;
  color:#111;
  margin: 4px 0 8px;
}
.threebox-desc {
  color:#6f6f6f;
  font-size:14px;
  line-height:1.7;
  margin:0;
}

/* dashed separators for middle column */
.threebox-mid:before,
.threebox-mid:after {
  content: "";
  position: absolute;
  top: 18px;
  bottom: 18px;
  width: 0;
  border-left: 1px dashed #d9cfe8;
}
.threebox-mid:before { left: -8px; }
.threebox-mid:after  { right: -8px; }

/* responsive: stacks below md; icons move above text when stacked */
@media (max-width: 991px) {
  .hero-row { padding: 60px 15px; min-height:620px; display:block; }
  .hero-head { font-size:40px; }
  .threebox-wrap { margin-top: 5px; }
  .threebox-card { padding: 18px 14px; max-width:100%; }
  .threebox-card .row { display:block; }
  .threebox-col { padding: 18px 12px; }
  .threebox-inner { flex-direction: column; align-items:center; text-align:center; }
  .threebox-icon { margin: 0 0 12px !important; }
  .threebox-content { width:100%; }
  .threebox-mid:before, .threebox-mid:after { display:none; }
  .threebox-card:before, .threebox-card:after { display:none; }
}

/* make svg icon strokes white & visible */
.threebox-icon svg path,
.threebox-icon svg circle { stroke:#fff; stroke-width:1.6; fill:none; }
/* MOBILE VIEW: STACKED BOXES LIKE IMAGE 2 */
@media (max-width: 768px) {
    .below-card .row {
        display: block !important;
    }

    .panel-col {
        width: 100% !important;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 25px;
        text-align: left !important;
    }

    .panel-col:last-child {
        margin-bottom: 0;
    }

    /* icon smaller + left aligned */
    .icon-lg {
        width: 72px;
        height: 72px;
        margin: 0 !important;
        flex-shrink: 0;
    }

    /* remove vertical dashed borders */
    .panel-mid:before,
    .panel-mid:after {
        display: none !important;
    }

    /* text block */
    .panel-title {
        margin: 0 0 6px;
        font-size: 20px;
    }

    .panel-desc {
        margin: 0;
        font-size: 15px;
        max-width: 100% !important;
        text-align: left !important;
    }
}
/* ----- FORCE: threebox convert to stacked rows on mobile (icon left, text right) ----- */
@media (max-width: 991px) {

  /* make row stack */
  .threebox-card .row,
  .threebox-card .row .threebox-col {
    display: block !important;
  }

  /* each column becomes a full-width horizontal item */
  .threebox-col {
    display: flex !important;
    flex-direction: row !important;
    align-items: flex-start !important;
    padding: 18px 14px !important;
    margin-bottom: 18px !important;
    text-align: left !important;
    width: 100% !important;
    box-sizing: border-box !important;
    background: transparent !important; /* keep card background visible */
  }

  /* inner container keep row layout */
  .threebox-inner {
    display: flex !important;
    flex-direction: row !important;
    align-items: flex-start !important;
    width: 100% !important;
    gap: 14px;
  }

  /* icon: left, slightly larger / square area */
  .threebox-icon {
    width: 72px !important;
    height: 72px !important;
    min-width: 72px !important;
    margin: 6px 0 0 0 !important;
    flex: 0 0 72px !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 12px 30px rgba(60,17,104,0.10) !important;
  }
  .threebox-icon img { width: 42px; height: 42px; object-fit: contain; display:block; }

  /* content sits to the right of icon */
  .threebox-content {
    display:block !important;
    flex: 1 1 auto !important;
  }
  .threebox-title {
    font-size: 18px !important;
    margin: 2px 0 8px !important;
    text-align: left !important;
  }
  .threebox-desc {
    font-size: 14px !important;
    line-height: 1.6 !important;
    color: #6f6f6f !important;
    text-align: left !important;
    margin: 0 !important;
  }

  /* remove dashed vertical separators around the middle box */
  .threebox-mid:before,
  .threebox-mid:after {
    display: none !important;
  }

  /* hide the slanted decorative accents to avoid overlap */
  .threebox-card:before,
  .threebox-card:after {
    display: none !important;
  }

  /* ensure overall card padding doesn't collapse */
  .threebox-card { padding: 14px 12px !important; }

  /* last item spacing */
  .threebox-col:last-child { margin-bottom: 6px !important; }

  /* fallback for specificity conflicts */
  .threebox-card .threebox-col .threebox-inner,
  .threebox-card .threebox-col .threebox-icon,
  .threebox-card .threebox-col .threebox-content { -webkit-box-sizing: border-box; box-sizing: border-box; }
}

</style>
<!-- ABOUT / Country-specific section (paste below the hero) -->


<!-- PRODUCT RANGE / CATEGORIES -->
<section class="product-range-section">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <p class="pr-eyebrow">Product Categories</p>
        <h2 class="pr-title">Our Product Range</h2>
        <p class="pr-sub">Robustly built laboratory glassware ensures accuracy and safety during experiments under varied conditions. Explore our range of laboratory glassware here:</p>
      </div>
    </div>

    <div class="row pr-cards-row" style="margin-top:36px;">
      <!-- Card 1 -->
      <div class="row pr-cards-row">
  @foreach($categories as $category)
    @php
      // resolve image URL: allow absolute URLs or relative asset paths
      $img = $category->image ?? null;
      if($img) {
        if (strpos($img, 'http') === 0) {
          $imgUrl = $img;
        } else {
          // treat as local path under public/
          $imgUrl = "/uploads/product_images/".$img;
        }
      } else {
        $imgUrl = asset('assets/frontend/images/placeholder-product.png'); // fallback placeholder
      }

      // link to category page — change route name to your real route
      $link = isset($category->slug)
              ? route('categories', $category->slug)
              : (isset($category->id) ? url('category/'.$category->id) : '#');
    @endphp

    <div class="col-md-3 pr-card-col">
      <div class="">
        <div class="pr-img-wrap">
          <a href="{{ $link }}">
            <img src="{{ $imgUrl }}" alt="{{ e($category->name) }}" loading="lazy">
          </a>
        </div>

        <h4 class="pr-card-title">
          <a href="{{ $link }}" style="color:inherit; text-decoration:none;">
            {{ e($category->name) }}
          </a>
        </h4>
      </div>
    </div>
  @endforeach

  @foreach($products as $category)
    @php
      // resolve image URL: allow absolute URLs or relative asset paths
      $img = $category->image ?? null;
      if($img) {
        if (strpos($img, 'http') === 0) {
          $imgUrl = $img;
        } else {
          // treat as local path under public/
          $imgUrl = "/uploads/product_images/".$img;
        }
      } else {
        $imgUrl = asset('assets/frontend/images/placeholder-product.png'); // fallback placeholder
      }

      // link to category page — change route name to your real route
      $link = isset($category->slug)
              ? route('product_detail', $category->slug)
              : (isset($category->id) ? url('product/'.$category->id) : '#');
    @endphp

    <div class="col-md-3 pr-card-col">
      <div class="">
        <div class="pr-img-wrap">
          <a href="{{ $link }}">
            <img src="{{ $imgUrl }}" alt="{{ e($category->name) }}" loading="lazy">
          </a>
        </div>

        <h4 class="pr-card-title">
          <a href="{{ $link }}" style="color:inherit; text-decoration:none;">
            {{ e($category->name) }}
          </a>
        </h4>
      </div>
    </div>
  @endforeach
</div>

    </div>

    <!-- optional: more rows or link to catalog -->
   
  </div>
</section>

<style>
/* Product Range Section */
.product-range-section { padding: 72px 0 90px; background: #fff; }

/* heading area */
.pr-eyebrow { color: #6f2fa6; font-weight:600; font-size:13px; margin:0 0 8px; }
.pr-title { font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif; font-size:44px; margin:0 0 10px; font-weight:800; color:#222; }
.pr-sub { color:#666; max-width:900px; margin:0 auto; font-size:16px; }

/* cards row */
.pr-cards-row { margin-top: 28px; }

/* card column spacing */
.pr-card-col { margin-bottom: 28px; }

/* individual card */
.pr-card {
  background: #fff;
  border-radius: 16px;
  padding: 28px 18px 18px;
  text-align: center;
  transition: transform .18s ease, box-shadow .18s ease;
  border: 1px solid rgba(34,34,34,0.04);
  box-shadow: 0 10px 26px rgba(17,17,17,0.04);
  min-height: 300px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
}

/* image wrapper: big square with rounded corners */
.pr-img-wrap {
  /*width: 86%;*/
  max-width: 340px;
  height: 260px;
  border-radius: 14px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 18px;
  background: #fff;
  border: 1px solid #E0E0E0;
}

/* product image - center, cover */
.pr-img-wrap img {
  display:block;
  max-width: 86%;
  max-height: 86%;
  object-fit: contain;
}

/* title under image */
.pr-card-title {
  font-size: 18px;
  color: #222;
  font-weight:600;
  margin-top: 6px;
  text-align: center;
}

/* hover */
.pr-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 26px 70px rgba(17,17,17,0.08);
}

/* view all link */
.pr-view-all {
  display:inline-block;
  margin-top: 6px;
  color:#36115f;
  font-weight:700;
  text-decoration:none;
  padding: 10px 18px;
  border-radius:8px;
  border:1px solid rgba(54,17,95,0.06);
}

/* Responsive (only col-md grid used) */
@media (max-width: 991px) {
  .product-range-section { padding: 36px 0; }
  .pr-title { font-size: 32px; }
  .pr-img-wrap { height: 220px; }
  .pr-card { min-height: 260px; padding: 18px 12px; border-radius:12px; }
}

/* Make product cards display 2-per-row on mobile (<= 991px) */
@media (max-width: 991px) {
  /* ensure parent row allows wrapping tiles */
  .pr-cards-row { display: block !important; }

  /* Turn each pr-card-col into a half-width tile (2 per row) */
  .pr-card-col {
    width: 50% !important;
    float: left !important;
    box-sizing: border-box !important;
    padding-left: 8px !important;   /* horizontal gutter */
    padding-right: 8px !important;
    margin-bottom: 20px !important;
  }

  /* If you have an extra .row wrapper inside, make sure inner rows don't break layout */
  .pr-cards-row > .row { margin-left: 0; margin-right: 0; }

  /* Make sure inner card keeps full width of the tile */
  .pr-card {
    width: 100% !important;
    min-height: auto !important;
    padding: 18px 12px !important;
  }

  /* Slightly reduce the image wrapper for tighter rows */
  .pr-img-wrap { /*width: 92% !important;*/ height: 200px !important; }

  /* small typography tweak */
  .pr-card-title { font-size: 16px !important; }

  /* final clearfix after floats */
  .pr-cards-row::after {
    content: "" ;
    display: block;
    clear: both;
  }
}

</style>

<section class="about-country-section">
  <div class="container">
    <div class="row">

      <!-- LEFT: images + purple vertical bar (col-md-6) -->
      <div class="col-md-6 about-left">
        <div class="about-left-inner">
          <!-- vertical purple bar -->
          

          <!-- bottom-left small image placed overlapping -->
          <div class="about-img-bottom">
            <img src="{{ asset('/assets/frontend/images/about_malaysia.png') }}" alt="lab equipment" />
          </div>
        </div>
      </div>

      <!-- RIGHT: heading, paragraphs, bullets, CTA (col-md-6) -->
      <div class="col-md-6 about-right">
        <div class="about-right-inner">
          <p class="eyebrow">Welcome to Atico</p>
          <h2 class="about-title">A Leading Manufacturer & Supplier of Laboratory Glassware in Malaysia</h2>

          <div class="about-paragraphs">
            <p>Atico India is one of the fastest-growing names in the scientific equipment industry. Atico India serves Malaysia with pride, offering a wide selection of high-quality glassware for laboratories. Our products are indispensable and turn complex laboratory research into an easier task for educational laboratories, chemical industries, pharmaceutical firms, food quality testing units, and research institutions.  </p>

            <!-- <p>We understand the prevailing demand for safe, dependable, and internationally certified glassware within the Malaysian market, and we manufacture each unit with precision accordingly. We ensure timely supply, competitive pricing, and strong customer support with customization to the laboratory requirements. We strive hard to make our presence recognized as a long-term partner for laboratories seeking to procure accurate and durable glassware suitable for various applications.</p> -->
          </div>

          <!-- three bullets in two columns (use col-md inside for layout) -->
          <div class="row about-bullets">
            <div class="col-md-6 bullet-col">
              <div class="bullet">
                <div class="bullet-icon">
                  <img src="{{ asset('/assets/frontend/images/about-icon.png') }}">
                </div>
                <div class="bullet-text mtext">Tailored products designed to meet Malaysian educational and industrial standards</div>
              </div>

              <div class="bullet">
                <div class="bullet-icon">
                  <img src="{{ asset('/assets/frontend/images/about-icon.png') }}">
                </div>
                <div class="bullet-text">Safe, chemically stable glassware for every laboratory environment</div>
              </div>
            </div>

            <div class="col-md-6 bullet-col">
              <div class="bullet">
                <div class="bullet-icon">
                  <img src="{{ asset('/assets/frontend/images/about-icon.png') }}">
                </div>
                <div class="bullet-text mtext">Export-ready packaging for damage-free delivery.</div>
              </div>

              <div class="bullet">
                <div class="bullet-icon">
                  <img src="{{ asset('/assets/frontend/images/about-icon.png') }}">
                </div>
                <div class="bullet-text">Trusted by leading universities, research laboratories, and industrial testing units.</div>
              </div>
            </div>
          </div>

          <!-- CTA aligned left under bullets -->
          <div class="about-cta-wrap">
            <a href="#contact" class="about-cta">Get a Quote</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
/* ABOUT: two-column section, left imagery with purple bar, right content */
.about-country-section { padding: 70px 0 80px; background: #fff; position: relative; }

/* LEFT: images & decorative purple bar */
.about-left { position: relative; }
.about-left-inner { position: relative; padding-left: 20px; }

/* purple vertical bar (behind images) */
.purple-bar {
  position: absolute;
  left: 6px;
  top: 30px;
  width: 48px;
  height: 360px;
  background: #3c1168;
  border-radius: 6px;
  z-index: 1;
  box-shadow: 0 6px 18px rgba(60,17,104,0.08);
}

/* top image */
.about-img-top {
  position: relative;
  z-index: 2;
  margin-left: 40px; /* create space from purple bar */
  border-radius: 10px;
  overflow: hidden;
}
.about-img-top img { display:block; width:100%; height:auto; max-height:420px; object-fit:cover; }

/* bottom small image overlapping top image */
.about-img-bottom {
  position: relative;
  z-index: 3;
  /*width: 65%;*/
  margin-left: auto;
  /*margin-top: -60px;*/
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  /*box-shadow: 0 8px 28px rgba(17,17,17,0.06);*/
}
.about-img-bottom img { width:100%; height:auto; display:block; object-fit:cover; }

/* RIGHT content */
.about-right-inner { padding-left: 36px; padding-right: 12px; }

.eyebrow {
  color: #6f28a6;
  font-weight:600;
  font-size:13px;
  margin:0 0 6px;
}
.about-title {
  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
  font-size:40px;
  margin:0 0 18px;
  font-weight:800;
  color:#111;
}
.about-paragraphs p { color:#666; line-height:1.8; margin-bottom:16px; font-size:15px; }

/* bullets grid */
.about-bullets { margin-top: 18px; margin-bottom: 20px; }
.bullet-col { padding-top: 6px; }
.bullet { display:flex; align-items:flex-start; margin-bottom:18px; }
.bullet-icon {
  width:44px; height:44px; min-width:44px; border-radius:50%;
  /*background:#3c1168;*/ display:flex; align-items:center; justify-content:center;
  margin-right:14px; /*box-shadow: 0 8px 22px rgba(60,17,104,0.12);*/
}
.bullet-icon svg path, .bullet-icon svg circle { stroke:#fff; stroke-width:1.4; fill:none; }
.bullet-text { color:#444; font-size:14px; line-height:1.6; }

/* CTA */
.about-cta-wrap { margin-top: 12px; }
.about-cta {
  display:inline-block;
  background: #36115f;
  color: #fff;
  padding: 12px 24px;
  border-radius: 10px;
  font-weight:600;
  text-decoration:none;
  box-shadow: 0 12px 28px rgba(53,17,95,0.12);
}

/* Responsive: keep only col-md used (stack under 992px) */
@media (max-width: 991px) {
  .about-country-section { padding: 36px 14px; }
  .purple-bar { display: none; }
  .about-img-top { margin-left: 0; max-height:300px; }
  .about-img-bottom { width:90%; margin: 0px auto 0; }
  .about-right-inner { padding-left:0; padding-top:18px; }
  .about-title { font-size:28px; }
  .about-left, .about-right { margin-bottom: 24px; }
  .threebox-card { max-width: 100%; }
}

/* ---------- Mobile: move images below content + keep bullets 2-col ---------- */
@media (max-width: 991px) {

  /* Make the row a flex container so we can reorder columns */
  .about-country-section .row {
    display: flex !important;
    flex-direction: column !important; /* stack by default */
  }

  /* Show right content first, left images second */
  .about-country-section .about-right {
    order: 1 !important;
  }
  .about-country-section .about-left {
    order: 2 !important;
  }

  /* Ensure left & right take full width when stacked */
  .about-country-section .about-left,
  .about-country-section .about-right {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box;
    padding-left: 0; /* optional: remove left padding on mobile */
    padding-right: 0;
  }

  /* Tweak image wrapper sizing for stacked layout */
  .about-left-inner { padding-left: 0 !important; }
  .about-img-top { margin-left: 0 !important; max-height: 360px; }
  .about-img-bottom {
    width: 90% !important;
    margin: 0px auto 0 !important;
    box-shadow: 0 8px 28px rgba(17,17,17,0.06);
  }

  /* -----------------------------
     Keep bullets two columns on mobile
     (col-md-6 normally stacks, we override with 50% width)
     ----------------------------- */
  .about-country-section .about-bullets {
    display: block;
    overflow: visible;
    padding-left: 0;
    margin-left: -8px; /* small gutter correction */
  }

  .about-country-section .about-bullets .bullet-col {
    width: 50% !important;      /* two columns */
    float: left !important;
    box-sizing: border-box !important;
    padding-left: 8px !important;  /* keep some gutter */
    padding-right: 8px !important;
  }

  /* ensure last row clears floats */
  .about-country-section .about-bullets::after {
    content: "";
    display: block;
    clear: both;
  }

  /* spacing tweaks */
  .about-right-inner { padding-top: 18px !important; }
  .about-title { font-size: 28px !important; }
  .about-paragraphs p { font-size: 15px !important; }
}
/* ---------- MOBILE: bullets as 2x2 grid, icon above & centered (no display:contents) ---------- */
@media (max-width: 991px) {

  /* Parent becomes flex so bullets can wrap */
  .about-country-section .about-bullets {
    display: flex !important;
    flex-wrap: wrap !important;
    justify-content: space-between !important;
    margin: 0 -8px !important; /* gutter correction */
    padding: 0 !important;
  }

  /* Keep existing column wrappers but do not rely on them for layout */
  .about-country-section .about-bullets .bullet-col {
    width: 100% !important;
    float: none !important;
    padding: 0 !important;
  }

  /* Each .bullet becomes a 50% tile (two per row) */
  .about-country-section .about-bullets .bullet {
    width: calc(50% - 16px) !important; /* two across with gutter */
    box-sizing: border-box !important;
    margin: 8px !important;
    padding: 12px !important;
    display: flex !important;
    flex-direction: column !important; /* icon above text */
    align-items: center !important;
    text-align: center !important;
    min-height: 120px !important;
    float: left !important;
    background: transparent !important;
  }

  /* Icon: purple circle, centered, clipped cleanly */
  .about-country-section .about-bullets .bullet .bullet-icon {
    width: 64px !important;
    height: 64px !important;
    border-radius: 50% !important;
    /*background: #3c1168 !important;*/
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    /*box-shadow: 0 10px 26px rgba(60,17,104,0.08) !important;*/
    overflow: hidden !important;        /* <-- prevents white artifacts */
    margin-bottom: 10px !important;
    flex: 0 0 auto !important;
  }

  /* Ensure the <img> inside icon fits and is not squashed or showing white background */
  .about-country-section .about-bullets .bullet .bullet-icon img {
    width: 36px !important;
    height: 36px !important;
    object-fit: contain !important;
    display: block !important;
    filter: brightness(1) !important;
    background: transparent !important;
    border-radius: 50% !important;
  }

  /* Bullet text centered under icon */
  .about-country-section .about-bullets .bullet .bullet-text {
    text-align: center !important;
    font-size: 14px !important;
    color: #444 !important;
    line-height: 1.6 !important;
  }

  /* keep final clearing safety */
  .about-country-section .about-bullets::after {
    content: "" ;
    display: block;
    clear: both;
  }

}

</style>
<!-- CTA: Let's Build a Safer, Smarter Lab Together -->
<section class="cta-build-section">
  <div class="container">
    <div class="row align-items-center">

      <!-- LEFT: text (col-md-6) -->
      <div class="col-md-6 cta-left">
        <h2 class="cta-title">Building Efficient Laboratories For Tomorrow
</h2>
        <p class="cta-sub">
          Atico India is the leading laboratory glassware manufacturer in Malaysia. To enhance the efficiency and productivity of laboratories, we offer tailored solutions. Contact us today to know more. 
        </p>

        <a href="#contact" class="cta-btn">Get a Quote</a>
      </div>

      <!-- RIGHT: image (col-md-6) -->
      <div class="col-md-6 cta-right text-center">
        <img src="{{ asset('/assets/frontend/images/trolley.png') }}" alt="lab equipment" class="cta-img">
      </div>

    </div>
  </div>
</section>

<style>
/* CTA Build Section */
.cta-build-section { /*padding: 72px 0;*/ background: #fff; position: relative; }

/* left column */
.cta-left { padding: 14px 24px; }
.cta-title {
  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
  font-size: 48px;
  line-height: 1.01;
  font-weight: 800;
  margin: 0 0 18px;
  color: #111;
}
.cta-sub {
  color: #666;
  font-size: 16px;
  max-width: 560px;
  margin-bottom: 26px;
}

/* button */
.cta-btn {
  display: inline-block;
  background: #28166E;
  color: #fff;
  padding: 14px 30px;
  border-radius: 12px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 12px 34px rgba(53,17,95,0.14);
}
.cta-btn:hover { transform: translateY(-3px); }

/* right image */
.cta-right { padding: 14px 24px; }
.cta-img {
  max-width: 520px;
  width: 100%;
  height: auto;
  display: inline-block;
}

/* center the image vertically on larger screens */
@media (min-width: 992px) {
  .cta-right { text-align: right; }
  .cta-left { text-align: left; }
}

/* Responsive adjustments (col-md behavior preserved) */
@media (max-width: 991px) {
  .cta-build-section { padding: 44px 0; }
  .cta-title { font-size: 36px; }
  .cta-sub { max-width: 100%; }
  .cta-right { text-align: center; margin-top: 18px; }
  .cta-img { max-width: 320px; }
}

@media (max-width: 767px) {
    .cta-build-section {
        background-image: url("{{ asset('assets/frontend/images/mbg.png') }}") !important;
        background-position: center top;
    }
}
</style>


<!-- VALUE PROPOSITION SECTION -->
<section class="value-prop-section">
    <div class="container">
        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-md-6 vp-left">
                
                <p class="vp-eyebrow">Value Proposition <span></span></p>

                <h2 class="vp-title">
                   Quality Laboratory Glassware for Malaysia's Scientific & Industrial Needs
                </h2>

                <p class="vp-text">
                   Some of the demands from Malaysia's laboratory and scientific sectors include precise measurement, resistance to chemicals, and smooth workflow. Atico India meets such demands with quality-tested laboratory glassware that adheres to international laboratory standards. Our products enable Malaysian labs to conduct experiments safely, upgrading the accuracy of research studies and their operational reliability.

                </p>

                

                <a href="#contact" class="vp-btn">Get a Quote</a>
            </div>

            <!-- RIGHT GRID BOXES -->
            <div class="col-md-6 vp-right">

                <div class="row">
                    <!-- Box 1 -->
                    <div class="col-md-6 vp-box-col">
                        <div class="vp-box">
                            <div class="vp-icon">
                                <img src="{{ asset('assets/frontend/images/ic1.png') }}">
                            </div>
                            <p class="vp-box-title">Quality Assured</p>
                            <p class="vp-box-text">Products undergo rigorous testing; compliant with ISO & CE standards.</p>
                        </div>
                    </div>

                    <!-- Box 2 -->
                    <div class="col-md-6 vp-box-col">
                        <div class="vp-box">
                            <div class="vp-icon">
                                <img src="{{ asset('assets/frontend/images/ic2.png') }}">
                            </div>
                            <p class="vp-box-title">Innovative Technology</p>
                            <p class="vp-box-text">Modern design, efficient performance,<br> continuous R&amp;D.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Box 3 -->
                    <div class="col-md-6 vp-box-col">
                        <div class="vp-box">
                            <div class="vp-icon">
                                <img src="{{ asset('assets/frontend/images/ic3.png') }}">
                            </div>
                            <p class="vp-box-title">Customization</p>
                            <p class="vp-box-text">Tailored solutions to meet specific lab requirements.</p>
                        </div>
                    </div>

                    <!-- Box 4 -->
                    <div class="col-md-6 vp-box-col">
                        <div class="vp-box">
                            <div class="vp-icon">
                                <img src="{{ asset('assets/frontend/images/ic4.png') }}">
                            </div>
                            <p class="vp-box-title">Customer Support</p>
                            <p class="vp-box-text">Technical assistance, documentation, after-sales service.</p>
                        </div>
                    </div>
                </div>

            </div> <!-- end right -->
        </div>
    </div>
</section>

<style>
.value-prop-section { padding: 80px 0; }

/* left */
.vp-eyebrow { font-size:14px; font-weight:600; color:#6f2fa6; }
.vp-eyebrow span {
    display:inline-block;
    width:60px; height:2px;
    background:#6f2fa6;
    margin-left:10px;
}
.vp-title {
    font-size:42px;
    font-weight:800;
    line-height:1.1;
    margin:20px 0;
}
.vp-text { color:#555; font-size:16px; margin-bottom:18px; max-width:520px; }

.vp-btn {
    display:inline-block;
    background:#28166E;
    color:#fff;
    padding:12px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    box-shadow:0 12px 30px rgba(53,17,95,0.18);
}

/* right boxes */
.vp-box {
    background:#28166E;
    padding:44px 28px;
    border-radius:6px;
    color:#fff;
    text-align:center;
    min-height:260px;
    margin-bottom:22px;
}
.vp-icon img {
    width:60px;
    margin-bottom:16px;
}
.vp-box-title {
    font-size:20px;
    /*font-weight:700;*/
    margin-bottom:10px;
    color: #fff !important;

}
.vp-box-text {
    font-size:15px;
    line-height:1.6;
    color:#e8e8e8;
}

/* spacing inside right col */
.vp-right .row { margin-bottom:0; }

/* responsive */
@media (max-width:991px) {
    .vp-title { font-size:34px; }
    .vp-right { margin-top:32px; }
}
/* Keep right-side VP boxes exactly like desktop on mobile (2 x 2 grid) */
@media (max-width: 991px) {
  /* Make the container allow floated tiles */
  .vp-right { display:block !important; }

  /* Each column becomes half width (2-per-row) */
  .vp-box-col {
    width: 50% !important;
    float: left !important;
    box-sizing: border-box !important;
    padding-left: 8px !important;
    padding-right: 8px !important;
    margin-bottom: 16px !important;
  }

  /* Ensure rows that wrap don't break layout */
  .vp-right .row { margin-left: 0 !important; margin-right: 0 !important; }

  /* Keep the card full width of the tile */
  .vp-box {
    width: 100% !important;
    min-height: 220px !important;  /* slightly shorter on mobile, tweak as needed */
    padding: 28px 18px !important; /* reduce padding so two fit nicely */
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    border-radius: 8px !important;
  }

  /* Icon sizing and spacing */
  .vp-icon img {
    width: 56px !important;
    height: auto !important;
    margin-bottom: 12px !important;
    display: inline-block !important;
  }

  /* Titles and text */
  .vp-box-title {
    font-size: 18px !important;
    margin-bottom: 8px !important;
    line-height: 1.15 !important;
  }
  .vp-box-text {
    font-size: 14px !important;
    line-height: 1.5 !important;
    color: #e8e8e8 !important;
  }

  /* Clearfix after the rows */
  .vp-right::after {
    content: "" ;
    display: block;
    clear: both;
  }
}

</style>


<section class="featured-instruments-section">
  <div class="container">
    <div class="row featured-head">
      <div class="col-md-6">
        <p class="fi-eyebrow">Bestsellers <span></span></p>
        <h2 class="fi-title">Featured Instruments</h2>
      </div>
      <div class="col-md-6 text-right fi-intro">
        <p>Our Most in-Demand Laboratory Glassware</p>
      </div>
    </div>

    <div class="row fi-cards-wrap">
     
        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/beakers">
                <img src="{{ asset('/assets/frontend/images/beakers.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/product/beakers">Beakers</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/product/beakers" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/burette">
                <img src="{{ asset('/assets/frontend/images/burette.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/product/burette">Burette</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/product/burette" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/centrifuge-tube">
                <img src="{{ asset('/assets/frontend/images/centrifuge_tubes.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/product/centrifuge-tube">Centrifuge Tube</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/product/centrifuge-tube" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/conical-flask">
                <img src="{{ asset('/assets/frontend/images/flask.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/product/conical-flask">Flask</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/product/conical-flask" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/conical-flask">
                <img src="{{ asset('/assets/frontend/images/glass_bottle.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/category/reagent-bottle-with-screw-cap">Glass Bottle</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/category/reagent-bottle-with-screw-cap" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>

        <div class="col-md-4 fi-col">
          <article class="fi-card">
            <div class="fi-image">
              <a href="/product/conical-flask">
                <img src="{{ asset('/assets/frontend/images/standard_joints.png') }}" alt="Beakers" loading="lazy">
              </a>
            </div>

            <div class="fi-card-bottom">
              <div class="fi-card-row">
                <div class="fi-card-title">
                  <a href="/category/standard-joints">Standard Joints</a>
                </div>

                <div class="fi-icon-circle">
                  <!-- small icon (use your svg or image) -->
                  <img src="{{ asset('assets/frontend/images/instrument_icon.png') }}" alt="icon">
                </div>
              </div>

              <div class="fi-divider"></div>

              <div class="fi-card-footer">
                <a href="/category/standard-joints" class="fi-enquire">Enquiry Now <span class="arrow">→</span></a>
              </div>
            </div>
          </article>
        </div>
      
    </div>

  </div>
</section>
<style>
  /* ---------- Featured Instruments Section ---------- */
.featured-instruments-section { padding: 72px 0 90px; background:url("{{ asset('/assets/frontend/images/instrument_bg.png') }}") center center / cover no-repeat; position: relative; overflow: visible; }

/* heading row */
.featured-head { margin-bottom: 28px; align-items: baseline; }
.fi-eyebrow { color: #6f2fa6; font-weight:600; font-size:13px; margin:0 0 8px; display:inline-block; }
.fi-eyebrow span { display:inline-block; width:48px; height:2px; background:#6f2fa6; margin-left:10px; vertical-align:middle; }
.fi-title { font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif; font-size:44px; margin:0; font-weight:800; color:#111; line-height:1.02; }
.fi-intro p { color:#666; max-width:520px; margin: 6px 0 0 0; }

/* cards container */
.fi-cards-wrap { margin-top: 36px; }

/* column */
.fi-col { margin-bottom: 30px; }

/* card */
.fi-card {
  background: #fff;
  border-radius: 12px;
  overflow: visible;
  box-shadow: 0 18px 48px rgba(17,17,17,0.06);
  border: 1px solid rgba(17,17,17,0.03);
  transition: transform .22s ease, box-shadow .22s ease;
  min-height: 420px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}

/* top image area */
.fi-image {
  border-radius: 10px 10px 0 0;
  overflow: hidden;
  height: 260px;
  background: #fff;
  display:flex;
  align-items:center;
  justify-content:center;
}
.fi-image img {
  display:block;
  width:100%;
  height:100%;
  object-fit:cover;
      padding: 5px;
    border-radius: 12px;
}
}

/* bottom white overlay block (title + icon + link) */
.fi-card-bottom {
  background: #fff;
  padding: 18px 20px 20px;
  border-radius: 0 0 12px 12px;
  position: relative;
  z-index: 2;
}

/* title row contains title left and circular icon on right (overlapping) */
.fi-card-row {
  display:flex;
  align-items:center;
  justify-content: space-between;
  position: relative;
}

/* title */
.fi-card-title a {
  color: #111;
  font-weight:700;
  font-size:18px;
  text-decoration:none;
}

/* circular icon badge -- slightly overlaps card bottom edge visually in your screenshot */
.fi-icon-circle {
  width: 66px;
  height: 66px;
  border-radius: 50%;
  /*background: #3c1168;*/
  display:flex;
  align-items:center;
  justify-content:center;
  /*box-shadow: 0 18px 44px rgba(60,17,104,0.12);*/
  margin-left: 12px;
  flex-shrink:0;
  transform: translateY(-36px); /* lift it to overlap the top image */
}
.fi-icon-circle img { width:126px; height:104px; object-fit:contain; filter:brightness(10); }

/* thin divider under title */
.fi-divider {
  height: 1px;
  background: linear-gradient(to right, rgba(54,17,95,0.06), rgba(34,34,34,0.03));
  margin: 8px 0 12px 0;
}

/* footer (enquiry link) */
.fi-card-footer { padding-bottom: 6px; }
.fi-enquire {
  display:inline-block;
  color: #36115f;
  font-weight:700;
  text-decoration:none;
  padding: 8px 0;
}
.fi-enquire .arrow { margin-left:10px; opacity:0.9; }

/* hover */
.fi-card:hover { transform: translateY(-8px); box-shadow: 0 32px 80px rgba(17,17,17,0.12); }

/* small screens: use col-md only so stacked under 992px, but tweak card height & icon overlap */
@media (max-width: 991px) {
  .fi-title { font-size:36px; }
  .fi-image { height:220px; }
  .fi-card { min-height: auto; }
  .fi-icon-circle { transform: translateY(-28px); width:60px; height:60px; }
  .fi-icon-circle img { width:126px; height:104px; }
  .fi-card-bottom { padding-top: 10px; }
}

/* small tweak for very narrow phones */
@media (max-width: 480px) {
  .fi-title { font-size:28px; }
  .fi-image { height:200px; }
  .fi-icon-circle { transform: translateY(-24px); width:52px; height:52px; }
}
/* ===== replace existing fi-card styles with these to match target look ===== */

/* make entire card slightly taller and visually separated */
.fi-card {
  background: transparent;                 /* card background removed - we use bottom panel */
  border-radius: 12px;
  overflow: visible;
  min-height: 420px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  position: relative;
}

/* image should fill top area fully (no white bar) */
.fi-image {
  /*height: 320px;  */                         /* taller image like your screenshot */
  width: 100%;
  overflow: hidden;
  border-radius: 12px;                     /* round the top corners */
  box-shadow: 0 8px 30px rgba(17,17,17,0.04);
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
}

/* image cover */


/* white bottom panel that sits overlapping the lower portion of the image */
.fi-card-bottom {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 20px 60px rgba(17,17,17,0.06);
  padding: 28px 22px 20px;
  margin: -44px 18px 18px;                 /* negative top margin to overlap image */
  position: relative;
  z-index: 2;
}

/* Row inside bottom panel: title left, icon placeholder removed from inside panel */
.fi-card-row {
  display:flex;
  align-items: center;
  justify-content: flex-start;
}

/* Title styling */
.fi-card-title a {
  font-size: 20px;
  font-weight: 800;
  color:#111;
  text-decoration:none;
}

/* small thin divider (same as screenshot) */
.fi-divider {
  height: 1px;
  background: #ececec;
  margin: 16px 0 18px;
}

/* enquiry link */
.fi-card-footer { padding-bottom: 6px; }
.fi-enquire {
  color: #36115f;
  font-weight:700;
  text-decoration:none;
}

/* ----- circular purple icon overlapping image (positioned outside .fi-card-bottom) ----- */
.fi-icon-circle {
  width: 66px;
  height: 66px;
  border-radius: 50%;
  /*background: #3c1168;*/
  display:flex;
  align-items:center;
  justify-content:center;
  /*box-shadow: 0 22px 40px rgba(60,17,104,0.14);*/
  position: absolute;
  right: -5px;                              /* push to the right edge of the card */
  top: -17px;                               /* place it overlapping the bottom of the image */
  z-index: 6;
  transform: translateY(0);
}

/* small white inner "icon" (if you use svg with strokes they'll show) */
.fi-icon-circle img {
  width: 126px;
  height: 104px;
  object-fit: contain;
  filter: none;                             /* remove brightness filter so white stroke visible */
}

/* adjust for small screens: icon & overlap positions */
@media (max-width: 991px) {
  .fi-image { height: 240px; }
  .fi-card { min-height: auto; }
  .fi-card-bottom { margin-top: -36px; margin-left: 12px; margin-right: 12px; padding: 20px; }
  .fi-icon-circle { top: 200px; right: 18px; width:56px; height:56px; }
  .fi-icon-circle img { width: 90px; height:80px; }
  .fi-card-title a { font-size: 18px; }
}

/* very small phones */
@media (max-width: 480px) {
  .fi-image { height: 200px; }
  .fi-icon-circle { top: -9px; right: 14px; width:50px; height:50px; }
}
/* make image container a positioning context for the icon */
.fi-image { position: relative; }

/* position icon anchored to image bottom (overlap) */
.fi-icon-circle {
  position: absolute;
  right:-6px;          /* distance from right edge of image */
  bottom: -33px;        /* half of icon height to overlap image/bottom panel */
  width: 66px;
  height: 66px;
  border-radius: 50%;
  /*background: #3c1168;*/
  display:flex;
  align-items:center;
  justify-content:center;
  /*box-shadow: 0 22px 40px rgba(60,17,104,0.14);*/
  z-index: 6;
}

/* responsive */
@media (max-width: 991px) {
  .fi-icon-circle { width:56px; height:56px; bottom: -28px; right: 14px; }
}

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<section class="testimonials-section" style="display: none !important">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <p class="ts-eyebrow">Testimonials</p>
        <h2 class="ts-title">What Our Clients Say</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">

        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">

          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#testimonialCarousel" data-slide-to="1"></li>
            <li data-target="#testimonialCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Slides -->
          <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="item active">
              <div class="ts-slide text-center">
                <div class="ts-avatar">
                  <img src="{{ asset('/assets/frontend/images/review1.png') }}" alt="">
                </div>
                <h4 class="ts-name">Ronald Richards</h4>
                <div class="ts-role">Co, Founder</div>

                <div class="ts-quote">
                  Sed ante elit, fringilla vitae laoreet sit amet, tempus et libero. Lorem ipsum dolor sit amet,
                  consectetur adipiscing elit. Pellentesque finibus ut erat in sagittis.
                </div>

                <div class="ts-rating">
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star">&#9733;</span>
                </div>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="item">
              <div class="ts-slide text-center">
                <div class="ts-avatar">
                  <img src="{{ asset('assets/frontend/images/review3.png') }}" alt="">
                </div>
                <h4 class="ts-name">Jacob Wells</h4>
                <div class="ts-role">Lab Director</div>

                <div class="ts-quote">
                  Exceptional quality and service. The instruments perform flawlessly and support has been excellent.
                </div>

                <div class="ts-rating">
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                </div>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="item">
              <div class="ts-slide text-center">
                <div class="ts-avatar">
                  <img src="{{ asset('assets/frontend/images/review2.png') }}" alt="">
                </div>
                <h4 class="ts-name">Sophia Allen</h4>
                <div class="ts-role">Research Scientist</div>

                <div class="ts-quote">
                  Their lab equipment helped us improve efficiency. Highly recommended for research facilities.
                </div>

                <div class="ts-rating">
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star star-on">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                </div>
              </div>
            </div>

          </div>

          <!-- Controls -->
         <!--  <a class="left carousel-control" href="#testimonialCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#testimonialCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a> -->

        </div>

      </div>
    </div>
  </div>
</section>
<style>
  .testimonials-section {
  position: relative;
  padding: 80px 0 110px;
    background: url("{{ asset('/assets/frontend/images/ml-bg-d.png') }}") center center / cover no-repeat;

}
@media (max-width: 767px) {
    .testimonials-section {
        background-image: url("{{ asset('assets/frontend/images/ml-bg-m.png') }}") !important;
        background-position: center top;
    }
}
.ts-eyebrow {
  color: #6f2fa6;
  font-weight: 600;
  font-size: 13px;
  margin-bottom: 6px;
}

.ts-title {
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 18px;
  color: #111;
}

.ts-slide { padding: 30px 40px 20px; min-height: 260px; }

.ts-avatar {
  width: 86px;
  height: 86px;
  margin: 0 auto 10px;
  border-radius: 50%;
  overflow: hidden;
  border: 6px solid #fff;
  box-shadow: 0 6px 22px rgba(17,17,17,0.06);
}

.ts-avatar img { width: 100%; height: 100%; object-fit: cover; }

.ts-name {
  margin: 12px 0 6px;
  font-size: 18px;
  font-weight: 700;
  color: #2b1b4b;
}

.ts-role { color: #777; margin-bottom: 14px; }

.ts-quote {
  max-width: 900px;
  margin: 0 auto 18px;
  font-size: 18px;
  line-height: 1.7;
  color: #4e4e4e;
}

.star { font-size: 20px; color: #ddd; margin: 0 4px; }
.star-on { color: #f6a84b; }

/* Indicators */
.carousel-indicators li {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #ddd;
  border: none;
}
.carousel-indicators {
        bottom: -17px !important;
    }
}
.carousel-indicators .active {
  background: #cfcfcf;
}

/* Controls */
.carousel-control .glyphicon { color: rgba(0,0,0,0.6); }
.carousel-control.right,.carousel-control.left{
  background-image: unset !important;
}
</style>
<script>
  $('#testimonialCarousel').carousel({
  interval: 6000,
  pause: 'hover'
});

</script>


<section class="faq-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <p class="faq-eyebrow">FAQs</p>
                <h2 class="faq-title">Frequently Ask Questions</h2>
            </div>
        </div>

        <div class="row">

            <!-- LEFT COL -->
            <div class="col-md-6">

                <div class="faq-box">
                    <div class="faq-header active">
                        <span class="faq-icon minus">–</span>
                        Does Atico India supply laboratory glassware across Malaysia?

                    </div>
                    <div class="faq-body" style="display:block;">
                        Yes. Being a leading laboratory glassware supplier in Malaysia, fast and reliable delivery is ensured. We supply laboratory glassware to universities, schools, testing facilities, and industries in Malaysia on time.
                    </div>
                </div>

                <div class="faq-box">
                    <div class="faq-header">
                        <span class="faq-icon">+</span>
                        What makes Atico India a trusted laboratory glassware manufacturer in Malaysia?
                    </div>
                    <div class="faq-body">
                       We use superior quality borosilicate glass and advanced manufacturing technology, together with precision calibration according to international export standards.

                    </div>
                </div>

                 <div class="faq-box">
                    <div class="faq-header">
                        <span class="faq-icon">+</span>
                        How does Atico India ensure safe delivery from India to Malaysia? 


                    </div>
                    <div class="faq-body">
                        All glassware is packed in shock-proof and break-resistant export packaging that ensures each item arrives in Malaysia safely. 


                    </div>
                </div>

            </div>

            <!-- RIGHT COL -->
            <div class="col-md-6">

                <div class="faq-box">
                    <div class="faq-header">
                        <span class="faq-icon">+</span>
                        Does Atico India accept bulk orders from Malaysian institutions?

                    </div>
                    <div class="faq-body">
                        Yes, we welcome bulk orders from both educational and industrial laboratories, offering special pricing on volume orders. 

                    </div>
                </div>

                <div class="faq-box">
                    <div class="faq-header">
                        <span class="faq-icon">+</span>
                        What kind of laboratory glassware does Atico India supply? 

                    </div>
                    <div class="faq-body">
                        Beakers, conical flasks, volumetric flasks, burettes, pipettes, measuring cylinders, reagent bottles, condensers, and many more. 

                    </div>
                </div>



            </div>

        </div>
    </div>
</section>
<style>
  .faq-section {
    padding: 60px 0 100px;
}

.faq-eyebrow {
    font-size: 14px;
    color: #6f2fa6;
    font-weight: 600;
    margin-bottom: 6px;
    letter-spacing: 1px;
}

.faq-title {
    font-size: 48px;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 45px;
}

.faq-box {
    background: #fff;
    border-radius: 12px;
    padding: 25px 28px;
    margin-bottom: 28px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    cursor: pointer;
    transition: all 0.3s;
}

.faq-box:hover {
    box-shadow: 0 14px 46px rgba(0,0,0,0.10);
}

.faq-header {
    font-size: 20px;
    font-weight: 700;
    color: #3a2b76;
    display: flex;
    align-items: center;
}

.faq-header.active {
    color: #3a2b76;
}

.faq-icon {
    font-size: 32px;
    font-weight: 700;
    margin-right: 14px;
    color: #3a2b76;
    width: 32px;
    display: inline-block;
    text-align: center;
}

.faq-icon.minus {
    font-size: 40px;
    margin-top: -4px;
}

.faq-body {
    display: none;
    padding: 18px 0 5px 48px;
    color: #666;
    line-height: 1.7;
    font-size: 16px;
}

</style>
<script>
  $('.faq-header').click(function () {
    var parent = $(this).closest('.faq-box');

    // toggle content
    parent.find('.faq-body').slideToggle(250);

    // toggle active class
    $(this).toggleClass('active');

    // toggle icons
    var icon = $(this).find('.faq-icon');
    icon.text(icon.text() === '+' ? '–' : '+');
});

</script>

<!-- Connect With Us Section -->
<section class="connect-section" id="contact">
  <div class="container">
    <div class="row">

      <!-- LEFT: Contact form (col-md-6) -->
      <div class="col-md-6">
        <div class="connect-card">
          <h2 class="connect-title">Connect With Us</h2>

         <form action="{{ route('enquiry.store') }}" method="post" class="wpcf7-form" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input style="height: 35px !important;" type="text" required="true" name="name" value="{{ old('name') }}" class="wpcf7-form-control wpcf7-text form-control rounded-0" placeholder="First Name*" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input style="height: 35px !important;" type="email" required="true" name="email" value="{{ old('email') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Email*"/>
                </div>
              </div>
            </div>

            <div class="form-group">
             <input style="height: 35px !important;" type="number" min="0" required="true" name="mobile_no" value="{{ old('mobile_no') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Mobile Number" />
            </div>

            <div class="form-group">
              <select style="height: 35px !important;" required="true" name="country" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" aria-invalid="false" >
                    <option value="">Select Country</option>
                    @foreach(getCountries() as $key => $country)
                    <option value="{!! $country->name !!}">{!! $country->name !!}</option>
                    @endforeach
                  </select>
            </div>
<?php
$min  = 1;
$max  = 300;
$num1 = rand( $min, $max );
$num2 = rand( $min, $max );
$sum  = $num1 + $num2;
?>
            <div class="form-group">
              <textarea required="true" name="message" cols="80" rows="5" class="wpcf7-form-control wpcf7-textarea form-control rounded-0" placeholder="How can we help?" style="height: 65px !important;">{!! old('message') !!}</textarea>
            </div>

            <div class="form-group">
              <input type="file" name="file_name" id="file_name" accept=".xls,.xlsx,.pdf">
            </div>

            <div class="form-group">
             <div class="g-recaptcha" data-sitekey="6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_"></div>


            </div>
<input type="hidden" name="page_url" value=<?=  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?> >

             <input type="hidden" name="ip_address" id="ip_address">
            <button data-res="<?php echo $sum; ?>" type="submit" class="get_quote_btn">send message</button>
          </form>
        </div>
      </div>

      <!-- RIGHT: image (col-md-6) -->
      <div class="col-md-6">
        <div class="connect-image-wrap">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16304592.21260951!2d88.7678764627032!3d3.892747164869544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2sin!4v1765370851372!5m2!1sen!2sin" width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <!-- <img src="{{ asset('/assets/frontend/images/malaysia_map.png') }}" alt="map" class="connect-image"> -->
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Styles for Connect With Us -->
<style>
/* Layout */
.connect-section { padding: 60px 0 80px; background: #fff; }
.connect-card {
  background: #f6f6fb; /* very light violet as in screenshot */
  padding: 42px 36px;
  border-radius: 2px;
  min-height: 520px;
  box-shadow: none;
}

/* Title */
.connect-title {
  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
  font-size: 48px;
  font-weight: 800;
  margin: 0 0 26px;
  color: #111;
}

/* form inputs: plain boxed style as screenshot */
.plain-input {
  background: transparent;
  border: 1px solid rgba(0,0,0,0.18);
  border-radius: 2px;
  padding: 14px 12px;
  height: 48px;
  box-shadow: none;
  color: #666;
}
.plain-input:focus { outline: none; box-shadow: none; border-color: rgba(54,17,95,0.12); }

/* textarea */
textarea.plain-input { height: 140px; resize: vertical; padding-top:12px; }

/* submit */
.connect-submit {
  margin-top: 12px;
  background: #28166E;
  border-color: #28166E;
  color: #fff;
  padding: 12px 26px;
  border-radius: 10px;
  box-shadow: 0 12px 30px rgba(53,17,95,0.12);
}

/* right image */
.connect-image-wrap {
  /*background: #f0e2cc;*/ /* subtle background like screenshot */
  /*height: 520px;*/
  display:flex;
  align-items:center;
  justify-content:center;
  padding: 18px;
  box-sizing: border-box;
}
.connect-image {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  display:block;
}

/* small screens - preserve col-md stacking automatically under 992px */
@media (max-width: 991px) {
  .connect-card { min-height: auto; padding: 28px 18px; }
  .connect-title { font-size: 36px; margin-bottom: 18px; }
  .connect-image-wrap { height: 320px; margin-top: 18px; }
}

/* Optional: style placeholder color */
::placeholder { color: #bdbdbd; }

/* Optional: make Bootstrap .form-control not override our input height too much */
.form-control { box-shadow: none; }

/* If you want subtle border rounding on inputs (similar to screenshot), you can adjust radius */
.plain-input { border-radius: 2px; }
</style>
<div id="successModal" class="modal fade">
      <div class="modal-dialog modal-confirm">
        <div class="modal-content">
          <div class="modal-header">
            <div class="icon-box">
              <i class="material-icons">&#xE876;</i>
            </div>
            <h4 class="modal-title">Success!</h4>
          </div>
          <div class="modal-body">
            <p class="text-center mb-0" id="modal_success_message"> Success </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
   @if (Session::has('success'))
   $("#modal_success_message").html( "{!! Session::get('success') !!}" );
   $('#successModal').modal('show');
   //swal('Success!', "{{ Session::get('success') }}", 'success');
   @endif

    document.addEventListener("DOMContentLoaded", function() {
            // Fetch the IP address from the API
            fetch("https://api.ipify.org?format=json")
                .then(response => response.json())
                .then(data => {
                    // Display the IP address on the screen
                    document.getElementById("ip_address").value = data.ip;
                })
                .catch(error => {
                    console.error("Error fetching IP address:", error);
                });
        });
</script>
@endsection
