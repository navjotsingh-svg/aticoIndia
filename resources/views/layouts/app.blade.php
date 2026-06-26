<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Atico India')</title>
    <meta name="description" content="@yield('meta_description', 'Educational science lab equipment manufacturer, supplier and exporter in India and worldwide.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v=19">
</head>
@php
    $currentSlug = request()->route('slug');
    $isCatalogPage = request()->routeIs('category.show', 'products.show', 'products.index', 'categories.index', 'group.categories', 'blog.*');
@endphp
<body class="@trim(trim($__env->yieldContent('body_class')) . ($isCatalogPage ? ' page-catalog' : ''))">
<header class="site-header">
    <div class="header-top">
        <div class="container header-top-inner">
            <div class="header-contact">
                <a href="tel:+919996186555"><i class="fa fa-phone"></i> +91-9996186555</a>
                <a href="tel:+919896793832">+91-9896793832</a>
                <a href="mailto:sales@aticoindia.com"><i class="fa fa-envelope-o"></i> sales@aticoindia.com</a>
            </div>
            <div class="header-quicklinks">
                <a href="{{ route('categories.index') }}">OEM &amp; Tenders</a>
                <a href="{{ route('home') }}#quote">Get Quote</a>
            </div>
        </div>
    </div>

    <div class="header-main">
        <div class="container header-main-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="Atico India">
                <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="Atico India" onerror="this.style.display='none';this.nextElementSibling.style.display='inline-block';">
                <span class="brand-fallback" style="display:none;">Atico India</span>
            </a>
            <button
                type="button"
                class="site-nav-toggle"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="site-nav-panel"
            >
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <form class="header-search" method="get" action="{{ route('products.index') }}">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search lab equipment...">
                <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
            </form>
            <nav class="header-links" aria-label="Main">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('categories.index') }}">Categories</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ route('home') }}#quote">Contact</a>
            </nav>
            <a href="{{ route('home') }}#quote" class="btn btn-header-cta">Request Quote</a>
        </div>
    </div>

    <div id="site-nav-panel" class="site-nav-panel">
        <nav class="header-links header-links--mobile" aria-label="Main navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('blog.index') }}">Blog</a>
            <a href="{{ route('home') }}#quote">Contact</a>
            <a href="{{ route('home') }}#quote" class="btn btn-header-cta btn-header-cta--mobile">Request Quote</a>
        </nav>

    @if(!empty($groups) && count($groups))
        <nav class="category-strip" aria-label="Product categories">
            <div class="container">
                <div class="category-nav-scroll">
                    <ul class="main-menu-header">
                        @foreach($groups as $group)
                            @php
                                $hasChildren = !empty($group->categories) && count($group->categories);
                                $groupActive = $currentSlug && (
                                    $currentSlug === $group->route
                                    || (
                                        $hasChildren
                                        && $group->categories->contains(function ($cat) use ($currentSlug) {
                                            return $cat->slug === $currentSlug
                                                || (!empty($cat->sub_categories) && $cat->sub_categories->contains(function ($sub) use ($currentSlug) {
                                                    return $sub->slug === $currentSlug;
                                                }));
                                        })
                                    )
                                );
                            @endphp
                            <li class="menu-item-has-children{{ $groupActive ? ' is-current' : '' }}">
                                <a href="{{ groupMenuUrl($group) }}">
                                    <span>{{ $group->name }}</span>
                                    @if($hasChildren)
                                        <i class="fa fa-chevron-down menu-caret" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if($hasChildren)
                                    <ul class="sub-menu">
                                        @foreach($group->categories->take(9) as $child)
                                            @php
                                                $childActive = $currentSlug === $child->slug;
                                                $hasSubChildren = !empty($child->sub_categories) && count($child->sub_categories);
                                                $subChildActive = $hasSubChildren && $child->sub_categories->contains(function ($sub) use ($currentSlug) {
                                                    return $sub->slug === $currentSlug;
                                                });
                                            @endphp
                                            <li class="{{ $hasSubChildren ? 'has-sub-children' : '' }}{{ ($childActive || $subChildActive) ? ' is-current' : '' }}">
                                                <a href="{{ route('category.show', $child->slug) }}" class="{{ $childActive ? 'is-active' : '' }}">
                                                    {{ $child->short_name ?: $child->name }}
                                                    @if($hasSubChildren)
                                                        <i class="fa fa-angle-right sub-caret" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                                @if($hasSubChildren)
                                                    <ul class="sub-menu-nested">
                                                        @foreach($child->sub_categories->take(15) as $sub)
                                                            <li>
                                                                <a href="{{ route('category.show', $sub->slug) }}" class="{{ $currentSlug === $sub->slug ? 'is-active' : '' }}">
                                                                    {{ $sub->short_name ?: $sub->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                        @if($child->sub_categories->count() > 15)
                                                            <li class="sub-menu-item--more">
                                                                <a href="{{ route('category.show', $child->slug) }}">View More</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                        @if($group->categories->count() > 9)
                                            <li class="sub-menu-item--more">
                                                <a href="{{ route('group.categories', $group->id) }}">View More</a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li class="{{ request()->routeIs('categories.index') ? 'is-current' : '' }}">
                            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'is-active' : '' }}">
                                <span>More</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    </div>
    <div class="site-nav-backdrop" hidden></div>
</header>

@hasSection('page_head')
    @yield('page_head')
@endif

<main class="site-main">
    @if (session('success'))
        <div class="container"><div class="alert">{{ session('success') }}</div></div>
    @endif
    @if ($errors->any())
        <div class="container">
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @hasSection('full_width')
        @yield('content')
    @else
        <div class="container page-content">
            @yield('content')
        </div>
    @endif
