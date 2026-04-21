@extends('website.layouts.master')

@section('title', 'Shop - Hubli')

@section('meta')
    <meta name="description" content="Contact North Bengal for inquiries, product details, or business queries. Get in touch via phone, email, or visit our office.">
    <meta name="keywords" content="contact north bengal, contact us, north bengal inquiries, phone, email, office location">
    <meta property="og:title" content="Contact Us - North Bengal">
    <meta property="og:description" content="Reach North Bengal for product inquiries or business partnerships.">
    <meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/contact_banner.png') }}">
    <meta property="og:type" content="website">
@endsection
@section('content')

    <!-- BREADCRUMB AREA START -->
    <x-breadcrumb title="Shop" pageName="Shop" bgImage="frontend/img/bg/9.jpg" />
    <!-- BREADCRUMB AREA END -->
    
    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-lg-9 order-lg-2 mb-120">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="d-none d-mg-block d-lg-block">
                                <div class="header-search-2">
                                    <form method="GET" action="{{ route('shop') }}">
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search here..."/>

                                        <button type="submit">
                                            <span><i class="icon-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            <li>
                               <div class="short-by text-center">
                                    <form method="GET" class="d-flex align-items-center gap-2">
                                        <select class="nice-select" name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                                            <option >Default sorting</option>
                                            <option value="1" @if(request()->get('sort')==1) selected @endif>Sort by Latest</option>
                                            <option value="2" @if(request()->get('sort')==2) selected @endif>Sort by Oldest</option>
                                            <option value="3" @if(request()->get('sort')==3) selected @endif>Sort by Price: High → Low</option>
                                            <option value="4" @if(request()->get('sort')==4) selected @endif>Sort by Price: Low → High</option>
                                            <!-- <option value="1">Sort by price: high to low</option> -->
                                        </select>
                                    </form>
                                </div> 
                            </li>
                            <li>
                               <div class="showing-product-number text-right text-end">
                                    <span>Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results</span>
                                </div> 
                            </li>                
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">


                                    @forelse ($products as $product)
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-3 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="{{ route('productDetails', $product->slug) }}">
                                                    <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $product->fi()]) }}" alt="{{ $product->name_en }}">
                                                </a>
                                                <!-- <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div> -->
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View"  class="quick-view-btn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" class="add-to-wishlist" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h2>
                                                <small class="d-block text-uppercase mb-1">
                                                    @foreach ($product->categories as $key => $cat)
                                                        <span class="font-weight-bold" style="color: #0e1573ff">
                                                            {{ $cat->name_en }}
                                                        </span>@if(!$loop->last), @endif
                                                    @endforeach
                                                </small>
                                                <div class="product-price">
                                                    <span>{{ number_format($product->final_price, 2) }} ৳</span> 
                                                    @if($product->discount > 0.00)
                                                        <small style="font-size: 8px !important;"><del>{{ number_format($product->price, 2) }} ৳</del></small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty 
                                    <p>There have no product here</p>
                                    @endforelse 
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">

                                    @forelse ($products as $product)
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="{{ route('productDetails', $product->slug) }}">
                                                    <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $product->fi()]) }}" alt="{{ $product->name_en }}">
                                                </a>
                                                <!-- <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h2>
                                                    @foreach ($product->categories as $key => $cat)
                                                        <span class="font-weight-bold" style="color: #0e1573ff">
                                                            {{ $cat->name_en }}
                                                        </span>@if(!$loop->last), @endif
                                                    @endforeach
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>{{ number_format($product->final_price, 2) }} ৳</span> 
                                                    @if($product->discount > 0.00)
                                                        <small style="font-size: 8px !important;"><del>{{ number_format($product->price, 2) }} ৳</del></small>
                                                    @endif
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" class="quick-view-btn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" class="add-to-wishlist" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty 
                                    <p>There have no product here</p>
                                    @endforelse 
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            <ul>
                                {{ $products->links('pagination.ltn') }}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  mb-120">
                    <aside class="sidebar ltn__shop-sidebar">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul>
                                <li><a href="{{ route('shop') }}">All ({{ $total_products }}) <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                @foreach ($subcategories as $subcategory)
                                    <li>
                                        <a href="{{ route('productCategory', $subcategory->slug) }}">{{ $subcategory->name_en }} ({{ $subcategory->products()->count() }}) 
                                            <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Price Filter Widget -->
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="widget ltn__price-filter-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                                <div class="price_filter">
                                    <div class="price_slider_amount">
                                        <input type="submit"  value="Your range:"/> 
                                        <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                                    </div>
                                    <div class="slider-range"></div>
                                </div>
                            </div>
                        </form>
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                            @include('website.layouts.top_products', [ 'topClickedProducts' => $topClickedProducts ])
                        </div>
                        <!-- Tagcloud Widget -->
                        {{--<div class="widget ltn__tagcloud-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                            <ul>
                                <li><a href="#">Popular</a></li>
                                <li><a href="#">desgin</a></li>
                                <li><a href="#">ux</a></li>
                                <li><a href="#">usability</a></li>
                                <li><a href="#">develop</a></li>
                                <li><a href="#">icon</a></li>
                                <li><a href="#">Car</a></li>
                                <li><a href="#">Service</a></li>
                                <li><a href="#">Repairs</a></li>
                                <li><a href="#">Auto Parts</a></li>
                                <li><a href="#">Oil</a></li>
                                <li><a href="#">Dealer</a></li>
                                <li><a href="#">Oil Change</a></li>
                                <li><a href="#">Body Color</a></li>
                            </ul>
                        </div>--}}
                        <!-- Size Widget -->
                        {{--<div class="widget ltn__tagcloud-widget ltn__size-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                            <ul>
                                <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">XXL</a></li>
                            </ul>
                        </div>--}}
                        <!-- Color Widget -->
                        {{--<div class="widget ltn__color-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                            <ul>
                                <li class="black"><a href="#"></a></li>
                                <li class="white"><a href="#"></a></li>
                                <li class="red"><a href="#"></a></li>
                                <li class="silver"><a href="#"></a></li>
                                <li class="gray"><a href="#"></a></li>
                                <li class="maroon"><a href="#"></a></li>
                                <li class="yellow"><a href="#"></a></li>
                                <li class="olive"><a href="#"></a></li>
                                <li class="lime"><a href="#"></a></li>
                                <li class="green"><a href="#"></a></li>
                                <li class="aqua"><a href="#"></a></li>
                                <li class="teal"><a href="#"></a></li>
                                <li class="blue"><a href="#"></a></li>
                                <li class="navy"><a href="#"></a></li>
                                <li class="fuchsia"><a href="#"></a></li>
                                <li class="purple"><a href="#"></a></li>
                                <li class="pink"><a href="#"></a></li>
                                <li class="nude"><a href="#"></a></li>
                                <li class="orange"><a href="#"></a></li>

                                <li><a href="#" class="orange"></a></li>
                                <li><a href="#" class="orange"></a></li>
                            </ul>
                        </div>--}}
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="shop.html"><img src="{{ asset('frontend/img/banner/banner-1.jpg')}}" alt="#"></a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->
@endsection 
@push('js')
<script>
$(document).on('click', '.add-to-wishlist', function() {
    var id = $(this).data('id');

    $.ajax({
        url: "{{ route('wishlist.add') }}",
        type: "POST",
        data: {
            product_id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            $("#liton_wishlist_modal .added-cart").text(res.message);
            $("#liton_wishlist_modal").modal('show');
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        var priceRange = '{{ request()->get("price") }}';
        var minPrice = 0;
        var maxPrice = 5000;

        if (priceRange) {
            var priceParts = priceRange.split('-');
            if (priceParts.length === 2) {
                minPrice = parseInt(priceParts[0]);
                maxPrice = parseInt(priceParts[1]);
            }
        }

        $('.slider-range').slider({
            range: true,
            min: 0,
            max: 5000,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $('.amount').val('৳' + ui.values[0] + ' - ৳' + ui.values[1]);
            },
            stop: function(event, ui) {
                $('input[name="price"]').val(ui.values[0] + '-' + ui.values[1]);
                $(this).closest('form').submit();
            }
        });
        $('.amount').val('৳' + $('.slider-range').slider('values', 0) + ' - ৳' + $('.slider-range').slider('values', 1));
    });
</script>
@endpush