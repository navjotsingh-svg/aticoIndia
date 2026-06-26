@extends('frontend.layouts.app')
@section('content')
@php
    $useragent=$_SERVER['HTTP_USER_AGENT'];
$display=1;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    $display=0;
    
    @endphp
<div class="themestek-slider-wrapper">
  <div class="themestek-slider-wide">
   <script>
          jQuery(window).on('load', function () {
          
          // mainSlider
          function mainSlider() {
          var BasicSlider = jQuery('.slider-activee');
          BasicSlider.on('init', function (e, slick) {
          var $firstAnimatingElements = jQuery('.single-slider:first-child').find('[data-animation]');
          doAnimations($firstAnimatingElements);
          });
          BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
          var $animatingElements = jQuery('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
          doAnimations($animatingElements);
          });
          BasicSlider.slick({
          autoplay: true,
          autoplaySpeed: 10000,
          dots: true,
          fade: true,
          arrows: false,
          responsive: [
          { breakpoint: 767, settings: { dots: false, arrows: false } }
          ]
          });
          
          function doAnimations(elements) {
          var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
          elements.each(function () {
          var $this = jQuery(this);
          var $animationDelay = $this.data('delay');
          var $animationType = 'animated ' + $this.data('animation');
          $this.css({
          'animation-delay': $animationDelay,
          '-webkit-animation-delay': $animationDelay
          });
          $this.addClass($animationType).one(animationEndEvents, function () {
          $this.removeClass($animationType);
          });
          });
          }
          }
          mainSlider();
          
          
          });
          
          
          </script>
          <style>
              .aheading{
                font-size: 24px; 
                line-height: 35px; 
              }
              .country{
                  margin-bottom: 5px;padding: 6px 10px;font-size: 14px;
              }
              .mslider{
                  margin-top: 5px;
                  height:-webkit-fill-available;
                  width:-webkit-fill-available;
                  }
          </style>
                @if($display==1)
          
          <section class="slider-area-wrap">
            <div class="slider-activee">
              
            <div class="single-slider bg-black-overlay d-flex align-items-center" style="background-image:url({{ asset('assets/frontend/images/Bio-2-Image1.webp')  }});height:330px;margin-left:60px;background-repeat: no-repeat;">
               
              </div>
            
            <div class="single-slider bg-black-overlay d-flex align-items-center" style="background-image:url({{ asset('assets/frontend/images/civil-1-Image1.webp')  }});height:330px;margin-left:60px;background-repeat: no-repeat;">
               
              </div>
              
            <div class="single-slider bg-black-overlay d-flex align-items-center" style="background-image:url({{ asset('assets/frontend/images/elec-testing-Image1.webp')  }});height:330px;margin-left:60px;background-repeat: no-repeat;">
               
              </div>
            
            <div class="single-slider bg-black-overlay d-flex align-items-center" style="background-image:url({{ asset('assets/frontend/images/microscope-2-Image1.webp')  }});height:330px;margin-left:60px;background-repeat: no-repeat;">
               
              </div> 
              @endif
              </div>
              </section>
             
            
              

              
  </div>
</div>
@if($display==0)
    <img class="mslider" src="{{ asset('assets/frontend/images/mob1.webp')}}" srcset="
    {{ asset('assets/frontend/images/mob1.webp')}} 300w" >
 
@endif

@include('frontend.layouts.group_header')

