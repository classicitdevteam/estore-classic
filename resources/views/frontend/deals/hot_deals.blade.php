@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
<main class="main">
	<div class="container mb-30 mt-60">
	    <div class="row">
	        <div class="col-lg-4-5">
	            <div class="shop-product-fillter">
	                <div class="totall-product">
	                    <p>We found <strong class="text-brand">{{ count($products)}}</strong> items for you!</p>
	                </div>
	                <div class="sort-by-product-area">
	                    <div class="sort-by-cover mr-10">
	                        <div class="sort-by-product-wrap">
	                            <div class="sort-by">
	                                <span><i class="fi-rs-apps"></i>Show:</span>
	                            </div>
	                            <div class="sort-by-dropdown-wrap">
	                                <span class="align-items-center d-flex"> 50 <i class="fi-rs-angle-small-down"></i></span>
	                            </div>
	                        </div>
	                        <div class="sort-by-dropdown">
	                            <ul>
	                                <li><a class="active" href="#">50</a></li>
	                                <li><a href="#">100</a></li>
	                                <li><a href="#">150</a></li>
	                                <li><a href="#">200</a></li>
	                                <li><a href="#">All</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="sort-by-cover">
	                        <div class="sort-by-product-wrap">
	                            <div class="sort-by">
	                                <span class="align-items-center d-flex"><i class="fi-rs-apps-sort"></i>Sort by:</span>
	                            </div>
	                            <div class="sort-by-dropdown-wrap">
	                                <span class="align-items-center d-flex"> Featured <i class="fi-rs-angle-small-down"></i></span>
	                            </div>
	                        </div>
	                        <div class="sort-by-dropdown">
	                            <ul>
	                                <li><a class="active" href="#">Featured</a></li>
	                                <li><a href="#">Price: Low to High</a></li>
	                                <li><a href="#">Price: High to Low</a></li>
	                                <li><a href="#">Release Date</a></li>
	                                <li><a href="#">Avg. Rating</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="row product-grid gutters-5">
	            	@forelse($products as $product)
	                <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
	                     <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                        <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1 d-flex">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="#"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="#"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @php
                                        if($product->discount_type == 1){
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        }elseif($product->discount_type == 2){
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                        }
                                    @endphp

                                    @if($product->discount_price > 0)
                                    <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                            @if($product->discount_type == 1)
                                                <span class="hot">৳{{ $product->discount_price }} off</span>
                                            @elseif($product->discount_type == 2)
                                                <span class="hot">{{ $product->discount_price }}% off</span>
                                            @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">
                                    	@if(session()->get('language') == 'bangla') 
			                                {{ $product->category->name_bn }}
			                            @else 
			                                {{ $product->category->name_en }} 
			                            @endif
                                    </a>
                                </div>
                                <h2>
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        @if(session()->get('language') == 'bangla')
                                            <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                            {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                        @endif
                                    </a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (0)</span>
                                </div>
                                <div class="product-card-bottom">
                                    @if ($product->discount_price > 0)
                                        <div class="product-price">
                                            <span class="price"> ৳{{ $price_after_discount }} </span>
                                            <span class="old-price">৳ {{ $product->regular_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span class="price"> ৳{{ $product->regular_price }} </span>
                                        </div>
                                    @endif
                                    <div class="add-cart">
                                        @if($product->is_varient == 1)
                                            <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                            <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
	                </div>
	                @empty
                        @if(session()->get('language') == 'bangla') 
	                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
	                    @else 
	                       	<h5 class="text-danger">No products were found here!</h5> 
	                    @endif
	                @endforelse
	                <!--end product card-->
	            </div>
	            <!--product grid-->
	            <div class="pagination-area mt-20 mb-20">
	                <nav aria-label="Page navigation example">
	                    <ul class="pagination justify-content-end">
	                        {{ $products->links() }}
	                    </ul>
	                </nav>
	            </div>
	            <section class="section-padding pb-5">
                    <div class="section-title">
                        <h3 class="">Deals Of The Day</h3>
                        <a class="show-all" href="#">
                            All Deals
                            <i class="fi-rs-angle-right"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="{{asset('upload/nest-img/product-5-1.jpg')}}" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="#">Seeds of Change Organic Quinoa, Brown</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="#">NestFood</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$32.85</span>
                                                <span class="old-price">$33.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="#"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="$">
                                            <img src="{{asset('upload/nest-img/product-4-1.jpg')}}" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="#">Perdue Simply Smart Organics Gluten</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="#">Old El Paso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$24.85</span>
                                                <span class="old-price">$26.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="#"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-none d-lg-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{asset('upload/nest-img/product-3-1.jpg')}}" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="#">Signature Wood-Fired Mushroom</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="#">Progresso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$12.85</span>
                                                <span class="old-price">$13.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-none d-xl-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="{{asset('upload/nest-img/product-2-1.jpg')}}" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="#">Simply Lemonade with Raspberry Juice</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="#">Yoplait</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$15.85</span>
                                                <span class="old-price">$16.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="#"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Deals-->
	        </div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <form action="{{ URL::current() }}" method="GET">
                <div class="card">
                    <div class="sidebar-widget price_range range border-0">
                        <h5 class="mb-20">By Price</h5>
                        <div class="price-filter mb-20">
                            <div class="price-filter-inner">
                                <div id="slider-range" class="mb-20"></div>
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-20">Category</h5>
                        <div class="custome-checkbox">
                            @foreach(get_categories() as $category)
                                <div class="mb-2">
                                    @php
                                        $checked = [];
                                        if(isset($_GET['filtercategory'])){
                                            $checked = $_GET['filtercategory'];
                                        }
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="filtercategory[]" id="category_{{$category->id}}" value="{{$category->name_en}}" 
                                        @if(in_array($category->name_en, $checked)) checked @endif
                                    />
                                    <label class="form-check-label" for="category_{{$category->id}}">
                                        <span>
                                            @if(session()->get('language') == 'bangla') 
                                                {{ $category->name_bn }}
                                            @else 
                                                {{ $category->name_en }} 
                                            @endif 
                                        </span>
                                    </label>
                                    <span class="float-end">{{ count($category->products) }}</span>
                                    <br>
                                </div>
                            @endforeach
                        </div>
                        <button type="submin" class="btn btn-sm btn-default mt-20 mb-10" ><i class="fi-rs-filter mr-5"></i> Fillter</button>
                    </div>
                </div>
                </form>
                <!-- {{-- <form class="" id="search-form">
                    <input type="hidden" id="filter_price_start" name="filter_price_start">
                    <input type="hidden" id="filter_price_end" name="filter_price_end">
                </form> --}} -->
	        </div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection