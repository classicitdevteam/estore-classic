@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            {{-- <div class="archive-header" style="background-image: url({{ asset($category->image) }});"> --}}
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">
                        	@if(session()->get('language') == 'bangla') 
                                {{ $category->name_bn }}
                            @else 
                                {{ $category->name_en }} 
                            @endif
                        </h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                            @if(session()->get('language') == 'bangla') 
                                {{ $category->name_bn }}
                            @else 
                                {{ $category->name_en }} 
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                        	@foreach(get_categories()->sub_categories as $subcategory)
                            <li class="hover-up">
                                <a href="{{ route('product.category', $sub_category->slug) }}">
                                	<i class="fi-rs-cross mr-10"></i>
                                	@if(session()->get('language') == 'bangla') 
	                                    {{ $sub_category->name_bn }}
	                                @else 
	                                    {{ $sub_category->name_en }} 
	                                @endif
                                </a>
                            </li>
	                  		@endforeach
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            @foreach($subcategories as $key => $subcategory)
            <div class="card-2 mr-20 bg-9 d-flex flex-column justify-content-center align-items-center wow animate__ animate__fadeInUp slick-slide slick-current slick-active" data-wow-delay=".1s" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 137px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <figure class="img-hover-scale overflow-hidden">
		             <a href="{{ route('product.category', $subcategory->slug) }}">
                    	@if($subcategory->image && $subcategory->image != '' && $subcategory->image != 'Null')
		                    <img class="default-img" src="{{ asset($subcategory->image) }}" alt="" />
		                @else
		                    <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
		                @endif
                    </a>
                </figure>
                <h6>
                	<a href="{{ route('product.category', $subcategory->slug) }}" tabindex="0">{{ $subcategory->name_en }}</a>
                </h6>
              <!--   <span>26 items</span> -->
            </div>
            @endforeach
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover d-flex">
                            <div class="row">
                                <div class="form-group col-lg-6 col-12 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" onchange="filter()" name="brand">
                                            <option value="">All Brands</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->slug }}" @if ($brand_id == $brand->id) selected @endif >{{ $brand->name_en ?? 'Null' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group col-lg-6 col-12 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="sort_by" onchange="filter()">
                                            <option value="newest" @if ($sort_by =='newest') selected @endif>Newest</option>
                                            <option value="oldest" @if ($sort_by =='oldest') selected @endif >Oldest</option>
                                            <option value="price-asc" @if ($sort_by == 'price-asc') selected @endif >Price Low to High</option>
                                            <option value="price-desc" @if ($sort_by == 'price-desc') selected @endif >Price High to Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                	@forelse($products as $product)
                    <div class="col-md-3 col-12 col-sm-6">
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
                                    <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <!-- start product discount section -->
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
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ route('product.category', $category->slug) }}">
                                    	@if(session()->get('language') == 'bangla') 
			                                {{ $category->name_bn }}
			                            @else 
			                                {{ $category->name_en }} 
			                            @endif
                                    </a>
                                </div>
                                <h2>
                                	<a href="{{ route('product.details',$product->slug) }}">
                                		@if(session()->get('language') == 'bangla') 
                                            {{
                                            	$product->name_bn 
                                            }}
                                        @else 
                                            {{
                                            	$product->name_en 
                                            }} 
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
                                            <input type="hidden" id="product_pname" value="{{ $product->name_en }}">
                                            <a class="add" onclick="addToCartDirect()" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
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
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <!-- Fillter By Price -->
                @include('frontend.common.filterby')
            	<!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
        </div>
    </div>
</main>
@endsection