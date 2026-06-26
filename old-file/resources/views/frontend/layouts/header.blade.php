@php

$route  = \Route::currentRouteName();

@endphp
<style type="text/css">
   
   .sub-menu,.sub-sub-menu{
  display: none;

}
.menusub{
  padding: 20px;

    overflow-y: auto;
    max-height: 300px;
}
</style>
<div id="ts-stickable-header-w" class="ts-stickable-header-w ts-bgcolor-custom">

   <div id="site-header" class="site-header ts-bgcolor-custom ts-sticky-bgcolor-white ts-responsive-icon-dark ts-header-menu-position-right ts-mmmenu-override-yes ts-above-content-yes  ts-stickable-header new-header">

      <div class="site-header-main ts-table container-fluid container">

         

         <div class="row">

            <div class="col-xl-1 col-lg-6 "></div>

            <div class="col-xl-11 col-lg-6 text-right h1-header-info-area py-1 px-0 h1-header-top-area">

               <div class="h1-single-top-block text-center">

                  <i class="fa fa-phone" aria-hidden="true"></i>

                  <strong>Call:</strong>

                  <span> <a href="tel:+919996186555">+91-9996186555 </a></span>
                  |
                   <span> <a href="tel:+919896793832">+91-9896793832 </a></span>
               </div>

                  <div class="h1-single-top-block text-center">

            <i class="fa fa-envelope-o" aria-hidden="true"></i>

            <strong>Email:</strong>

            <a href="mailto:sales@aticoindia.com" target="_top"> sales@aticoindia.com</a>

         </div>

      </div>

   </div>

   <!-- .site-header-menu -->

</div>

<!-- .site-header-main -->

</div>

</div>

@if(request()->is('/'))

    <div id="ts-home">

        <!-- Your content for the home page goes here -->

    </div>

@endif



<div class="main-holder">

<div id="page" class="hfeed site">

<header id="masthead" class=" ts-header-style-classic themestek-main-menu-total-6">

   <!-- <div class="top-bar">

   <div id="ts-stickable-header-w" class="ts-stickable-header-w ts-bgcolor-custom">

   <div id="site-header" class="site-header ts-bgcolor-custom ts-sticky-bgcolor-white ts-responsive-icon-dark ts-header-menu-position-right ts-mmmenu-override-yes ts-above-content-yes  ts-stickable-header new-header">

      <div class="site-header-main ts-table container-fluid container">

         

         <div class="row">

            <div class="col-xl-6 col-lg-6 "></div>

            <div class="col-xl-6 col-lg-6 text-right h1-header-info-area py-1 px-0 h1-header-top-area">

               <div class="h1-single-top-block text-center">

                  <i class="fa fa-phone" aria-hidden="true"></i>

                  <strong>Call:</strong>

                  <span> <a href="tel:+919996186555">+91-9996186555 </a></span><a href="tel:+919996186555">

               </a></div><a href="tel:+919996186555">

            </a><div class="h1-single-top-block text-center"><a href="tel:+919996186555">

            <i class="fa fa-envelope-o" aria-hidden="true"></i>

            <strong>Email:</strong>

            </a><a href="mailto:sales@aticoindia.com" target="_top"> sales@aticoindia.com</a>

         </div>

      </div>

   </div> -->

   <!-- .site-header-menu -->

</div>

<!-- .site-header-main -->

</div>

</div>