<div id="content-wrapper" class="site-content-wrapper">
  <div id="content" class="site-content ">
    <div id="content-inner" class="site-content-inner ">
      <div id="primary" class="content-area  ">
        <main id="main" class="site-main">
          <article id="post-6476" class="post-6476 page type-page status-publish hentry">
            <!-- <header class="single-entry-header ts-hide">
              <h2 class="entry-title">Homepage-2</h2>
            </header> -->
            <!-- .entry-header -->
            <div class="entry-content">

              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid vc_custom_1568807990668 ts-responsive-custom-48004560 ts-break-col-991 ts-total-col-3 ts-zindex-2 ts-bgcolor-grey ts-bgimage-position-center_center">
                <div class="vc_row container vc_row-o-equal-height vc_row-flex">





                  <!-- We are leading company in this field, We provide is specific solutions for our every customers. -->
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-8 ts-zindex-0 ts-span ts-right-span">
                    <div class="vc_column-inner vc_custom_1566557874282 ">
                      <div class="wpb_wrapper">
                        <div class="wpb_text_column wpb_content_element ">
                          <div class="wpb_wrapper">
                            <h1 class="mb-3 aheading" loading="eager" >Atico India is a Premium
                              Company in the Field of Scientific Lab Equipments Manufacturer, Supplier, and Exporter in
                              India & Worldwide. </h1>
                            <div loading="eager"><p style="text-align: justify;">Atico India is a leading Manufacturer, Supplier, and Exporter of Scientific Lab
                              Equipments. We are nationally and internationally spread across 30 countries with a vast
                              base of clients. Our exceptional customer services, post-purchase services and brand
                              quality are at a peak. 
                              </p>
                              <p style="text-align: justify;">
                              At Atico India, we are competitive and are constantly growing according to the needs of
                              our customers across the globe. </p>
                              <p style="text-align: justify;">
                              We keep on innovating advanced technology to manufacture and supply a safe and latest
                              equipment to our customers. At Atico India, we have the best expertise on board to test
                              the final equipment to provide High-performance equipment to the technicians. </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="ts-row-inner vc_row wpb_row vc_inner vc_row-fluid ts-knowmore vc_custom_1566557673132 ts-responsive-custom-17448162 ts-bgcolor-skincolor ts-zindex-0">
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-8 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper know_abt_cmp">
                                <h2
                                  style="text-align:center;font-size:20px;line-height:24px;font-family:'Roboto Condensed',Arial,Helvetica;font-weight:400; padding-top: 10px;"
                                  class="ts-custom-heading vc_custom_1566557495974"><a
                                    href="{{ route('about_us_page') }}">KNOW MORE ABOUT COMPANY</a></h2>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="ts-single-image-wrapper ts_align_left ">
                          <div class="ts-single-image-img-w">
                            <img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/10/img5-01.webp') }}"
                              class="ts-single-image-img" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="about-us">
                  <h3 style="font-weight: 600; font-size: 23px;">About Us</h3>
                  <p></p>Atico India is a leading Scientific Lab Equipment, Biology Lab equipment, Educational
                  Laboratory Equipment Supplier, offering a wide catalogue of lab Instruments and Equipments in India
                  and worldwide. <br><br>
                  We design and supply lab equipments for schools, colleges, universities, research labs, and private
                  high tech science labs. Atico India manufactures an entire range of lab apparatuses and lab gears.
                  <br><br>
                  At Atico India, we have redefined lab experiments by manufacturing premium quality and user-friendly
                  scientific lab equipments. The quality of your lab depends upon the quality of supplier brand and
                  Atico India is a leading company in India and worldwide.<br><br>
                  </p></div>



                </div>
              </div>



              
              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid vc_custom_1534590732218 ts-total-col-2 ts-zindex-1 ts-bgcolor-skincolor ts-bgimage-position-center_center">
                <div class="vc_row container">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-6 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="ts-element-heading-wrapper ts-heading-inner ts-element-align-left ts-seperator-none ">
                          <section class="ts-vc_cta3-container">
                            <div
                              class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading ">LATEST <strong>CATEGORIES</strong></h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                        <!-- .ts-element-heading-wrapper container -->
                      </div>
                    </div>
                  </div>
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-6 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div class="ts-vc_btn3-container ts-vc_btn3-right"><a
                            class="ts-vc_general ts-vc_btn3 ts-vc_btn3-size-md ts-vc_btn3-shape-square ts-vc_btn3-style-outline ts-vc_btn3-weight-yes ts-vc_btn3-color-white"
                            href="{{ route('all_categories') }}" title="">VIEW ALL</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="vc_row-full-width vc_clearfix"></div>



              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid vc_custom_1534590778695 ts-total-col-1 ts-zindex-1 ts-bgimage-position-center_center home-cat">
                <div class="vc_row container">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="themestek-boxes themestek-boxes-portfolio themestek-boxes-view-default themestek-boxes-col-three themestek-boxes-sortable-no themestek-boxes-textalign-center themestek-boxes-sortablebutton-">
                          <div class="themestek-boxes-inner themestek-boxes-portfolio-inner ">
                            <div class="row multi-columns-row themestek-boxes-row-wrapper">


                              @if(count($latest_cats)>0)
                              @foreach($latest_cats as $key => $latest_cat)
                              <div class="ts-box-col-wrapper col-lg-3 col-sm-4 col-md-3 col-xs-12 oncology latest-cat">
                                <article
                                  class="themestek-box themestek-box-portfolio ts-portfoliobox-style-2 themestek-box-view-overlay ts-hover-style-3">
                                  <div class="themestek-post-item">
                                    <span class="themestek-item-thumbnail">
                                      <span class="themestek-item-thumbnail-inner">
                                        <img width="800" height="715"
                                          src="{{ asset($latest_cat->image ? 'uploads/product_images/'.$latest_cat->image : 'assets/frontend/css/wp-content/uploads/2018/08/research-01-800x715.jpg') }}"
                                          class="attachment-themestek-img-800x715 size-themestek-img-800x715 wp-post-image"
                                          alt="" data-id="6977" onerror="this.onerror=null;this.src='{{ asset("
                                          assets/frontend/images/no_product.png") }}';" />
                                      </span>
                                    </span>
                                    <div class="themestek-box-content themestek-overlay">
                                      <div class="themestek-box-content-inner">
                                        <div class="themestek-pf-box-title">
                                          <!-- <div class="themestek-box-category"><a href="#">Oncology</a></div> -->
                                          <h3><a href="{{ route('categories', $latest_cat->slug) }}">{!!
                                              $latest_cat->name !!}</a></h3>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </article>
                              </div>
                              @endforeach
                              @endif


                            </div>
                          </div>
                          <!-- .themestek-boxes-inner -->
                        </div>
                        <!-- .themestek-boxes -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="vc_row-full-width vc_clearfix"></div>
              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid ts-total-col-1 ts-zindex-0 ts-bgimage-position-center_center home-trust">
                <div class="vc_row container">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="ts-element-heading-wrapper ts-heading-inner ts-element-align-center ts-seperator-none ">
                          <section class="ts-vc_cta3-container">
                            <div
                              class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-center ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading ">EVALUATION OF THE CURRENT SAFETY<br />
                                        <strong>WE ARE THE TRUSTED EXPERTS</strong>
                                      </h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                        <!-- .ts-element-heading-wrapper container -->
                        <div class="ts-row-inner vc_row wpb_row vc_inner vc_row-fluid ts-zindex-0">
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-syringe"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading">Order Now</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">Phone: +91-9896793832<br>Email:
                                        sales@aticoindia.com</div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-scientist"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading ">OEM / Tenders</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">Bulk Lab Tender Supply and OEM Manufacturers
                                        for Educational, Laboratoy, Analytical & Research Lab Products.</div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-laboratory"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading ">Support Team</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">24x7 Support Team just a call away. Contact
                                        Now or fill inquiry form for all your technical/ troubleshooting inquiries.
                                      </div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="ts-row-inner vc_row wpb_row vc_inner vc_row-fluid ts-zindex-0">
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-test-tube-1"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading ">Bulk Orders</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">Special Discounts on bulk orders. Regular
                                        Bulk Orders to over 56 countries worldwide. Reasonably priced, good quality
                                        products, impressive packaging and prompt delivery of Consignments.</div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-science"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading ">Payment & Shipping</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">We accept Wire or Telegraphic Transfer/
                                        Letter of Credit/ Paypal etc. Shipping is based on your consignment size & other
                                        factors, contact for further details.</div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="ts-column-inner wpb_column vc_column_container vc_col-sm-4 ts-zindex-0">
                            <div class="vc_column-inner  ">
                              <div class="wpb_wrapper">
                                <div class="ts-ihbox ts-ihbox-style-3 ts-ihbox-itype-icon ">
                                  <div class="ts-sbox-bgimage-layer ts-bgimage-layer"></div>
                                  <div class="ts-ihbox-wrapper-bg-layer ts-bg-layer"></div>
                                  <div class="ts-ihbox-inner">
                                    <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
                                      <div class="ts-ihbox-icon-wrapper"><i
                                          class="ts-labtechco-business-icon ts-labtechco-business-icon-poison-1"></i>
                                      </div>
                                    </div>
                                    <div class="ts-ihbox-contents">
                                      <div
                                        class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                        <div class="ts-vc_cta3_content-container">
                                          <div class="ts-vc_cta3-content">
                                            <div class="ts-vc_cta3-content-header ts-wrap">
                                              <div class="ts-vc_cta3-headers ts-wrap-cell">
                                                <h2 class="ts-custom-heading ">Dealership</h2>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ts-cta3-content-wrapper">Be a part of our success story and contact to
                                        become one of our authorized dealers.</div>
                                    </div>
                                    <!-- .ts-ihbox-contents -->
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
              </div>
              <div class="vc_row-full-width vc_clearfix"></div>
              
              <div class="vc_row-full-width vc_clearfix"></div>
             

              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid ts-total-col-2 ts-zindex-0 ts-bgimage-position-center_center">
                <div class="vc_row container">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-6 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="ts-element-heading-wrapper ts-heading-inner ts-element-align-left ts-seperator-none  vc_custom_1534592947266">
                          <section class="ts-vc_cta3-container">
                            <div
                              class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading ">WE ARE TRUSTED BY <strong>WORLD'S LEADING
                                          COMPANIES</strong></h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                        <!-- <div class="wpb_text_column wpb_content_element " >
                          <div class="wpb_wrapper">
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                          </div>
                        </div> -->
                        <div
                          class="themestek-progress-bar vc_progress_bar wpb_content_element vc_progress-bar-color-skincolor vc_custom_1534593047989 vc_progress-bar-color-skincolor">
                          <div class="ts-pbar-single-bar-w ts-pbar-icon-false">
                            <div class="vc_general vc_single_bar"><small class="vc_label"> Cost-efficient Lab
                                Equipment</small> <span class="ts-vc_label_units vc_label_units">90%</span><span
                                class="vc_bar " data-percentage-value="90" data-value="90"></span></div>
                          </div>
                          <div class="ts-pbar-single-bar-w ts-pbar-icon-false">
                            <div class="vc_general vc_single_bar"><small class="vc_label"> High-quality Lab
                                Equipment</small> <span class="ts-vc_label_units vc_label_units">80%</span><span
                                class="vc_bar " data-percentage-value="80" data-value="80"></span></div>
                          </div>

                          <div class="ts-pbar-single-bar-w ts-pbar-icon-false">
                            <div class="vc_general vc_single_bar"><small class="vc_label"> Assured and Tested</small>
                              <span class="ts-vc_label_units vc_label_units">80%</span><span class="vc_bar "
                                data-percentage-value="80" data-value="80"></span></div>
                          </div>

                          <div class="ts-pbar-single-bar-w ts-pbar-icon-false">
                            <div class="vc_general vc_single_bar"><small class="vc_label"> Purchase Convenience</small>
                              <span class="ts-vc_label_units vc_label_units">80%</span><span class="vc_bar "
                                data-percentage-value="80" data-value="80"></span></div>
                          </div>

                         
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-6 ts-zindex-0 ts-span ts-right-span">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div class="wpb_single_image wpb_content_element vc_align_left">
                          <figure class="wpb_wrapper vc_figure">
                            <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="737" height="486"
                                src="{{ asset('assets/frontend/css/wp-content/uploads/2018/08/map-01.webp') }}"
                                class="vc_single_image-img attachment-full" alt="" /></div>
                          </figure>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="vc_row-full-width vc_clearfix"></div>
              <div data-vc-full-width="true" data-vc-full-width-init="false"
                class="ts-row wpb_row vc_row-fluid ts-total-col-1 ts-zindex-0 ts-bgcolor-skincolor ts-bgimage-position-center_center">
                <div class="vc_row container">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                    <div class="vc_column-inner  ">
                      <div class="wpb_wrapper">
                        <div
                          class="themestek-boxes themestek-boxes-blog themestek-boxes-view-default themestek-boxes-col-three themestek-boxes-sortable-no themestek-boxes-textalign-center themestek-boxes-sortablebutton-">
                          <div class="themestek-boxes-inner themestek-boxes-blog-inner ">
                            <div class="themestek-box-heading-wrapper ts-element-align-center">
                              <div
                                class="ts-element-heading-wrapper ts-heading-inner ts-element-align-center ts-seperator-none ">
                                <section class="ts-vc_cta3-container">
                                  <div
                                    class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-center ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-without-desc">
                                    <div class="ts-vc_cta3_content-container">
                                      <div class="ts-vc_cta3-content">
                                        <div class="ts-vc_cta3-content-header ts-wrap">
                                          <div class="ts-vc_cta3-headers ts-wrap-cell">
                                            <h2 class="ts-custom-heading ">LATEST NEWS &amp; BLOGS</h2>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </section>
                              </div>
                              <!-- .ts-element-heading-wrapper container -->
                            </div>
                            <!-- .ts-element-heading-wrapper container -->
                            <div class="row multi-columns-row themestek-boxes-row-wrapper">


                              @if(count($blogs)>0)
                              @foreach($blogs as $key => $blog)
                              <div
                                class="ts-box-col-wrapper col-lg-3 col-sm-4 col-md-3 col-xs-12 gemological-laboratories%e2%80%8e scientific-laboratory home-blog">
                                <article
                                  class="themestek-box themestek-box-blog ts-blogbox-style-1 themestek-box-style1 themestek-blogbox-format- ">
                                  <div class="post-item">
                                    <div class="ts-blog-image-with-meta">
                                      <div class="ts-post-format-icon-w"><i class="ts-labtechco-icon-file"></i></div>
                                      <div class="ts-featured-wrapper ts-post-featured-wrapper ts-post-format-"><img
                                          width="750" height="500"
                                          src="{{ asset('uploads/blog_images/'.$blog->image) }}"
                                          class="attachment-themestek-img-800x700 size-themestek-img-800x700 wp-post-image"
                                          alt="" /></div>
                                    </div>
                                    <div class="themestek-box-content">
                                      <div class="ts-entry-meta-wrapper">
                                        <div class="entry-meta ts-entry-meta ts-entry-meta-blogbox"><span
                                            class="ts-meta-line byline"> <span class="author vcard"><span
                                                class="screen-reader-text ts-hide">Author </span>By <a class="url fn n"
                                                href="{{ route('blog_detail', $blog->slug) }}">Admin</a></span></span><span class="ts-meta-line posted-on"><span
                                              class="screen-reader-text ts-hide">Posted on </span><a
                                              href="{{ route('blog_detail', $blog->slug) }}" rel="bookmark"><time
                                                class="entry-date published" datetime="2018-08-08T10:00:25+00:00">{{
                                                $blog->created_at->format('F d, Y') }}</time><time
                                                class="updated ts-hide" datetime="2019-05-13T12:16:06+00:00">{{
                                                $blog->created_at->format('F d, Y') }}</time></a></span></div>
                                      </div>
                                      <div class="themestek-box-title">
                                        <h4><a href="{{ route('blog_detail', $blog->slug) }}">{!! str_limit($blog->name,
                                            18) !!}</a></h4>
                                      </div>
                                      <!-- <div class="themestek-box-desc">
                                        <div class="themestek-box-desc-text">{!! str_limit($blog->description, $limit = 150, $end = '...') !!}</div>
                                      </div> -->
                                      <div class="ts-bottom-meta-wrapper clearfix">
                                        <div class="pull-left">
                                          <div class="themestek-blogbox-footer-left"><a
                                              href="{{ route('blog_detail', $blog->slug) }}">Read More</a></div>
                                        </div>
                                        <div class="themestek-blogbox-footer-commnent pull-right">
                                          <span class="ts-blogbox-comment-w">
                                            <a href="{{ route('blog_detail', $blog->slug) }}">
                                              <i class="themifyicon ti-comment"></i>
                                              <span class="comments">{{ countBlogComments($blog['id']) }}
                                                Comments</span>
                                            </a>
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </article>
                              </div>
                              @endforeach
                              @endif




                            </div>
                          </div>
                          <!-- .themestek-boxes-inner -->
                        </div>
                        <!-- .themestek-boxes -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="vc_row-full-width vc_clearfix"></div>
            </div>
            <!-- .entry-content -->
          </article>
          <!-- #post-## -->
        </main>
        <!-- #main .site-main -->
      </div>
      <!-- #primary .content-area -->
    </div>
    <!-- .site-content-inner -->
  </div>
  <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->


