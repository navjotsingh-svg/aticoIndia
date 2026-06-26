@extends('frontend.layouts.app')
@section('content')
<!-- End Header -->
<div class="page_title breadcrumb-overlay header1" style="background-image: url({{ asset('assets/frontend/css/wp-content/plugins/dustrial-master/assets/imgs/breadcumb-bg.jpg') }});">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h5 class="page_tittle activebreadcrumbColor">Testimonials</h5>
            <!-- Breadcrumb -->
            <div class="bread_crumb text-lg-left">
               <a href="{{ route('home') }}">
               Home<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
               </a>
               <span class="activeColor">Testimonials</span>
            </div>
            <!-- End Breadcrumb -->
         </div>
      </div>
   </div>
</div>
<!-- breadcumb-area-end -->
<div class="container">
   <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row section-element vc_custom_1546077509940">
      <div class="vc_col-sm-12 ">
         <div class="vc_row section">
            <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                        <div class=" dustrial-stitle-5d89d35f4ccae section-title-three text-center wow fadeInUp">
                           <h2>Customer <strong>Reviews</strong></h2>
                           <p>There are many variations of passages of Lorem Ipsum available but the majority have suffered in some form by injected or randomised words which even slightly believable.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="vc_row section">
            <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <script>
                        jQuery(document).ready(function($) {
                          $("#h3-testimonial-items").owlCarousel({
                            loop: true,
                            margin: 30,
                            responsiveClass: true,
                            navigation: true,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            nav: false,
                            items: 2,
                            smartSpeed: 1000,
                            dots: true,
                            autoplay: true,
                            mouseDrag:true,
                            autoplayTimeout: 4000,
                            center: false,
                            responsive: {
                                0: {
                                    items: 1            },
                                766: {
                                    items: 1            },
                                767: {
                                    items: 2            },
                                990: {
                                    items: 2            },
                                991: {
                                    items: 2            }
                            }
                          });
                        });
                     </script>
                     <div id="h3-testimonial-items" class="owl-carousel owl-theme">
                        <div class="item text-center">
                           <div class="testimonial-content mb-5">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="testimonial-author pt-2">
                              <div class="testimonial-author-img mb-3">
                                 <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb-2.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" >        
                              </div>
                              <h5 class="testimonial-author-name mb-0">Maria Robinson</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>          
                              </div>
                           </div>
                        </div>
                        <div class="item text-center">
                           <div class="testimonial-content mb-5">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="testimonial-author pt-2">
                              <div class="testimonial-author-img mb-3">
                                 <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" />        
                              </div>
                              <h5 class="testimonial-author-name mb-0">Henry Steinbeck</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>          
                              </div>
                           </div>
                        </div>
                        <div class="item text-center">
                           <div class="testimonial-content mb-5">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="testimonial-author pt-2">
                              <div class="testimonial-author-img mb-3">
                                 <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb-3.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" />        
                              </div>
                              <h5 class="testimonial-author-name mb-0">Belly Marison</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i>          
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="vc_row-full-width"></div>
   <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row section-element vc_custom_1546957150802">
      <div class="vc_col-sm-12 ">
         <div class="vc_row section">
            <div class="h1-testimonials-area wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <div class=" dustrial-stitle-5d89d35f518c6 section-title  wow fadeIn">
                        <div class="section-thumb"><img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/01/title-icon-1-2.png') }}" alt="title icon"></div>
                        <div class="section-body">
                           <h6 class="sub-title activeColor">What Client Say&#039;s</h6>
                           <h3 class="m-0 main-title">Testimonials</h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="vc_row section">
            <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <script>
                        jQuery(document).ready(function($) {
                          $("#testimonial-items").owlCarousel({
                            loop: true,
                            margin: 30,
                            responsiveClass: true,
                            navigation: true,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            nav: true,
                            items: 2,
                            smartSpeed: 1000,
                            dots: false,
                            autoplay: true,
                            mouseDrag:true,
                            autoplayTimeout: 4000,
                            center: false,
                            responsive: {
                                0: {
                                    items: 1            },
                                766: {
                                    items: 1            },
                                767: {
                                    items: 2            },
                                990: {
                                    items: 2            },
                                991: {
                                    items: 2            }
                            }
                          });
                        });
                     </script>
                     <div id="testimonial-items" class="owl-carousel">
                        <div class="single-testimonial-items">
                           <div class="single-testimonial-items-title">
                              <h3>Successful Project</h3>
                           </div>
                           <div class="single-testimonial-items-content">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="single-testimonial-items-meta">
                              <h5 class="testimonial-author-name">Maria Robinson</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>                  
                              </div>
                           </div>
                        </div>
                        <div class="single-testimonial-items">
                           <div class="single-testimonial-items-title">
                              <h3>Good Experiences</h3>
                           </div>
                           <div class="single-testimonial-items-content">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="single-testimonial-items-meta">
                              <h5 class="testimonial-author-name">Henry Steinbeck</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>                
                              </div>
                           </div>
                        </div>
                        <div class="single-testimonial-items">
                           <div class="single-testimonial-items-title">
                              <h3>Helpful Support</h3>
                           </div>
                           <div class="single-testimonial-items-content">
                              <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                           </div>
                           <div class="single-testimonial-items-meta">
                              <h5 class="testimonial-author-name">Belly Marison</h5>
                              <div class="testimonial-star-ratings">
                                 <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i>                  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="vc_row-full-width"></div>
   <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row section-element h2-testimonial-area vc_custom_1546772081560">
      <div class="vc_col-sm-12 ">
         <div class="vc_row section">
            <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <div class="row d-flex justify-content-center wow fadeInUp">
                        <div class="col-lg-12">
                           <div class=" dustrial-stitle-5d89d35f54b64 section-title-two text-center">
                              <div class="section-two-body">
                                 <h6 class="sub-title activeColor">Testimonial</h6>
                                 <h3 class="main-title">What Client Say&#039;s</h3>
                              </div>
                              <div class="stock">
                                 <img src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/stock-1-2.png') }}" alt="stock">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="vc_row section">
            <div class="wpb_column vc_column_container vc_col-sm-12">
               <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                     <script>
                        jQuery(document).ready(function($) {
                          $("#h2-testimonial-items").owlCarousel({
                            loop: true,
                            margin: 30,
                            responsiveClass: true,
                            navigation: true,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            nav: false,
                            items: 2,
                            smartSpeed: 1000,
                            dots: true,
                            autoplay: true,
                            mouseDrag:true,
                            autoplayTimeout: 4000,
                            center: false,
                            responsive: {
                                0: {
                                    items: 1            },
                                766: {
                                    items: 1            },
                                767: {
                                    items: 2            },
                                990: {
                                    items: 2            },
                                991: {
                                    items: 2            }
                            }
                          });
                        });
                     </script>
                     <div id="h2-testimonial-items" class="owl-carousel owl-theme">
                        <div class="item text-center">
                           <div class="item-content">
                              <div class="testimonial-author">
                                 <div class="testimonial-author-img mb-3">
                                    <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb-2.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" >          
                                 </div>
                                 <h6 class="testimonial-author-name mb-1 text-light">Maria Robinson</h6>
                                 <div class="testimonial-reating">
                                    <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>          
                                 </div>
                              </div>
                              <div class="testimonial-content text-light text-center">
                                 <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                              </div>
                              <div class="quotation">
                                 <i class="fa fa-quote-left" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                        <div class="item text-center">
                           <div class="item-content">
                              <div class="testimonial-author">
                                 <div class="testimonial-author-img mb-3">
                                    <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">          
                                 </div>
                                 <h6 class="testimonial-author-name mb-1 text-light">Henry Steinbeck</h6>
                                 <div class="testimonial-reating">
                                    <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star-o activeColor mr-1" aria-hidden="true"></i>          
                                 </div>
                              </div>
                              <div class="testimonial-content text-light text-center">
                                 <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                              </div>
                              <div class="quotation">
                                 <i class="fa fa-quote-left" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                        <div class="item text-center">
                           <div class="item-content">
                              <div class="testimonial-author">
                                 <div class="testimonial-author-img mb-3">
                                    <img width="200" height="200" src="{{ asset('assets/frontend/css/wp-content/uploads/2018/11/testimonial-thumb-3.png') }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">          
                                 </div>
                                 <h6 class="testimonial-author-name mb-1 text-light">Belly Marison</h6>
                                 <div class="testimonial-reating">
                                    <i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i><i class="fa fa-star activeColor mr-1" aria-hidden="true"></i>          
                                 </div>
                              </div>
                              <div class="testimonial-content text-light text-center">
                                 <p>There are many variations of passages of at Lorem Ipsum that available but the majority the have suffered alteration. at There are many variations of passages of Lorem Ipsum anavailable a but the majority have suffered.</p>
                              </div>
                              <div class="quotation">
                                 <i class="fa fa-quote-left" aria-hidden="true"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="vc_row-full-width"></div>
</div>
@endsection