</main>

<footer class="site-footer-top">
    <div class="container footer-links-grid">
        @if(!empty($groups))
            @foreach($groups as $group)
                <div class="footer-link-block">
                    <h5><a href="{{ groupMenuUrl($group) }}">{{ $group->name }}</a></h5>
                    @if(!empty($group->categories))
                        @foreach($group->categories->take(6) as $child)
                            <div><a href="{{ route('category.show', $child->slug) }}">{{ $child->short_name ?: $child->name }}</a></div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</footer>

<footer class="site-footer-bottom">
    <div class="container footer-bottom-inner">
        <div>
            <h4>Atico India</h4>
            <p class="footer-tagline">Educational &amp; scientific lab equipment manufacturer, supplier &amp; exporter.</p>
            <div class="bottom-links">
                <a href="{{ route('home') }}">About</a>
                <a href="{{ route('categories.index') }}">Lab Tenders</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ route('home') }}#quote">Contact</a>
            </div>
        </div>
        <div class="social-links">
            <a href="https://www.facebook.com/aticoexport" target="_blank" rel="noreferrer" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://twitter.com/aticoindia" target="_blank" rel="noreferrer" aria-label="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="https://www.linkedin.com/in/aticoexport/" target="_blank" rel="noreferrer" aria-label="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            <a href="https://www.pinterest.com/aticoexports/" target="_blank" rel="noreferrer" aria-label="Pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/aticoindia/" target="_blank" rel="noreferrer" aria-label="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="container">
        <p class="country-text">Serving clients worldwide including India, USA, UK, UAE, Nigeria, Kenya, Malaysia, Australia, Germany, France, and 80+ more countries.</p>
        <div class="copyright">Copyright &copy; {{ date('Y') }} Atico India. All rights reserved.</div>
    </div>
</footer>

@stack('scripts')
<script>
(() => {
    const body = document.body;
    const navToggle = document.querySelector('.site-nav-toggle');
    const navPanel = document.getElementById('site-nav-panel');
    const navBackdrop = document.querySelector('.site-nav-backdrop');
    const topItems = document.querySelectorAll('.main-menu-header > .menu-item-has-children');

    const isMobileNav = () => window.matchMedia('(max-width: 991px)').matches;

    const syncNavPanelTop = () => {
        const header = document.querySelector('.site-header');
        if (!header) return;
        document.documentElement.style.setProperty('--mobile-nav-top', `${header.offsetHeight}px`);
    };

    const setNavOpen = (open) => {
        body.classList.toggle('nav-open', open);
        if (navToggle) {
            navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
            const icon = navToggle.querySelector('.fa');
            if (icon) {
                icon.classList.toggle('fa-bars', !open);
                icon.classList.toggle('fa-times', open);
            }
        }
        if (navBackdrop) {
            navBackdrop.hidden = !open;
        }
        if (!open) {
            closeDropdowns();
        }
    };

    const closeDropdowns = () => {
        topItems.forEach((el) => el.classList.remove('is-open'));
        document.querySelectorAll('.sub-menu > li.has-sub-children').forEach((el) => el.classList.remove('is-open'));
    };

    if (navToggle && navPanel) {
        navToggle.addEventListener('click', () => {
            setNavOpen(!body.classList.contains('nav-open'));
        });

        navBackdrop?.addEventListener('click', () => setNavOpen(false));

        navPanel.querySelectorAll('a[href]:not([href="#"])').forEach((link) => {
            link.addEventListener('click', () => {
                if (isMobileNav()) {
                    setNavOpen(false);
                }
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setNavOpen(false);
            }
        });

        window.addEventListener('resize', () => {
            syncNavPanelTop();
            if (!isMobileNav()) {
                setNavOpen(false);
            }
        });

        syncNavPanelTop();
        window.addEventListener('load', syncNavPanelTop);
    }

    if (!topItems.length) return;

    topItems.forEach((item) => {
        const trigger = item.querySelector(':scope > a');
        const submenu = item.querySelector(':scope > .sub-menu');
        if (!trigger || !submenu) return;

        item.addEventListener('mouseenter', () => {
            if (isMobileNav()) return;
            topItems.forEach((el) => { if (el !== item) el.classList.remove('is-open'); });
            item.classList.add('is-open');
        });

        item.addEventListener('mouseleave', () => {
            if (isMobileNav()) return;
            item.classList.remove('is-open');
        });

        trigger.addEventListener('click', (event) => {
            if (!isMobileNav()) return;
            event.preventDefault();
            const open = item.classList.contains('is-open');
            closeDropdowns();
            if (!open) item.classList.add('is-open');
        });
    });

    document.querySelectorAll('.sub-menu > li.has-sub-children').forEach((item) => {
        const link = item.querySelector(':scope > a');
        if (!link) return;

        item.addEventListener('mouseenter', () => {
            if (isMobileNav()) return;
            document.querySelectorAll('.sub-menu > li.has-sub-children').forEach((el) => {
                if (el !== item) el.classList.remove('is-open');
            });
            item.classList.add('is-open');
        });

        link.addEventListener('click', (event) => {
            if (!isMobileNav()) return;
            event.preventDefault();
            event.stopPropagation();
            item.classList.toggle('is-open');
        });
    });

    document.addEventListener('click', (event) => {
        if (!isMobileNav()) return;
        if (event.target instanceof Element && event.target.closest('.category-strip, .site-nav-panel')) return;
        closeDropdowns();
    });
})();
</script>
@if(config('inquiry.recaptcha_site_key'))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
</body>
</html>
