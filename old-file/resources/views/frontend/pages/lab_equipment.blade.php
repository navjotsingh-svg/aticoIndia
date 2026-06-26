@extends('frontend.layouts.app')
@section('content')
<!-- End Header -->

@php
    $useragent=$_SERVER['HTTP_USER_AGENT'];
$display=1;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    $display=0;
    
    @endphp

  <link rel='stylesheet'  href="https://aticoscientific.com/assets/css/owl.carousel.min5560.css?ver=5.0.4"  media='all' />
<div class="ts-titlebar-wrapper ts-bg ts-bgcolor-transparent ts-titlebar-align-left ts-textcolor-white ts-bgimage-yes">
   <div class="ts-titlebar-wrapper-bg-layer ts-bg-layer"></div>
   <div class="ts-titlebar entry-header">
      <div class="ts-titlebar-inner-wrapper">
         <div class="ts-titlebar-main">
            <div class="container">
               <div class="ts-titlebar-main-inner">
                  <div class="entry-title-wrapper">
                     <div class="container">
                        <h1 class="entry-title">Lab Equipment</h1>
                     </div>
                  </div>
                  <div class="breadcrumb-wrapper">
                     <div class="container">
                        <div class="breadcrumb-wrapper-inner">
                           <span><a href="{{ route('home') }}" class="home"><span>Home</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><span>Lab Equipment</span></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- .ts-titlebar-main -->
      </div>
      <!-- .ts-titlebar-inner-wrapper -->
   </div>
   <!-- .ts-titlebar -->
</div>
<!-- .ts-titlebar-wrapper -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<style type="text/css">
    #owl-demo{
        margin-top: 20px;
    }
  .libre-baskerville-regular {
  font-family: "Libre Baskerville", serif;
  font-weight: 400;
  font-style: normal;
}

.libre-baskerville-bold {
  font-family: "Libre Baskerville", serif !important;
  font-weight: 700 !important;
  font-style: normal;
  line-height: normal !important;
}

.libre-baskerville-regular-italic {
  font-family: "Libre Baskerville", serif;
  font-weight: 400;
  font-style: italic;
}
.lab-tenders p {
    font-size: 14px !important;
    line-height: 20px;
    margin-bottom: 0;
    text-align: justify;
    color: #000;
}
.our_mission {
    width: 492px;
    height: 200px;
    left: 329px;
    top: 876px;
    background: #3A5698;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 20px;
}
.our_mission p{
/*width: 471px; */
    /* height: 171px; */
    /* left: 357px; */
    /* top: 905px; */
    font-family: 'Libre Baskerville';
    font-style: normal;
    /* font-weight: 700; */
    font-size: 24px;
    line-height: 150%;
    text-align: center;
    letter-spacing: 0.01em;
    color: #FFFFFF;
    position: absolute;
    padding: 10px;
}
.our_mission h6 {
    font-size: 24px;
    text-align: center !important;
    color: #fff !important;
    padding-top: 15px;
}
.contact_form{
  /* Group 2036 */

position: absolute;
    /*height: -webkit-fill-available;*/
    padding-bottom: 10px;
    width: 100%;
    border: 1px solid #3A5698;
    border-radius: 10px;

}

.all_products{
 /* position: absolute;*/
width: 100%;
height: 963px;
left: 0px;
top: 1261px;

background: #3A5698;
}
.all_products h2{
  position: absolute;
/*width: 890px;
height: 44px;
left: 332px;
top: 1373px;*/

font-family: 'Libre Baskerville';
font-style: normal;
font-weight: 700;
font-size: 28px;
line-height: 151%;
/* or 54px */
text-align: justify;
letter-spacing: -0.01em;
margin-top: 5%;
margin-left: 10%;

color: #FFFFFF;
}

.partner h2{
  position: absolute;
width: 850px;
height: 108px;
left: 328px;
top: 2369px;

font-family: 'Libre Baskerville';
font-style: normal;
font-weight: 700;
font-size: 36px;
line-height: 151%;
/* or 54px */
text-align: justify;
letter-spacing: -0.01em;

color: #000000;
}
.boxes {
    margin-top: 20px;
    display: flex;
    min-width: 135%;
    margin-right: 10px;
}
.box{
  width: 33%;
    border: 1px solid #3368C6;
    padding: 10px;
    color: #000;
    border-radius: 10px;
    margin-right: 20px;
}
.box .img{
  background: #3368C6;
    width: 25%;
    height: 25%;
    border-radius: 50%;
    padding: 12px;
}

