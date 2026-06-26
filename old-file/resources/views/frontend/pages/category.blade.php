@extends('frontend.layouts.app')
@section('content')
<!-- End Header -->
<div class="ts-titlebar-wrapper ts-bg ts-bgcolor-transparent ts-titlebar-align-left ts-textcolor-white ts-bgimage-yes">
	<div class="ts-titlebar-wrapper-bg-layer ts-bg-layer"></div>
	<div class="ts-titlebar entry-header">
		<div class="ts-titlebar-inner-wrapper">
			<div class="ts-titlebar-main">
				<div class="container">
					<div class="ts-titlebar-main-inner">
						<div class="entry-title-wrapper">
							<div class="container">
								<h1 class="entry-title">
								@if(isset($sub_sub_cat))
								@php
								$category_detail = $sub_sub_cat;
								@endphp
								@elseif(isset($sub_cat))
								@php
								$category_detail = $sub_cat;
								@endphp
								@elseif(isset($cat))
								@php
								$category_detail = $cat;
								@endphp
								@else
								@php
								$category_detail = $category;
								@endphp
								@endif
								@if($category_detail)
								{!! $category_detail['name'] !!} @endif </h1>
							</div>
						</div>
						<div class="breadcrumb-wrapper">
							<div class="container">
								<div class="breadcrumb-wrapper-inner">
									<span><a href="{{ route('home') }}" class="home"><span>Home</span></a></span>
									<span class="archive post-product-archive current-item">
										@if(isset($cat))
										<i class="fa fa-angle-right pl-1" aria-hidden="true"></i> {!! $cat['name'] !!}
										@else
										<i class="fa fa-angle-right pl-1" aria-hidden="true"></i> {!! $category['name'] !!}
										@endif
									</span>
									<span class="archive post-product-archive current-item">
										@if(isset($sub_cat))
										<i class="fa fa-angle-right pl-1" aria-hidden="true"></i> @if($sub_cat) {!! $sub_cat['name'] !!} @endif
										@endif
									</span>
									<span class="archive post-product-archive current-item">
										@if(isset($sub_sub_cat['name']))
										<i class="fa fa-angle-right pl-1" aria-hidden="true"></i> {!! $sub_sub_cat['name'] !!}
										@endif
									</span>
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
		<div id="content-inner" class="site-content-inner row multi-columns-row">
			<div id="primary" class="content-area col-md-8 col-lg-8 col-xs-12 ">
				<main id="main" class="site-main pt-3">
					<nav class="woocommerce-breadcrumb"><a href="{{ route('home') }}">Home</a>@if(isset($cat))
					&nbsp;&#47;&nbsp;{!! $cat['name'] !!}
					@else
					&nbsp;&#47;&nbsp;{!! $category['name'] !!}
					@endif
					@if(isset($sub_cat))
					&nbsp;&#47;&nbsp;{!! $sub_cat['name'] !!}
					@endif
					@if(isset($sub_sub_cat))
					&nbsp;&#47;&nbsp; {!! $sub_sub_cat['name'] !!} 
					@endif
				</nav>
				<header class="woocommerce-products-header">
					<h2 class="woocommerce-products-header__title page-title">{!! $category_detail['name'] !!}</h2>
				</header>
				<div class="woocommerce-notices-wrapper"></div>
				<p class="woocommerce-result-count">
					Showing all {{ count($categories) }} results for "<b>{!! $category_detail['name'] !!}</b>"
				</p>
				<div class="col-12 mb-4">
					<div class="category-img-desc">
						@if($category_detail['description'] != '')
						<img alt="{{$category_detail['img_alt']}}" width="362" height="262" src="{{ asset($category_detail['image'] ? 'uploads/product_images/'.$category_detail['image'] : 'assets/frontend/images/no_product.png') }}"  />
						@endif
						@if(isset($cat))
						{!! $cat['description'] !!}
						@else
						{!! $category['description'] !!}
						@endif
					<p style="margin-top: 25px; float: left; width: 100%; font-size: 18px;">If you are a college or university looking to setup a complete lab. Please contact us with your details for custom quotation.</p>	
						
					</div>
				</div>
				<div class="col-12 mb-4 cat-search" style="width: 100%; float: left;">
					<div class="search-certificate text-center">
						<form action="{{ route('category_search') }}" method="post">
							{!! csrf_field() !!}
							<input type="hidden" name="slug" value="{{ $category_detail['slug'] }}">
							<input class="main-search" name="q" id="transcript" type="text" placeholder="Search..">
							<button type="submit"><i class="fa fa-search"></i>Search</button>
						</form>
					</div>
				</div>
				<div class="row multi-columns-row themestek-boxes-row-wrapper" style="display: none;">
					@if(count($categories)>0)
					@foreach($categories as $key => $category)
					<div class="ts-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 category_box">
						<article class="themestek-box themestek-box-service ts-servicebox-style-3 category_border">
							<div class="themestek-post-item">
								<span class="themestek-item-thumbnail category_box">
									<span class="themestek-item-thumbnail-inner">
										<a href="{{ route('categories', $category->slug) }}"><img width="800" height="650" src="{{ asset($category->image ? 'uploads/product_images/'.$category->image : 'assets/frontend/images/no_product.png') }}" class="attachment-themestek-img-800x650 size-themestek-img-800x650 wp-post-image" alt="{{$category->img_alt}}" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';"/></a>
									</span>
								</span>
								<div class="themestek-box-content">
									<div class="themestek-box-content-inner">
										<div class="themestek-pf-box-title">
											<!-- <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
														<i class="ts-labtechco-business-icon ts-labtechco-business-icon-flask"></i>
											</div> -->
											<h3><a href="{{ route('categories', $category->slug) }}">{!! str_limit($category->name, 20) !!}</a></h3>
											<div class="themestek-service-content">
												<p>{!! str_limit(strip_tags($category->description), 50) !!}</p>
											</div>
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


				<div class="vc_column-inner  " style="float: left; width: 100%">
                                                   <div class="wpb_wrapper">
                                                      <div class="themestek-boxes themestek-boxes-portfolio themestek-boxes-view-default themestek-boxes-col-three themestek-boxes-sortable-no themestek-boxes-textalign-center themestek-boxes-sortablebutton-">
                                                         <div class="themestek-boxes-inner themestek-boxes-portfolio-inner ">
                                                            <div class="row multi-columns-row themestek-boxes-row-wrapper">
                                                               @if(count($categories)>0)
					@foreach($categories as $key => $category)
					<div class="ts-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 category_box">
						<article class="themestek-box themestek-box-service ts-servicebox-style-3 category_border">
							<div class="themestek-post-item">
								<span class="themestek-item-thumbnail category_box">
									<span class="themestek-item-thumbnail-inner">
										<a href="{{ route('categories', $category->slug) }}"><img width="800" height="650" src="{{ asset($category->image ? 'uploads/product_images/'.$category->image : 'assets/frontend/images/no_product.png') }}" class="attachment-themestek-img-800x650 size-themestek-img-800x650 wp-post-image" alt="{{$category->img_alt}}" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';"/></a>
									</span>
								</span>
								<div class="themestek-box-content">
									<div class="themestek-box-content-inner">
										<div class="themestek-pf-box-title">
											<!-- <div class="ts-ihbox-icon ts-large-icon ts-icon-skincolor">
														<i class="ts-labtechco-business-icon ts-labtechco-business-icon-flask"></i>
											</div> -->
											<h3><a href="{{ route('categories', $category->slug) }}">{!! str_limit($category->name, 20) !!}</a></h3>
											<div class="themestek-service-content">
												<p>{!! str_limit(strip_tags($category->description), 50) !!}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</article>
					</div>
					@endforeach
					@endif
                                                               @if(count($products)>0)
                                                               @foreach($products as $key => $product)
                                                               <div class="ts-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 oncology products-box">
                                                                  <article class="themestek-box themestek-box-portfolio ts-portfoliobox-style-1 ts-hover-style-2">
                                                                     <div class="themestek-post-item">
                                                                        <span class="themestek-item-thumbnail">
                                                                           <span class="themestek-item-thumbnail-inner">
                                                                              <a href="{{ route('product_detail', $product->slug) }}"><img width="800" height="650" src="{{ asset($product->image ? 'uploads/product_images/'.$product->image : 'assets/frontend/images/no_product.png') }}" class="attachment-themestek-img-800x650 size-themestek-img-800x650 wp-post-image" alt="{{$product->img_alt}}" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';" /></a>
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
			</main>
		</div>
		<div class="col-xl-4 col-lg-4 my-3 order-1 order-lg-0">
			<div id="market_post_widget-1" class="dustrial_market_rp_widget market-widget">
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
              <input type="hidden" name="page_url" value=<?=  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?> >
</div>
<input type="hidden" name="ip_address" id="ip_address">
              <p><button data-res="<?php echo $sum; ?>" type="submit" class="get_quote_btn">send message</button>
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
		<!-- #sidebar-right -->
	</div>
	<!-- .site-content-inner -->
</div>
<!-- .site-content -->
</div>
<script type="text/javascript">
var products = JSON.parse('{!! getSearchCategories($category_detail['slug']) !!}');
var productDetailPageUrl = "{{ route('categories', 'product_slug') }}";
</script>
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
<script>
    const submitButton = document.querySelector('[type="submit"]');
const quizInput = document.querySelector(".quiz-control");
quizInput.addEventListener("input", function(e) {
	const res = submitButton.getAttribute("data-res");
	if ( this.value == res ) {
		submitButton.removeAttribute("disabled");
	} else {
		submitButton.setAttribute("disabled", "");
	}
});
</script>
@endsection
@section('script')
<!-- Image Zoom Close -->
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