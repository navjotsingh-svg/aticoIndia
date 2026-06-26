 <div class="main-products-wrapper" style="width:100%;">
                        <div class="row">
                           @if(count($products)>0)
                           <div class="col-md-12">
                           <h4>Products</h4>
                           
                        </div>
                           @foreach($products as $key => $product)
                           <div class="col-md-4 col-sm-6 product-item product type-product post-1969 status-publish first instock product_cat-cutter product_cat-grinder has-post-thumbnail sale shipping-taxable purchasable product-type-simple product_box">
                              <div class="shop-product-single">
                                 <div class="product-img">
                                    <!-- <span class="onsale">{!! $product->product_code !!}</span> -->
                                    <a href="{{ route('product_detail', $product->slug) }}"><img width="300" height="300" src="{{ asset($product->image ? 'uploads/product_images/'.$product->image : 'assets/frontend/images/no_product.png') }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" 
                                    alt="{{$product->img_alt}}" onerror="this.onerror=null;this.src='{{ asset("assets/frontend/images/no_product.png") }}';"></a>
                                    <!-- <div class="product-price-in-thumb">
                                       <span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>15.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>12.00</span></ins></span>
                                    </div> -->
                                 </div>
                                 <div class="product-content">
                                    <p class="text-left px-2" style="font-size: 22px; margin-top: 15px; margin-bottom: 3px;"><a href="{{ route('product_detail', $product->slug) }}" style="color: #061538;">{!! str_limit($product->name, 40) !!}</a></p>
                                    <p class="card-text text-left px-2">{!! str_limit(strip_tags($product->description), 60) !!}</p>
                                    <!-- <a href="{{ route('product_detail', 'tendiometer') }}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="1969" data-product_sku="POSTER-FLYING-NINJA" aria-label="Add &ldquo;Coffee grinder part&rdquo; to your cart" rel="nofollow">Add to cart</a> -->
                                 </div>
                              </div>
                           </div>
                           @endforeach
                          


                           @else
                           <!-- <div class="col-12 text-center">
                              <img src="{{ asset('assets/frontend/images/not_found.jpg') }}" alt="no-product" class="img-fluid">
                           </div> -->
                           @endif
                        </div>
                     </div>