</div>

   <div class="ts-header-block  ts-mmenu-active-color-skin ts-dmenu-active-color-skin ts-dmenu-sep-grey">

      <div class="ts-search-overlay">

         <div class="ts-icon-close"></div>

         <div class="ts-search-outer">

            <div class="ts-search-logo">

               @if($route == 'home')

              <!--  <img src="{{ asset('assets/frontend/images/white-logo.png') }}" alt="AticoIndia" /> -->

               @else

               <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="AticoIndia" />

               @endif

            </div>



            <form action="{{ route('product_search') }}" class="ts-site-searchform" method="post">

               {!! csrf_field() !!}

               <input class="main-search-new field searchform-s" name="q" id="transcript" type="search" placeholder="Search Product By Name....">

               <button type="submit"><span class="ts-labtechco-icon-search"></span></button>

            </form>





         </div>

      </div>

      <div id="ts-stickable-header-w" class="ts-stickable-header-w ts-bgcolor-custom" style="height:60px">

         <div id="site-header" class="site-header ts-bgcolor-custom ts-sticky-bgcolor-white ts-responsive-icon-dark ts-header-menu-position-right ts-mmmenu-override-yes ts-above-content-yes  ts-stickable-header main-header">

            <div class="site-header-main ts-table container">

               <div class="site-branding ts-table-cell">

                  <div class="headerlogo headerlogo-new themestek-logotype-image ts-stickylogo-yes">

                     <span class="site-title"><a class="home-link" href="{{ route('home') }}" title="LabtechCO"><span class="ts-sc-logo ts-sc-logo-type-image">

                        @if($route == 'home')

                        <img class="themestek-logo-img standardlogo" alt="LabtechCO" src="{{ asset('assets/frontend/images/logo.png') }}">

                         <img class="themestek-logo-img crosslogo crosslogo-new" alt="LabtechCO" src="{{ asset('assets/frontend/images/white-logo.png') }}">

                        <img class="themestek-logo-img stickylogo" alt="LabtechCO" src="{{ asset('assets/frontend/images/white-logo.png') }}"> 

                        @else

                        <img class="themestek-logo-img standardlogo" alt="LabtechCO" src="{{ asset('assets/frontend/images/logo.png') }}">

                        <img class="themestek-logo-img crosslogo" alt="LabtechCO" src="{{ asset('assets/frontend/images/logo.png') }}">

                        <img class="themestek-logo-img stickylogo" alt="LabtechCO" src="{{ asset('assets/frontend/images/logo.png') }}">

                        

                        @endif

                     </span></a></span>

                  </div>

               </div>

               <!-- .site-branding -->

               <div id="site-header-menu" class="site-header-menu ts-table-cell">

                  <nav id="site-navigation" class="main-navigation main-navigation-new" aria-label="Primary Menu" data-sticky-height="90">

                     <div class="ts-header-icons "><span class="ts-header-icon ts-header-search-link"><a href="#"><i class="ts-labtechco-icon-search-2"></i></a></span></div>

                     <button id="menu-toggle" class="menu-toggle">

                     <span class="ts-hide">Toggle menu</span><i class="ts-labtechco-icon-bars"></i>

                     </button>

                     <div class="nav-menu">

                        <ul id="menu-main-menu" class="nav-menu">

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('about_us_page') }}">About Us</a></li>

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('certificate_page') }}">Certificate</a></li>

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('lab_tender_page') }}">Lab Tenders</a></li>

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('faq_page') }}">Faq</a></li>

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('blog_page') }}">Blog</a></li>

                           <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="{{ route('contact_us_page') }}">Contact Us</a></li>
                           @if($display==0)
    <li class="nav-item dropdown" id="myDropdown">
      <a class="nav-link dropdown-toggle main-menu" href="#" data-bs-toggle="" style="<?php if($display==0) echo "padding-top: 25px;"; ?>"> Product Catalog  </a>
      <div class="menu-sub sub-menu" style="border:1px solid lightgray;">
        @foreach(getGroups() as $key => $group)
        <p class="cclink">
         <a class="" href="{{ route('categories', $group->route) }}" style="
    font-size: 15px;
    padding: 6px;
    color: #0a58ca;
    text-decoration: none;z-index: 9999999;">{!! $group->name !!}</a>
    <span class="show-sub" style="font-weight: 700;float: right;">+</span>
  </p>
  <div class="sub-sub-menu menusub">
      @foreach($group->categories as $key => $category)
        <p class="mb-0" style="padding:10px;border-bottom:1px solid #DFDFDF;"><a style="text-decoration:none;color:#000;" href="{{ route('categories', $category->slug) }}">{!! isset($category->short_name)?$category->short_name:$category->name !!}</a></p>
      @endforeach
  </div>
    @endforeach
    <!-- <div class="accordion " id="accordionExample">
     @foreach(getGroups() as $key => $group)
    <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $key ?>" aria-expanded="false" aria-controls="collapseOne<?= $key ?>">
      
      </button>
      <a class="clink" href="{{ route('categories', $group->route) }}" style="margin-top: -43px;
    position: absolute;
    font-size: 15px;
    padding: 6px;
    color: #0a58ca;
    text-decoration: none;z-index: 9999999;">{!! $group->name !!}</a>
    </h2>
    <div id="collapseOne<?= $key ?>" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      @foreach($group->categories as $key => $category)

<p class="mb-0" style="padding:10px;border-bottom:1px solid #DFDFDF;"><a style="text-decoration:none;color:black;" href="{{ route('categories', $category->slug) }}">{!! isset($category->short_name)?$category->short_name:$category->name !!}</a></p>

@endforeach  </div>
    </div>
     </div>
    @endforeach
    </div> -->
      </div>
    </li>
    @endif
                     <!-- <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="../contacts/index.html">Contacts</a></li> -->

                  </ul>

                     </div>

                  </nav>

                  <!-- .main-navigation -->

               </div>

               <!-- .site-header-menu -->

            </div>

            <!-- .site-header-main -->

         </div>

      </div>

      @if($route != 'home')

      @include('frontend.layouts.group_header')

      @endif

      <script type="text/javascript">

var productss = JSON.parse('{!! getSearchAllProduct() !!}');

var productDetailPageUrls = "{{ route('product_detail', 'product_slug') }}";

</script>



<style>

   @media (max-width: 768px) {

      /* Set a maximum height and overflow for the menu */

.mobile-menu {

  max-height: 20px; /* Adjust this value as needed */

  overflow-y: auto; /* Add a vertical scrollbar when necessary */

}



   }

   </style>

   <script type="text/javascript">
      $(".mclose").click(function(){
  $(".navbar-toggler-icon").click();
});

  $(".main-menu").click(function(){
    if($(".menu-sub").hasClass("sub-menu"))
      $(".menu-sub").removeClass("sub-menu");
    else
      $(".menu-sub").addClass("sub-menu");
  });
  $(".show-sub").click(function(){
    //$(".menusub").removeClass("sub-sub-menu");
    if($(this).parent().next(".menusub").hasClass("sub-sub-menu"))
      $(this).parent().next(".menusub").removeClass("sub-sub-menu");
    else
      $(this).parent().next(".menusub").addClass("sub-sub-menu");
  })
   </script>