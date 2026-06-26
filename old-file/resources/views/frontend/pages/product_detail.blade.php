@extends('frontend.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.exzoom.css') }}">
<style>
#exzoom {
width: 350px;
}
.hidden { display: none; }

.form-control{
   border:1px solid #ced4da !important;
   -webkit-clip-path: unset !important;
   clip-path: unset !important; 
   height: calc(2.25rem + 2px) !important;
   padding: .375rem .75rem !important;
   position: relative !important; 
  width: 100% !important;
  border-radius: 0px !important;
}
.select2-container--default{
  display: none !important;
}
@media(max-width: 768px) {
    .hide{
        display: none !important;
    }
    h1.entry-title {
    font-size: 30px !important;
}
}
</style>



@endsection
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
                <h1 class="entry-title"> {!! $product->name !!}</h1>
              </div>
            </div>
            <div class="breadcrumb-wrapper">
              <div class="container">
                <div class="breadcrumb-wrapper-inner">
                  <!-- Breadcrumb NavXT output --><span><a title="Home" href="{{ route('home') }}" class="home"><span>Home</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><a title="{!! $product->name !!}" class="post post-product-archive"><span>{!! $product->name !!}</span></a></span>
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
<div id="content-wrapper" class="site-content-wrapper">
  <div id="content" class="site-content container">
    <div id="content-inner" class="site-content-inner ">
      <div id="primary" class="content-area  ">
        <main id="main" class="site-main pt-3">
          <nav class="woocommerce-breadcrumb"><a href="{{ route('home') }}">Home</a>&nbsp;&#47;&nbsp;{!! $product->name !!}</nav>
          <div class="woocommerce-notices-wrapper"></div>
          <div id="product-60" class="product type-product post-60 status-publish first instock product_cat-accessories has-post-thumbnail sale featured shipping-taxable purchasable product-type-simple">
            <!-- <span class="onsale">Sale!</span> -->
            
            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images product_detail_img" data-columns="4" style="opacity: 0; transition: opacity .25s ease-in-out;">
              <div class="">
                <div class="container_zoom">
                  <div class="exzoom hidden" id="exzoom">
                    <div class="exzoom_img_box">
                      <ul class='exzoom_img_ul'>
                        
                        <li><img src="{{ asset($product->image ? 'uploads/product_images/'.$product->image : 'assets/frontend/images/no_product.png') }}"/></li>
                        
                      </ul>
                    </div>
                    <!-- <div class="exzoom_nav"></div> -->
                    <!-- <p class="exzoom_btn">
                      <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                      <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                    </p> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="summary entry-summary product_detail_right">
              <h2 class="product_title entry-title">{!! $product->name !!}</h2>
              <span class="sku_wrapper sku_wrapper_cats">Categories: <span class="sku">
                @if(count(getAllProductCats($product->id))>0)
                @foreach(getAllProductCats($product->id) as $key => $cat)
                <a href="{{ route('categories', $cat->slug) }}">{!! $cat->name !!}</a>
                @endforeach
                @endif
              </span></span>
              <hr>
              <!-- <div class="woocommerce-product-rating">
                <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span></div>
                <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span class="count">1</span> customer review)</a>
              </div> -->
              <!-- <p class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>18.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>16.00</span></ins></p> -->
              <div class="woocommerce-product-details__short-description">
                <p>{!! str_limit(strip_tags($product->description), 200) !!}</p>
              </div>
              <div class="product_meta">
                @if($product['product_code'])
                <span class="sku_wrapper sku_wrapper_code mb-3">Product Code: <span class="sku">
                  <b>{!! $product['product_code'] !!}</b>
                </span></span><br>
                @endif
                
                <ul class="pl-0 product-detail-icons">
                  <li><img src="{{ asset('assets/frontend/images/ISO-certified.png') }}" class="img-fluid"></li>
                  <li><img src="{{ asset('assets/frontend/images/24X7-Support.png') }}" class="img-fluid"></li>
                  <li><img src="{{ asset('assets/frontend/images/High-Quality.png') }}" class="img-fluid"></li>
                  <li><img src="{{ asset('assets/frontend/images/after-sales-service.png') }}" class="img-fluid"></li>
                  <!-- <li><img src="{{ asset('assets/frontend/images/low_maintenance.png') }}" class="img-fluid"></li>
                  <li><img src="{{ asset('assets/frontend/images/eco_friendly.png') }}" class="img-fluid"></li> -->
                </ul>
                <ul class="product_detail_btns pl-0 mt-4">
                  <li><a data-toggle="modal" data-target="#query">Buy This Product</a></li>
                  <li class="hide"><a onclick="smoothScrollTo('#product-detail-descr', 1000, 0)">About this equipment</a></li>
                  <!-- <li><a onclick="smoothScrollTo('#prod-revw', 1000, 10)">Product Reviews</a></li> -->
                  <li class="hide"><a onclick="smoothScrollTo('#related-prod', 1500, 0)">Related Products</a></li>
                </ul>
              </div>
            </div>
            <section id="product-detail-descr" class="product-detail-desc pt-5">
              <div class="container">
                <div class="row">
                  
                  <div class="col-12 d-sm-block d-none">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#desc">description</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#revw">reviews</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="desc" class="container tab-pane active"><br>
                        <div class="dustrial-stitle-5d4eb622f02c8 section-title">
                          <div class="section-thumb">
                            <img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/01/title-icon-1-2.png') }}" alt="title icon">
                          </div>
                          <div class="section-body">
                            <h6 class="sub-title activeColor">Product</h6>
                            <h3 class="m-0 main-title">Description</h3>
                          </div>
                        </div>
                        <p>{!! $product->description !!}</p>
                      </div>
                      
                      <div id="revw" class="container tab-pane fade"><br>
                        <section class="blog-comments product-reviews" id="prod-revw">
                          <div class="dustrial-stitle-5d4eb622f02c8 section-title">
                            <div class="section-thumb">
                              <img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/01/title-icon-1-2.png') }}" alt="title icon">
                            </div>
                            <div class="section-body">
                              <h6 class="sub-title activeColor">Product</h6>
                              <h3 class="m-0 main-title">Reviews</h3>
                            </div>
                          </div>
                          <div class="container">
                            <div class="row">
                              <div class="col-xl-11 mx-auto">
                                <div class="row">
                                  
                                  <div class="col-xl-5 col-lg-6 col-12 my-3">
                                    <div class="form-comment">
                                      <h6 class="text-capitalize hd my-0">add Review</h6>
                                      <form action="{{ route('product_review_store') }}" id="record-comment" enctype="multipart/form-data">
                                        
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                        <div class="row">
                                          <div class="col-12 my-2">
                                            <input class="form-control" type="text" placeholder="First Name" name="name">
                                          </div>
                                          <div class="col-12 my-2">
                                            <input class="form-control" type="email" placeholder="Your Email" name="email">
                                          </div>
                                          
                                          <div class="col-12 my-2">
                                            <textarea class="form-control" rows="4" placeholder="Write Comment" name="review"></textarea>
                                          </div>
                                          <div class="col-12 mt-2">
                                            <input type="hidden" name="rating" id="rating-field">
                                            
                                            <div class="">
                                              <div class="rating selection">
                                                @for ($i = 5; $i >= 1; $i--)
                                                <span class="{{old('rating') == $i ? 'active' : ''}}">☆</span>
                                                @endfor
                                              </div>
                                            </div>
                                          </div>
                                          
                                          <div class="col-12 mt-4">
                                            <button class="btn text-uppercase" type="submit">submit</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                  <div class="col-xl-6 offset-xl-1 col-lg-6 col-12 my-3">
                                    <h6 class="text-capitalize hd">reviews</h6>
                                    <ul class="pl-0 mb-0 user-comments">
                                      @if(count($product_reviews)>0)
                                      @foreach($product_reviews as $key => $product_review)
                                      <li class="review">
                                        <div class="row">
                                          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3">
                                            <img class="img-fluid vmdl" src="{{ asset('assets/frontend/images/user-img1.png') }}" alt="">
                                          </div>
                                          <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                            <div class="row">
                                              <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6 col-12">
                                                <h5 class="text-capitalize mb-1">{!! $product_review->name !!}<small class="d-inline-block"></small>
                                                </h5>
                                                <div class="rating inactive pl-0 mb-0 stars d-inline-block">
                                                  @for ($i = 5; $i >= 1; $i--)
                                                  <span class="{{$product_review->rating == $i ? 'active' : ''}}">☆</span>
                                                  @endfor
                                                </div>
                                                <h6 class="mb-1">{!! $product_review->email !!}</h6>
                                                <h6 class="mb-0">{!! $product_review->review !!}</h6>
                                              </div>
                                              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 text-sm-right">
                                                <h5 class="text-capitalize mb-sm-4">{!! date('d/m/Y', strtotime($product_review->created_at)) !!}</h5>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                      @endforeach
                                      @else
                                      <p>No Review Yet.</p>
                                      @endif
                                      
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 d-sm-none d-block">
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header">
                          <a class="card-link text-uppercase" data-toggle="collapse" href="#collapseOne">
                            description
                          </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                          <div class="card-body">
                            <h6 class="text-uppercase bg-col">quick overview :</h6>
                            <p>{!! $product->description !!}</p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed card-link text-uppercase" data-toggle="collapse" href="#collapseFour">
                            reviews
                          </a>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <section class="blog-comments py-5" id="prod-revw">
                              <div class="dustrial-stitle-5d4eb622f02c8 section-title  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="section-thumb">
                                  <img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/01/title-icon-1-2.png') }}" alt="title icon">
                                </div>
                                <div class="section-body">
                                  <h6 class="sub-title activeColor">Product</h6>
                                  <h3 class="m-0 main-title">Reviews</h3>
                                </div>
                              </div>
                              <div class="container">
                                <div class="row">
                                  <div class="col-xl-11 mx-auto">
                                    <div class="row">
                                      
                                      <div class="col-xl-5 col-lg-6 col-12 my-3">
                                        <div class="form-comment">
                                          <h6 class="text-capitalize hd">add Review</h6>
                                          <form action="{{ route('product_review_store') }}" id="record-comment-mob" enctype="multipart/form-data">
                                            
                                            {{ csrf_field() }}
                                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                            <div class="row">
                                              <div class="col-12 my-2">
                                                <input class="form-control" type="text" placeholder="First Name" name="name">
                                              </div>
                                              <div class="col-12 my-2">
                                                <input class="form-control" type="email" placeholder="Your Email" name="email">
                                              </div>
                                              
                                              <div class="col-12 my-2">
                                                <textarea class="form-control" rows="4" placeholder="Write Comment" name="review"></textarea>
                                              </div>
                                              <div class="col-12 mt-2">
                                                <input type="hidden" name="rating" id="rating-field">
                                                
                                                <div class="">
                                                  <div class="rating selection">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                    <span class="{{old('rating') == $i ? 'active' : ''}}">☆</span>
                                                    @endfor
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="col-12 mt-4">
                                                <button class="btn text-uppercase" type="submit">submit</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                      <div class="col-xl-6 offset-xl-1 col-lg-6 col-12 my-3">
                                        <h6 class="text-capitalize hd">reviews</h6>
                                        <ul class="pl-0 mb-0 user-comments">
                                          @if(count($product_reviews)>0)
                                          @foreach($product_reviews as $key => $product_review)
                                          <li class="review">
                                            <div class="row">
                                              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3">
                                                <img class="img-fluid vmdl" src="{{ asset('assets/frontend/images/user-img1.png') }}" alt="">
                                              </div>
                                              <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                                <div class="row">
                                                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6 col-12">
                                                    <h5 class="text-capitalize mb-1">{!! $product_review->name !!}<small class="d-inline-block"></small>
                                                    </h5>
                                                    <div class="rating inactive pl-0 mb-0 stars d-inline-block">
                                                      @for ($i = 5; $i >= 1; $i--)
                                                      <span class="{{$product_review->rating == $i ? 'active' : ''}}">☆</span>
                                                      @endfor
                                                    </div>
                                                    <h6 class="mb-1">{!! $product_review->email !!}</h6>
                                                    <h6 class="mb-0">{!! $product_review->review !!}</h6>
                                                  </div>
                                                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 text-sm-right">
                                                    <h5 class="text-capitalize mb-sm-4">{!! date('d/m/Y', strtotime($product_review->created_at)) !!}</h5>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </li>
                                          @endforeach
                                          @else
                                          <p>No Review Yet.</p>
                                          @endif
                                          
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <!-- <ul class="rate pl-0">
                              <li>
                                <ul class="stars pl-0 mb-0 position-relative">
                                  <li><i class="fa fa-star chk"></i></li>
                                  <li><i class="fa fa-star chk"></i></li>
                                  <li><i class="fa fa-star chk"></i></li>
                                  <li><i class="fa fa-star chk"></i></li>
                                  <li><i class="fa fa-star-half-o chk"></i></li>
                                </ul>
                              </li>
                              <li><p class="text-capitalize">{{ count($product_reviews) }} Reviews</p></li>
                            </ul>
                            <h5 class="text-uppercase">rate it..!!</h5>
                            <p>Have you used this product yet?</p>
                            <a class="rvw" onclick="smoothScrollTo('#prod-revw', 1000, 10)" class="text-uppercase btn p_read mb-3">write a review</a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <div class="product-details-related-product pb-5" id="related-prod">
              <section class="related products">
                <div class="dustrial-stitle-5d4eb622f02c8 section-title  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                  <div class="section-thumb">
                    <img src="{{ asset('assets/frontend/css/wp-content/uploads/2019/01/title-icon-1-2.png') }}" alt="title icon">
                  </div>
                  <div class="section-body">
                    <h6 class="sub-title activeColor">Related</h6>
                    <h3 class="m-0 main-title">Products</h3>
                  </div>
                </div>
                <div class="main-products-wrapper">
                  <div class="row">
                    @if(count(getRelatedProducts($product->id))>0)
                    @foreach(getRelatedProducts($product->id) as $key => $related_product)
                    <div class="ts-box-col-wrapper col-lg-3 col-sm-4 col-md-3 col-xs-12 oncology products-box">
                      <article class="themestek-box themestek-box-portfolio ts-portfoliobox-style-1 ts-hover-style-2">
                        <div class="themestek-post-item">
                          <span class="themestek-item-thumbnail">
                            <span class="themestek-item-thumbnail-inner">
                              <a href="{{ route('product_detail', $related_product->slug) }}"><img width="800" height="650" src="{{ asset($related_product->image ? 'uploads/product_images/'.$related_product->image : 'assets/frontend/images/no_product.png') }}" class="attachment-themestek-img-800x650 size-themestek-img-800x650 wp-post-image" alt="" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';" /></a>
                            </span>
                          </span>
                          <div class="themestek-box-content">
                            <div class="themestek-box-content-inner">
                              <div class="themestek-pf-box-title">
                                <!-- <div class="themestek-box-category"><a href="{{ route('product_detail', $related_product->slug) }}" rel="tag">Oncology</a></div> -->
                                <h3><a href="{{ route('product_detail', $related_product->slug) }}">{!! str_limit($related_product->name, 25) !!}</a></h3>
                              </div>
                              <div class="themestek-box-desc">
                                <p>{!! str_limit(strip_tags($related_product->description), 60) !!}</p>
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
              </section>
            </div>
            
            
          </div>
        </main>
      </div>
      <!-- #sidebar-right -->
    </div>
    <!-- .site-content-inner -->
  </div>
  <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->