@if(!session('success'))
<!-- ON-LOAD MODAL STARTS -->
<div class="modal fade" id="onloadmodal" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!--<div class="modal-header">-->
      <!--  <button style="opacity: 1;" type="button" data-keyboard="true" class="close" data-dismiss="modal"><img src="{!! asset('assets/frontend/images/cro_subs.jpg') !!}" class="img-fluid mx-auto d-block" alt="" style="max-height: 35px;"></button>-->
      <!--</div>-->

      <div class="modal-body back">
        <div class="row">
          <div class="col-12">
            <div class="hd text-center">
              <h3>Get Your Free <span>Quote</span></h3>
            </div>
          </div>
          <div class="col-md-10 offset-md-1">
            <form action="{{ route('enquiry.store') }}" method="post" class="wpcf7-form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-12 py-2">
                  <input type="text" name="name" autocomplete="do-not-autofill" required="true"
                    style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Name"
                    class="form-control" value="{{ old('name') }}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <input type="email" name="email" autocomplete="off" class="form-control"
                    style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="E-mail" required="true"
                    value="{{ old('email') }}">
                  @if($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <!--<select name="country" required="" class="form-control" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;">-->
                  <!--  <option value="">Select Country</option>-->
                  <!--  @foreach(getCountries() as $key => $country)-->
                  <!--  <option value="{!! $country->name !!}" {{ old('country') == $country->name ? 'selected':'' }}>{!! $country->name !!}</option>-->
                  <!--  @endforeach-->
                  <!--</select>-->
                  <input type="text" name="country" class="form-control country"
                     placeholder="Country" required="true"
                    value="{{ old('country') }}">
                  @if($errors->has('country'))
                  <span class="text-danger">{{$errors->first('country')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <input type="number" class="form-control" name="mobileno" id="mobileno"
                    style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Phone Number"
                    required="true" value="{{ old('mobile_no') }}">
                  @if($errors->has('mobile_no'))
                  <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <textarea rowspan="5" name="message" id="message"
                    style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Message"
                    class="form-control" required="true"></textarea>{{ old('message') }}
                  @if($errors->has('message'))
                  <span class="text-danger">{{$errors->first('message')}}</span>
                  @endif
                  <div class="form-group">
                  <input type="file" name="file_name" id="file_name" accept=".xls,.xlsx,.pdf">
                  </div>
                  <input type="hidden" name="page_url" value=<?=  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?> >
                  <input type="hidden" name="ip_address" id="ip_address1">
                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_" required></div>
                  </div> 
                  <div class="col-12 py-2">
                    <div class="button text-center">
                      <button class="text-center btn" type="submit" style="margin-top: 0px; margin-bottom: 5px; background: #fff; color: #3368c6 !important; padding: 9px 36px 6px 36px;
    font-size: 19px; ">Submit</button>
                    </div>
                  </div>
                </div>
            </form>
          </div>

          <div class="col-md-12" style="text-align: center;">
            <h6>If you are a college or university looking to setup a complete lab. Please contact us with your details
              for custom quotation. <a href="mailto:sales@aticoindia.com" style="color: #fff;
    font-weight: 600; padding-top: 17px;">sales@aticoindia.com</a></h6>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- ON-LOAD MODAL ENDS -->
@endif

<div id="successModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <span class="material-icons">&#xE876;</span>
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
</div>

@endsection

@section('script')
<script>

  $(document).ready(function () {
    $("#onloadmodal").modal('show');
  });

</script>

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
                    document.getElementById("ip_address1").value = data.ip;
                })
                .catch(error => {
                    console.error("Error fetching IP address:", error);
                });
        });
</script>
<style>
.mslider{
    width: 100% !important;
    height: auto !important;
}    
</style>
@endsection