.mob_box{
  width: 99%;
    border: 1px solid #3368C6;
    padding: 10px;
    color: #000;
    border-radius: 10px;
    margin-right: 20px;
    min-height:400px ;
}
.mob_box .img{
  background: #3368C6;
    width: 30%;
    height: 30%;
    border-radius: 50%;
    padding: 22px;
    margin-left: 105px;
}


#owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}
.product {
    top: 54%;
    position: absolute;
    left: 15%;
}
.product2 {
    top: 54%;
    position: absolute;
    left: 34%;
}
.product3 {
    top: 54%;
    position: absolute;
    left: 53%;
}
.product4{
    top: 54%;
    position: absolute;
    left: 72%;
}
 .product5 {
    top: 74%;
    position: absolute;
    left: 15%;
}
.product6 {
    top: 74%;
    position: absolute;
    left: 34%;
}
.product7 {
    top: 74%;
    position: absolute;
    left: 53%;
}
.product8{
    top: 74%;
    position: absolute;
    left: 72%;
}
.product h6,.product2 h6,.product3 h6,.product4 h6,.product5 h6,.product6 h6,.product7 h6,.product8 h6{
  color: #fff;
    text-align: center
}
.view_product{
 box-sizing: border-box;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 8px 21px;
    gap: 10px;
    /* position: absolute; */
    width: 185px;
    height: 53px;
    left: 1405px;
    top: 1368px;
    border: 1px solid #FFFFFF;
    border-radius: 10px;
    float: right;
    margin-right: 14%;
    margin-top: -47px;
    background: transparent;
}
h1.ts-custom-heading.libre-baskerville-bold ,h2.ts-custom-heading.libre-baskerville-bold{
    font-size: 27px !important;
    text-align: left;
    line-height: normal;
}
/*h2.ts-custom-heading.libre-baskerville-bold{
     font-size: 20px !important;
    text-align: center;
    line-height: normal;
}*/
.product img,.product2 img,.product3 img,.product4 img,.product5 img,.product6 img,.product7 img,.product8 img{
  max-width: 85%;
}
.in-touch{
    margin-top: 50px !important;
}
@media only screen and (max-width: 600px) {
    .in-touch{
    margin-top: unset;
}
    .box .img{
  background: #3368C6;
    width: 30%;
    height: 30%;
    border-radius: 50%;
    padding: 22px;
}
    h1.ts-custom-heading.libre-baskerville-bold ,h2.ts-custom-heading.libre-baskerville-bold{
    font-size: 20px !important;
    text-align: center;
    line-height: normal;
}
  .contact_form {
    position: relative;
        margin-left: 15px;
        width: 90%;
        padding-bottom: 23px;
        margin-top: 30px;
  }
  .our_mission {
    width: 90%;
     height: 265px; 
    left: 329px;
    top: 876px;
    background: #3A5698;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 20px;
    margin-left: 15px;
    margin-top: 20px;
}
.our_mission p{
  width: inherit;
}
.all_products h2 {
    position: absolute;
    font-family: 'Libre Baskerville';
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 151%;
    letter-spacing: -0.02em;
    margin-top: 5%;
    margin-left: 10%;
    color: #FFFFFF;
    margin-right: 10%;
}
.view_product {
    box-sizing: border-box;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 8px 21px;
    gap: 10px;
    position: absolute;
    width: 185px;
    height: 53px;
    left: 105px;
    bottom: 15px;
    border: 1px solid #FFFFFF;
    border-radius: 10px;
    float: right;
    margin-right: 257px;
/*    margin-top: 188%;*/
    background: transparent;
    top:auto;
}
.ts-vc_cta3-content {
    width: 121%;
}
.product {
    top: 63.5%;
    position: absolute;
    left: 9%;
}

.product2 {
    top: 63.5%;
    position: absolute;
    left: 52%;
}
.product3 {
    top: 71%;
    position: absolute;
    left: 9%;
}
.product4{
    top: 71%;
    position: absolute;
    left: 52%;
}
 .product5 {
    top:79%;
    position: absolute;
    left: 9%;
}
.product6 {
    top: 79%;
    position: absolute;
    left: 52%;
}
.product7 {
    top: 87%;
    position: absolute;
    left: 9%;
}
.product8{
    top: 87%;
    position: absolute;
    left: 52%;
}
.product h6,.product2 h6,.product3 h6,.product4 h6,.product5 h6,.product6 h6,.product7 h6,.product8 h6{
  color: #fff;
    text-align: center;
}
/*.all_products{
  top: 1450px;
  position: absolute;
}*/
h1{
  line-height: 0px;
}
}
.mob_box h4 {
    text-align: center;
}
</style>
<div class="ts-row wpb_row vc_row-fluid vc_custom_1535112868661 ts-responsive-custom-32388294 ts-break-col-991 ts-total-col-2 ts-zindex-0 vc_row container ts-bgimage-position-center_center py-5 lab-tenders">
                <div class="vc_row-o-equal-height vc_row-flex">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-7 ts-zindex-0">
                    <div class="vc_column-inner vc_custom_1533205805036 ">
                      <div class="wpb_wrapper">
                        <div class="ts-element-heading-wrapper ts-heading-inner ts-element-align-left ts-seperator-none  vc_custom_1534590104536">
                          <section class="ts-vc_cta3-container">
                            <div class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-with-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading libre-baskerville-bold" >Lab Equipment <br> Supplier in Delhi</h2>
                                    </div>
                                  </div>
                                 
                                  <div class="ts-cta3-content-wrapper">
                                    <p>Atico India is regarded as an exceptional Lab Equipment manufacturer in Delhi. Our history, exceeding 5 decades, proves that we have always been devoted to ensuring that scientific advancement is fostered all over India. With our headquarters in Ambala, Haryana, we have successfully created exceptional supply chain and logistic services across India, especially in India.


                                    </p>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                        <!-- .ts-element-heading-wrapper container -->
                         @if($display==1)
                        <div class="our_mission">
                          <h6 align="center">Our Mission </h6>
                          <p>
                            To equip educational institutions, research laboratories, and industries with top-tier lab equipment that fuels innovation and discovery. We strive to be the preferred partner for all your laboratory needs, offering a comprehensive range of solutions, exceptional quality, and unmatched support.
                          </p>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-5 vc_col-has-fill ts-zindex-0 ts-span ts-right-span">
                    <div class="">
                      <div class="ts-col-wrapper-bg-layer ts-bg-layer ts-bgimage-position-center_center" style="width:100%;">
                        <div class="ts-bg-layer-inner"></div>
                      </div>
                      <div class="wpb_wrapper">
                        <div  class="contact_form">
                           <div class="ts-column wpb_column vc_column_container ts-zindex-0">
                           <div class="vc_column-inner  ts-responsive-custom-80978663">
                              <div class="wpb_wrapper">
                                 <h3 style="text-align:left;<?php if($display==0) echo "margin-top: -30px"; ?>" class="ts-custom-heading text-center" >Enquire Now</h3>
                                 <div role="form" class="wpcf7" id="wpcf7-f5-p6602-o2" lang="en-US" dir="ltr">
                                    <div role="form" class="wpcf7" lang="en-US" dir="ltr">
        <div class="row">
          <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
          </div>
        </div>
        <form action="{{ route('enquiry.store') }}" method="post" class="wpcf7-form" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="contact-feedback-block">
            <div class="form-row">
              <div class="form-group col-md-6 pr-lg-3"><span class="wpcf7-form-control-wrap your-name"><input type="text" required="true" name="name" value="{{ old('name') }}" class="wpcf7-form-control wpcf7-text form-control rounded-0" placeholder="First Name*" /></span></div>
              <div class="form-group col-md-6">
                <span class="wpcf7-form-control-wrap your-email"><input type="email" required="true" name="email" value="{{ old('email') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Email*"/></span>
              </div>
              <div class="form-group col-md-6 pr-lg-3">
                <span class="wpcf7-form-control-wrap your-email"><input type="number" min="0" required="true" name="mobile_no" value="{{ old('mobile_no') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Mobile Number" /></span>
              </div>
              <div class="form-group col-md-6">
                <span class="wpcf7-form-control-wrap your-email">
                  <select required="true" name="country" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" aria-invalid="false" >
                    <option value="">Select Country</option>
                    @foreach(getCountries() as $key => $country)
                    <option value="{!! $country->name !!}">{!! $country->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <?php
$min  = 1;
$max  = 300;
$num1 = rand( $min, $max );
$num2 = rand( $min, $max );
$sum  = $num1 + $num2;
?>
              <div class="form-group">
                <span class="wpcf7-form-control-wrap your-message"><textarea required="true" name="message" cols="80" rows="5" class="wpcf7-form-control wpcf7-textarea form-control rounded-0" placeholder="How can we help?" >{!! old('message') !!}</textarea></span>
              </div>
              <div class="form-group">
              <input type="file" name="file_name" id="file_name" accept=".xls,.xlsx,.pdf">
                                          </div>
               <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_"></div>
</div>
<input type="hidden" name="page_url" value=<?=  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?> >

<input type="hidden" name="ip_address" id="ip_address">
              <p><button data-res="<?php echo $sum; ?>" type="submit" class="get_quote_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
                                 </div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="all_products">
                    <h2>Leading Lab Equipment Manufacturer in Delhi</h2>
                  </div> -->
                  @if($display==0)
                        <div class="our_mission">
                          <h6>Our Mission </h6>
                          <p>
                            To equip educational institutions, research laboratories, and industries with top-tier lab equipment that fuels innovation and discovery. We strive to be the preferred partner for all your laboratory needs, offering a comprehensive range of solutions, exceptional quality, and unmatched support.
                          </p>
                        </div>
                        @endif
                  
                </div>
              </div>

<div class="container-fluid all_products">
 
 @if($display==1) <h1 class="ts-custom-heading libre-baskerville-bold" style="color:#fff;text-align: unset;padding-top: 90px;line-height: initial;padding-left: 14%;">Leading Lab Equipment Manufacturer in Delhi</h1>
  
  <span><a href="/category/physics-lab-equipment"><button class="view_product">View All Product</button></a></span>
  <div>
   <div class="product">
    <a href="/product/monocular-laboratory-microscope-manufacturers-suppliers-and-exporters">
    <img src="{{ asset('uploads/product_images/Binocular-Laboratory-Microscope.jpg') }}" width="280" height="250">
    <h6>Laboratory Microscope</h6>
</a>
  </div>
  <div class="product2">
     <a href="/product/centrifuge-tube">
    <img src="{{ asset('uploads/product_images/758480Centrifuge%20Tube.jpg') }}" width="280" height="250">
    <h6> Centrifuge Tube</h6>
</a>
  </div>
  <div class="product3">
    <a href="/product/balances">
    <img src="{{ asset('uploads/product_images/14.jpg') }}" width="280" height="250">
    <h6>              Balances </h6>
</a>
  </div>
  <div class="product4">
    <a href="/product/incubators-2">
    <img src="{{ asset('uploads/product_images/Incubators.jpg') }}" width="280" height="250">
    <h6>             Incubators</h6>
</a>
  </div>

<div class="product5">
    <a href="/product/beakers">
    <img src="{{ asset('uploads/product_images/Beaker1.jpg') }}" width="280" height="250">
    <h6>BEAKERS</h6>
</a>
  </div>
  <div class="product6">
    <a href="/product/burette">
    <img src="{{ asset('uploads/product_images/Burette-with-pinch-clip.jpg') }}" width="280" height="250">
    <h6>               Burette</h6>
</a>
  </div>
  <div class="product7">
    <a href="/product/conical-flask">
    <img src="{{ asset('uploads/product_images/Flask-Conical-erlenmeyer.jpg') }}" width="280" height="250">
    <h6>FLASKS</h6>
</a>
  </div>
  <div class="product8">
    <a href="/product/digital-spectrophotometer">
    <img src="{{ asset('uploads/product_images/Digital-Spectrophotometer.jpg') }}" width="280" height="250">
    <h6>Digital Spectrophotometer</h6>
</a>
  </div>
  </div>


  @else
 <h1 class="ts-custom-heading libre-baskerville-bold" style="color:#fff;text-align: center;padding-top: 15px;line-height: initial;padding-left: 20px;">Leading Lab Equipment Manufacturer in Delhi</h1>
  <div class="product">
    <a href="/product/monocular-laboratory-microscope-manufacturers-suppliers-and-exporters">
    <img src="{{ asset('uploads/product_images/Binocular-Laboratory-Microscope.jpg') }}" width="150" height="150">
    <h6>Laboratory Microscope</h6>
    </a>
  </div>
  <div class="product2">
    <a href="/product/centrifuge-tube">
    <img src="{{ asset('uploads/product_images/758480Centrifuge%20Tube.jpg') }}" width="150" height="150">
    <h6> Centrifuge Tube</h6>
    </a>
  </div>
  <div class="product3">
     <a href="/product/balances">
    <img src="{{ asset('uploads/product_images/14.jpg') }}" width="150" height="150">
    <h6>              Balances </h6>
    </a>
  </div>
  <div class="product4">
    <a href="/product/incubators-2">
    <img src="{{ asset('uploads/product_images/Incubators.jpg') }}" width="150" height="150">
    <h6>             Incubators</h6>
    </a>
  </div>

  <div class="product5">
     <a href="/product/beakers">
    <img src="{{ asset('uploads/product_images/Beaker1.jpg') }}" width="150" height="150">
    <h6>BEAKERS</h6>
    </a>
  </div>
  <div class="product6">
    <a href="/product/burette">
    <img src="{{ asset('uploads/product_images/Burette-with-pinch-clip.jpg') }}" width="150" height="150">
    <h6>               Burette</h6>
    </a>
  </div>
  <div class="product7">
<a href="/product/conical-flask">
    <img src="{{ asset('uploads/product_images/Flask-Conical-erlenmeyer.jpg') }}" width="150" height="150">
    <h6>FLASKS</h6>
    </a>
  </div>
  <div class="product8">
     <a href="/product/digital-spectrophotometer">
   <img src="{{ asset('uploads/product_images/Digital-Spectrophotometer.jpg') }}" width="150" height="150">
    <h6>Digital Spe...</h6>
</a>
  </div>
    <span><a href="/category/physics-lab-equipment"><button class="view_product">View All Product</button></a></span>
  

  @endif
  </div>
</div>
<div class="ts-row wpb_row vc_row-fluid vc_custom_1535112868661 ts-responsive-custom-32388294 ts-break-col-991 ts-total-col-2 ts-zindex-0 vc_row container ts-bgimage-position-center_center py-5 lab-tenders">
                <div class="vc_row-o-equal-height vc_row-flex">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                    <div class="vc_column-inner vc_custom_1533205805036 ">
                      <div class="wpb_wrapper">
                        <div class="ts-element-heading-wrapper ts-heading-inner ts-element-align-left ts-seperator-none  vc_custom_1534590104536">
                          <section class="ts-vc_cta3-container">
                            <div class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-with-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading libre-baskerville-bold" >Why Partner With Atico India, The Supreme<br> Laboratory Equipment Suppliers In Delhi?</h2>
                                    </div>
                                  </div>
                                  @if($display==1)
                                  <div class="ts-cta3-content-wrapper boxes">
                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/dep.png') }}"></div>
                                      <h4>Diverse Equipment Portfolio</h4>
                                      <p>Atico India provides many essentials of the laboratory catering to a variety of scientific fields available in its inventory. When it comes to carrying out scientific experiments, we have everything you may require ranging from basic glassworks like flasks and beakers to advanced equipment such as microscopes, spectrophotometers, centrifuges and analytical balances.
                                      </p>
                                    </div>

                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/uq.png') }}"></div>
                                      <h4>Uncompromising Quality</h4>
                                      <p> Quality is not just a buzzword that we take lightly; it is one of our core values. To do this, we strictly follow global certification requirements using contemporary production methods and high-quality materials. Every appliance is thoroughly checked so that it works accurately for a long time.
                                      </p>
                                    </div>

                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/ts.png') }}"></div>
                                      <h4>Tailored Solutions</h4>
                                      <p>We understand that every laboratory is exceptional. We are a team composed of professionals who interact with you closely to know your desires as well as difficulties. Should it be that you want a unique machinery or you are to establish the entire lab, being the top laboratory equipment manufacturers in Delhi we offer services that correspond with your financial plan and missions.
                                      </p>
                                    </div>

                                  </div>
                                  <div class="ts-cta3-content-wrapper boxes">
                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/eds.png') }}"></div>
                                      <h4>Expert Guidance and Support</h4>
                                      <p>Our team is passionate about science and dedicated to your success, this team at the best Lab Equipment Suppliers in Delhi comprises seasoned professionals who will help you with expert guidance on product selection, installation, training and maintenance. Continuous operation of your lab is ensured by our prompt and reliable after-sales support.
                                      </p>
                                    </div>

                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/pii.png') }}"></div>
                                      <h4>Promoting Indian Innovation</h4>
                                      <p>Atico India is one of the top Lab Equipment Manufacturers in Delhi their commitment to 'Make in India' supports the local economy and fosters technological self-reliance, thereby allowing our nation to compete with other brands in the area of laboratory equipment that is produced by some countries.
                                      </p>
                                    </div>

                                    <div class="box ">
                                      <div class="img"><img src="{{ asset('assets/images/cp.png') }}"></div>
                                      <h4>Competitive Pricing</h4>
                                      <p>We hold the opinion that lab equipment should be made available to everybody irrespective of their social classes. We offer prices that are open and in line with those available in the market. We therefore have to find ways in which affordable services can be given to people at a lower burden than it would have been if costlier alternatives were taken into consideration but the tradeoff does not relate to any loss in function or dependability.
                                      </p>
                                    </div>

                                  </div>
                                  @else
                                    <div id="owl-demo" class="owl-carousel owl-theme">
                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/dep.png') }}"></div>
                                              <h4>Diverse Equipment Portfolio</h4>
                                              <p>Atico India provides many essentials of the laboratory catering to a variety of scientific fields available in its inventory. When it comes to carrying out scientific experiments, we have everything you may require ranging from basic glassworks like flasks and beakers to advanced equipment such as microscopes, spectrophotometers, centrifuges and analytical balances.
                                              </p>
                                            </div>
                                      </div>
                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/uq.png') }}"></div>
                                              <h4>Uncompromising Quality</h4>
                                              <p> Being the top Physics Lab Equipment Supplier in Mumbai comes with a great sense of responsibility. We exhibit our sense of responsibility by manufacturing equipment that fully adheres to rigorous international standards pertaining to quality. Year after year, this has been the practice since time immemorial because our equipment is always used daily in the laboratories. Hence, they can endure such harsh conditions and produce dependable answers with time.
                                              </p>
                                            </div>
                                      </div>
                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/ts.png') }}"></div>
                                              <h4>Tailored Solutions</h4>
                                              <p>We understand that every laboratory is exceptional. We are a team composed of professionals who interact with you closely to know your desires as well as difficulties. Should it be that you want a unique machinery or you are to establish the entire lab, being the top laboratory equipment manufacturers in Delhi we offer services that correspond with your financial plan and missions.
                                              </p>
                                            </div>
                                      </div>
                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/eds.png') }}"></div>
                                              <h4>Expert Guidance and Support</h4>
                                      <p>Our team is passionate about science and dedicated to your success, this team at the best Lab Equipment Suppliers in Delhi comprises seasoned professionals who will help you with expert guidance on product selection, installation, training and maintenance. Continuous operation of your lab is ensured by our prompt and reliable after-sales support.
                                      </p>
                                            </div>
                                      </div>

                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/pii.png') }}"></div>
                                              <h4>Promoting Indian Innovation</h4>
                                      <p>Atico India is one of the top Lab Equipment Manufacturers in Delhi their commitment to 'Make in India' supports the local economy and fosters technological self-reliance, thereby allowing our nation to compete with other brands in the area of laboratory equipment that is produced by some countries.
                                      </p>
                                            </div>
                                      </div>

                                      <div class="item" >
                                            <div class="mob_box ">
                                              <div class="img"><img src="{{ asset('assets/images/cp.png') }}"></div>
                                              <h4>Competitive Pricing</h4>
                                      <p>We hold the opinion that lab equipment should be made available to everybody irrespective of their social classes. We offer prices that are open and in line with those available in the market. We therefore have to find ways in which affordable services can be given to people at a lower burden than it would have been if costlier alternatives were taken into consideration but the tradeoff does not relate to any loss in function or dependability.
                                      </p>
                                            </div>
                                      </div>
                                    </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </section>
                        </div>
                        

                      </div>
                    </div>
                  </div>
                 
                  
             
                </div>
              </div>

<div class="ts-row wpb_row vc_row-fluid vc_custom_1535112868661 ts-responsive-custom-32388294 ts-break-col-991 ts-total-col-2 ts-zindex-0 vc_row container ts-bgimage-position-center_center  lab-tenders">
                <div class="vc_row-o-equal-height vc_row-flex">
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-7 ts-zindex-0">
                    <div class="vc_column-inner vc_custom_1533205805036 ">
                      <div class="wpb_wrapper">
                        <div class="ts-element-heading-wrapper ts-heading-inner ts-element-align-left ts-seperator-none  vc_custom_1534590104536">
                          <section class="ts-vc_cta3-container">
                            <div class="ts-vc_general ts-vc_cta3 ts-cta3-only ts-vc_cta3-style-classic ts-vc_cta3-shape-rounded ts-vc_cta3-align-left ts-vc_cta3-color-transparent ts-vc_cta3-icon-size-md ts-vc_cta3-actions-no ts-cta3-with-desc">
                              <div class="ts-vc_cta3_content-container">
                                <div class="ts-vc_cta3-content">
                                  <div class="ts-vc_cta3-content-header ts-wrap">
                                    <div class="ts-vc_cta3-headers ts-wrap-cell">
                                      <h2 class="ts-custom-heading libre-baskerville-bold in-touch"  >Join Atico India Your Trusted<br> Laboratory Equipment<br> Suppliers In Delhi</h2>
                                    </div>
                                  </div>
                                  @if($display==0)
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-5 vc_col-has-fill ts-zindex-0 ts-span ts-right-span">
                    <div class="">
                      <div class="ts-col-wrapper-bg-layer ts-bg-layer ts-bgimage-position-center_center" style="width:100%;">
                        <div class="ts-bg-layer-inner"></div>
                      </div>
                      <div class="wpb_wrapper">
                        <div  class="">
                           <div class="ts-column wpb_column vc_column_container ts-zindex-0">
                           <div class="vc_column-inner  ts-responsive-custom-80978663">
                              <div class="wpb_wrapper">
                                 <img src="{{asset('assets/images/join-atico.png')}}" style="width:100%">
      </div>
                                 </div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                                  <div class="ts-cta3-content-wrapper">
                                    <p>Lab setups in any field need a partnership with Atico India and witness the transformation good lab equipment can bring to your scientific endeavors. Our clientele is growing constantly with researchers, educators and industry practitioners who depend on us when it comes to their lab needs. Let us create a better world collectively. Call laboratory equipment manufacturers in Delhi now for all your lab equipment needs. We are excited to partner with you and empower your dream.
                                    <br>
                                    


                                    </p>
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
                  @if($display==1)
                  <div class="ts-column wpb_column vc_column_container vc_col-sm-5 vc_col-has-fill ts-zindex-0 ts-span ts-right-span">
                    <div class="">
                      <div class="ts-col-wrapper-bg-layer ts-bg-layer ts-bgimage-position-center_center" style="width:100%;">
                        <div class="ts-bg-layer-inner"></div>
                      </div>
                      <div class="wpb_wrapper">
                        <div  class="">
                           <div class="ts-column wpb_column vc_column_container ts-zindex-0">
                           <div class="vc_column-inner  ts-responsive-custom-80978663">
                              <div class="wpb_wrapper">
                                 <img src="{{asset('assets/images/join-atico.png')}}" style="width:100%">
      </div>
                                 </div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  <!-- <div class="all_products">
                    <h2>Leading Lab Equipment Manufacturer in Delhi</h2>
                  </div> -->

                  
                </div>
              </div>

  <script src="https://aticoscientific.com/assets/js/owl.carousel.min531b.js?ver=2.3.4"></script>
<script type="text/javascript">
   $("#owl-demo,#owl-demo1,#owl-demo2,#owl-demo3,#owl-demo4").owlCarousel({

     navigation : true, // Show next and prev buttons

     slideSpeed : 300,
     paginationSpeed : 400,
     autoplay:true,
     autoplayTimeout:5000,
     autoplayHoverPause:true,
     items : 1, 
     itemsDesktop : false,
     itemsDesktopSmall : false,
     itemsTablet: false,
     itemsMobile : false,
     loop: false,
     rewind: true
 });


   
</script>
@endsection

@section('script')

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