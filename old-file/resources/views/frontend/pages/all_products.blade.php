@extends('frontend.layouts.app')
@section('content')
<div class="ts-titlebar-wrapper ts-bg ts-bgcolor-transparent ts-titlebar-align-left ts-textcolor-white ts-bgimage-yes">
   <div class="ts-titlebar-wrapper-bg-layer ts-bg-layer"></div>
   <div class="ts-titlebar entry-header">
      <div class="ts-titlebar-inner-wrapper">
         <div class="ts-titlebar-main">
            <div class="container">
               <div class="ts-titlebar-main-inner">
                  <div class="entry-title-wrapper">
                     <div class="container">
                        <h1 class="entry-title"> Products</h1></div></div><div class="breadcrumb-wrapper"><div class="container"><div class="breadcrumb-wrapper-inner"><!-- Breadcrumb NavXT output --><span><a title="Home" href="{{ route('home') }}" class="home"><span>Home</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><span>Products</span></span></div></div></div>                   </div>
                  </div>
                  </div><!-- .ts-titlebar-main -->
                  </div><!-- .ts-titlebar-inner-wrapper -->
                  </div><!-- .ts-titlebar -->
                  </div><!-- .ts-titlebar-wrapper -->
                  
                  <div id="content-wrapper" class="site-content-wrapper container">
                     <div id="content" class="site-content ">
                        <div id="content-inner" class="site-content-inner ">
                           <div id="primary" class="content-area ">
                              <main id="main" class="site-main">
                                 <article id="post-6606" class="post-6606 page type-page status-publish hentry">
                                    
                                    <div class="entry-content">
                                       <div data-vc-full-width="true" data-vc-full-width-init="false" class="ts-row wpb_row vc_row-fluid ts-total-col-1 ts-zindex-0 ts-bgimage-position-center_center product-page">
                                          <div class="vc_row container">
                                             <div class="ts-column wpb_column vc_column_container col-sm-9 ts-zindex-0" style="float: left;">
                                                
                                                <p class="woocommerce-result-count">
                           Showing all {{ count($products) }} results
                        </p>

                        <div class="vc_col-sm-12 mb-5">
                            <p style="margin-top: 25px; float: left; width: 100%;">If you are a college or university looking to setup a complete lab. Please contact us with your details for custom quotation.</p>
                           <div class="search-certificate text-center">
                              <form action="{{ route('product_search') }}" method="post">
                                 {!! csrf_field() !!}
                                 
                                 <input class="main-search" name="q" id="transcript" type="text" placeholder="Search..">
                                 <button type="submit"><i class="fa fa-search"></i></button>
                              </form>
                           </div>
                        </div>
                                                
                                              
                                                <div class="vc_column-inner  " style="float: left; width: 100%">
                                                   <div class="wpb_wrapper">
                                                      <div class="themestek-boxes themestek-boxes-portfolio themestek-boxes-view-default themestek-boxes-col-three themestek-boxes-sortable-no themestek-boxes-textalign-center themestek-boxes-sortablebutton-">
                                                         <div class="themestek-boxes-inner themestek-boxes-portfolio-inner ">
                                                            <div class="row multi-columns-row themestek-boxes-row-wrapper">
                                                               
                                                               @if(count($products)>0)
                                                               @foreach($products as $key => $product)
                                                               <div class="ts-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 oncology products-box">
                                                                  <article class="themestek-box themestek-box-portfolio ts-portfoliobox-style-1 ts-hover-style-2">
                                                                     <div class="themestek-post-item">
                                                                        <span class="themestek-item-thumbnail">
                                                                           <span class="themestek-item-thumbnail-inner">
                                                                              <a href="{{ route('product_detail', $product->slug) }}"><img width="800" height="650" src="{{ asset($product->image ? 'uploads/product_images/'.$product->image : 'assets/frontend/images/no_product.png') }}" class="attachment-themestek-img-800x650 size-themestek-img-800x650 wp-post-image" alt="" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';" /></a>
                                                                           </span>
                                                                        </span>
                                                                        <div class="themestek-box-content">
                                                                           <div class="themestek-box-content-inner">
                                                                              <div class="themestek-pf-box-title">
                                                                                 <!-- <div class="themestek-box-category"><a href="{{ route('product_detail', $product->slug) }}" rel="tag">Oncology</a></div> -->
                                                                                 <h3><a href="{{ route('product_detail', $product->slug) }}">{!! str_limit($product->name, 25) !!}</a></h3>
                                                                              </div>
                                                                              <div class="themestek-box-desc">
                                                                                <p>{!! str_limit(strip_tags($product->description), 60) !!}</p>
                                                                                
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </article>
                                                               </div>
                                                               @endforeach
                                                               @else
                                                               <div class="col-12 text-center">
                                                                  <img src="{{ asset('assets/frontend/images/not_found.jpg') }}" class="img-fluid">
                                                               </div>
                                                               @endif
                                                            </div>
                                                         </div>
                                                         <!-- .themestek-boxes-inner -->
                                                      </div>
                                                      <!-- .themestek-boxes -->
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-xl-3 col-lg-3 mb-3 order-1 order-lg-0" style="float: left;">
                                              
                                                   <div id="market_post_widget-1" class="dustrial_market_rp_widget market-widget">
                                                        <form action="{{ route('send_enquiry') }}" method="post" style="background: #f3f3f3; padding: 10px; margin-bottom: 40px;">
			    <h3 style="font-size: 24px; color: #3368c6; font-weight: 600; padding-top: 10px;">Send Enquiry</h3> 
                {{ csrf_field() }}
                <div class="row">
                <div class="col-12 py-2">
                  <input type="text" name="name" required="true" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Name" class="form-control" value="{{ old('name') }}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <input type="email" name="email" class="form-control" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="E-mail" required="true" value="{{ old('email') }}">
                  @if($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <select name="country" required="" class="form-control" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;">
                    <option value="">Select Country</option>
                    @foreach(getCountries() as $key => $country)
                    <option value="{!! $country->name !!}" {{ old('country') == $country->name ? 'selected':'' }}>{!! $country->name !!}</option>
                    @endforeach
                  </select>
                  @if($errors->has('country'))
                  <span class="text-danger">{{$errors->first('country')}}</span>
                  @endif
                </div>
                <div class="col-12 py-2">
                  <input type="number" class="form-control" name="phone_number" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Phone Number" required="true" value="{{ old('phone_number') }}">
                  @if($errors->has('phone_number'))
                  <span class="text-danger">{{$errors->first('phone_number')}}</span>
                  @endif
                </div>
                
                <div class="col-12 py-2">
                  <textarea rowspan="5" name="message" id="message" style="margin-bottom: 5px;padding: 6px 10px;font-size: 14px;" placeholder="Message" class="form-control" required="true"></textarea>{{ old('message') }}
                  @if($errors->has('message'))
                  <span class="text-danger">{{$errors->first('message')}}</span>
                  @endif
                </div>
                <div class="form-group">
              <input type="file" name="file" id="file">
                                          </div>
                <div class="col-12 py-2">
                  <div class="button text-center">
                    <button class="text-center btn" type="submit" style="margin-top: 0px; margin-bottom: 5px;">Submit</button>
                  </div>
                </div>
              </div>
            </form>
                                                      <div class="">
                                                         <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                                                            <div class="vc_column-inner  ">
                                                               <div class="wpb_wrapper">
                                                                  <h5 style="text-align:left;" class="ts-custom-heading ">Categories</h5>
                                                                  
                                                                  
                                                                  <div class="">
                                                                     <div class="vc_tta-panels">
                                                                        
                                                                        <div id="accordion">
                                                                           @if(count(sidebarCategories())>0)
                                                                           @foreach(sidebarCategories() as $key => $category)
                                                                           <div class="card">
                                                                              <div class="card-header">
                                                                                 <a class="card-link {{ $loop->iteration == '1' ? '' : 'collapsed' }}" data-toggle="collapse" href="#collapse-{{ $category->slug }}">
                                                                                    {!! $category->name !!}
                                                                                 </a>
                                                                              </div>
                                                                              <div id="collapse-{{ $category->slug }}" class="collapse {{ $loop->iteration == '1' ? 'show' : '' }}" data-parent="#accordion">
                                                                                 @foreach($category->sub_cats as $key => $sub_cat)
                                                                                 <p class="mb-0"><a href="{{ route('categories', $sub_cat->slug) }}">{!! $sub_cat->name !!}</a></p>
                                                                                 
                                                                                 @endforeach
                                                                              </div>
                                                                           </div>
                                                                           @endforeach
                                                                           @endif
                                                                        </div>
                                                                        
                                                                     </div>
                                                                  </div>
                                                                  
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!-- <div id="tab-list-block">
                                                         <div class="market-list-group">
                                                            <ul>
                                                               
                                                               <li><a class="" href="{{ route('categories', $category->slug) }}">{!! $category->name !!}</a></li>
                                                               
                                                            </ul>
                                                         </div>
                                                      </div> -->
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
                   
                    

<script type="text/javascript">
var products = JSON.parse('{!! getSearchAllProduct() !!}');
var productDetailPageUrl = "{{ route('product_detail', 'product_slug') }}";
</script>
@endsection