<div class="modal fade" id="query">
  <div class="modal-dialog modal-dialog-centered" id="query">
    <div class="modal-content">
      <div class="modal-header text-center">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h4 class="modal-title text-center">{!! $product->name !!} - Query</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="">
          <form action="{{ route('product_query.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="row">
              <div class="col-12 py-2">
                <label for="name">Name:</label>
                <input type="text" name="name" required="true" class="form-control" value="{{ old('name') }}">
                @if($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
              </div>
              <div class="col-12 py-2">
                <label for="name">E-mail:</label>
                <input type="email" name="email" class="form-control" required="true" value="{{ old('email') }}">
                @if($errors->has('email'))
                <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
              </div>
              <div class="col-12 py-2">
                <label for="name">Country:</label>
                <select name="country" required="" class="form-control">
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
                <label for="name">Phone Number:</label>
                <input type="number" class="form-control" name="phone_number" required="true" value="{{ old('phone_number') }}">
                @if($errors->has('phone_number'))
                <span class="text-danger">{{$errors->first('phone_number')}}</span>
                @endif
              </div>
              <div class="col-12 py-2">
                <label for="name">Quantity:</label>
                <input type="number" class="form-control" name="quantity" required="true" value="{{ old('quantity') }}">
                @if($errors->has('quantity'))
                <span class="text-danger">{{$errors->first('quantity')}}</span>
                @endif
              </div>
              
              <div class="col-12 py-2">
                <label for="name">Message:</label>
                <textarea rowspan="5" name="message" id="message" class="form-control" required="true"></textarea>{{ old('message') }}
                @if($errors->has('message'))
                <span class="text-danger">{{$errors->first('message')}}</span>
                @endif
              </div>
              <div class="col-12 py-2">
                <div class="g-recaptcha" data-sitekey="6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_"></div>
              </div>
              <input type="hidden" name="ip_address" id="ip_address">
              <input type="hidden" name="page_url" value=<?=  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?> >
              <div class="col-12 py-2">
                <div class="button text-center">
                  <button class="text-center btn" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- QUERY-MODAL ENDS -->
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
@endsection
@section('script')
<!-- Image Zoom -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('assets/frontend/js/jquery.exzoom.js') }}"></script>
<!-- Image Zoom Close -->
<script type="text/javascript">
$('.container_zoom').imagesLoaded( function() {
$("#exzoom").exzoom({
autoPlay: false,
});
$("#exzoom").removeClass('hidden')
});
@if (Session::has('errors'))
$('#query').modal('show');
//swal('Success!', "{{ Session::get('success') }}", 'success');
@endif
@if (Session::has('success'))
$("#modal_success_message").html( "{!! Session::get('success') !!}" );
$('#successModal').modal('show');
//swal('Success!', "{{ Session::get('success') }}", 'success');
@endif
</script>
<script>
$(document).ready(function(){
$('#record-comment').submit(function(e){
e.preventDefault();
submitForm($(this), function(response){
if (typeof response.message != 'undefined') {
$("#modal_success_message").html(response.message);
$('#successModal').modal('show');
//window.location.href = response.url;
removeInputsNErrors('#record-comment');
//swal('success!', response.message, 'success');
}
});
});
});
$(document).ready(function(){
$('#record-comment-mob').submit(function(e){
e.preventDefault();
submitForm($(this), function(response){
if (typeof response.message != 'undefined') {
$("#modal_success_message").html(response.message);
$('#successModal').modal('show');
//window.location.href = response.url;
removeInputsNErrors('#record-comment');
//swal('success!', response.message, 'success');
}
});
});
});


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