@extends('frontend.layouts.master')

@section('title', 'Home - Hubli')

@section('meta')
<meta name="description"
    content="North Bengal offers premium dairy products, latest news, and world-class services. Explore our departments and services with ease.">
<meta name="keywords" content="North Bengal, dairy products, latest news, services, departments, quality dairy">
<meta property="og:title" content="Home - North Bengal">
<meta property="og:description"
    content="Discover North Bengal’s quality dairy products, latest news, and world-class services.">
<meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/home-banner.png') }}">
<meta property="og:type" content="website">
<meta name="robots" content="index, follow">
@endsection

@push('css')
<style>

    /* Fix Slider Container */
    .ltn__slider-area {
        position: relative;
        overflow: hidden;
        width: 100%;
    }
    
    /* Background image with lighter overlay for better text visibility */
    /* Responsive slider background image with overlay */
/* Main slider responsive background */
.ltn__slider-area.ltn__slider-3 {
    background-image:
        linear-gradient(rgba(31, 49, 51, 0.6), rgba(31, 49, 51, 0.6)),
        url('{{ asset('frontend/img/resource/support-bg-prime.webp') }}');
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
    background-attachment: scroll !important;
    width: 100%;
    min-height: 600px;
}

/* Large Desktop (1920px+) */
@media (min-width: 1920px) {
    .ltn__slider-area.ltn__slider-3 {
        min-height: 700px;
        background-position: center center !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 700px;
    }
}

/* Standard Desktop (1200px - 1919px) - YOUR FIX IS HERE */
@media (min-width: 1200px) and (max-width: 1919px) {
    .ltn__slider-area.ltn__slider-3 {
        min-height: 550px !important;
        background-size: cover !important;
        background-position: center center !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 550px !important;
        padding: 80px 0 !important;
    }
    
    .slide-title {
        font-size: 3rem !important;
    }
    
    .slide-item-img img {
        max-width: 90%;
    }
}

/* Tablet and Small Desktop (992px - 1199px) */
@media (min-width: 992px) and (max-width: 1199px) {
    .ltn__slider-area.ltn__slider-3 {
        min-height: 500px !important;
        background-position: center center !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 500px !important;
        padding: 60px 0 !important;
    }
    
    .slide-title {
        font-size: 2.5rem !important;
    }
    
    .slide-item-img img {
        max-width: 85%;
    }
}

/* Tablet (768px - 991px) */
@media (min-width: 768px) and (max-width: 991px) {
    .ltn__slider-area.ltn__slider-3 {
        min-height: 450px !important;
        background-position: center top !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 450px;
        padding: 50px 0;
    }
    
    .slide-title {
        font-size: 2.2rem;
    }
    
    .slide-item-img img {
        max-width: 80%;
        margin-top: 30px;
    }
}

/* Mobile (up to 767px) */
@media (max-width: 767px) {
    .ltn__slider-area.ltn__slider-3 {
        background-size: cover !important;
        background-position: center top !important;
        min-height: 400px !important;
    }

    .ltn__slide-item-3 .slide-item-info {
        padding: 30px 0 !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 400px;
        padding: 40px 0;
    }
    
    .slide-title {
        font-size: 2rem !important;
        line-height: 1.3;
    }
    
    .slide-sub-title {
        font-size: 0.9rem;
    }
    
    .slide-brief {
        font-size: 1rem;
        margin-bottom: 25px;
    }
    
    .slide-item-img img {
        max-width: 70%;
        margin-top: 20px;
    }
    
    .btn-wrapper {
        display: flex;
        flex-direction: column;
        gap: 15px;
        align-items: center;
    }
    
    .btn-wrapper .btn {
        margin: 5px 0;
        width: 100%;
        max-width: 250px;
    }
}

/* Small Mobile (up to 575px) */
@media (max-width: 575px) {
    .ltn__slider-area.ltn__slider-3 {
        min-height: 350px !important;
    }
    
    .ltn__slide-item-inner {
        min-height: 350px;
        padding: 30px 0;
    }
    
    .slide-title {
        font-size: 1.8rem !important;
    }
    
    .slide-brief {
        font-size: 0.9rem;
    }
    
    .slide-item-img img {
        max-width: 60%;
    }
}

/* Ensure content stays centered and properly aligned */
.ltn__slide-item-inner {
    display: flex;
    align-items: center;
    width: 100%;
}

.row.align-items-center {
    width: 100%;
}

/* Fix for container width issues on medium screens */
@media (min-width: 1200px) and (max-width: 1399px) {
    .container {
        max-width: 1140px;
        padding-left: 15px;
        padding-right: 15px;
    }
}

/* Fix text visibility */
.ltn__slide-item .slide-item-info,
.ltn__slide-item .slide-title,
.ltn__slide-item .slide-sub-title,
.ltn__slide-item .slide-brief,
.ltn__slide-item h1,
.ltn__slide-item h2,
.ltn__slide-item h3,
.ltn__slide-item h4,
.ltn__slide-item h5,
.ltn__slide-item h6,
.ltn__slide-item p {
    color: white !important;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

.slide-title {
    color: white !important;
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}
</style>

<style>
    /* Remove default slick navigation completely */
    .slick-prev:before, 
    .slick-next:before {
        content: '' !important;
        display: none !important;
    }
    
    /* Hide any default text content */
    .slick-prev, 
    .slick-next {
        font-size: 0 !important;
        text-indent: -9999px !important;
    }
    
    /* Create custom navigation with only icons */
    .slick-prev, 
    .slick-next {
        width: 50px !important;
        height: 50px !important;
        background: rgba(255, 255, 255, 0.8) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 10 !important;
        transition: all 0.3s ease !important;
        border: none !important;
        cursor: pointer !important;
    }
    
    .slick-prev:hover, 
    .slick-next:hover {
        background: rgba(255, 255, 255, 1) !important;
        transform: scale(1.1) !important;
    }
    
    .slick-prev {
        left: 20px !important;
    }
    
    .slick-next {
        right: 20px !important;
    }
    
    /* Custom arrow icons using Font Awesome with proper positioning */
    .slick-prev::after, 
    .slick-next::after {
        content: '' !important;
        font-family: 'Font Awesome 5 Free' !important;
        font-weight: 900 !important;
        font-size: 20px !important;
        color: #333 !important;
        display: block !important;
        line-height: 1 !important;
    }
    
    .slick-prev::after {
        content: '\f104' !important;
        margin-left: -2px !important;
    }
    
    .slick-next::after {
        content: '\f105' !important;
        margin-right: -2px !important;
    }
    
    /* Ensure slick slider container has proper positioning */
    .slick-slider {
        position: relative !important;
    }
    
    /* Fix for any default slick styles that might be interfering */
    .slick-arrow {
        border: none !important;
        background: transparent !important;
    }
    
    /* Mobile responsive arrows */
    @media (max-width: 767px) {
        .slick-prev, 
        .slick-next {
            width: 40px !important;
            height: 40px !important;
        }
        
        .slick-prev {
            left: 10px !important;
        }
        
        .slick-next {
            right: 10px !important;
        }
        
        .slick-prev::after, 
        .slick-next::after {
            font-size: 16px !important;
        }
    }
    
</style>
@endpush

@section('content')

<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
        <!-- ltn__slide-item 1 -->
        @forelse($sliders as $slider)
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 hero-bg" >
            <div class="ltn__slide-item-inner">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation text-white">
                                    <div class="slide-video mb-50 d-none">
                                        <a class="ltn__video-icon-2 ltn__video-icon-2-border" href="#" data-rel="lightcase:myCollection">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                    <h6 class="slide-sub-title animated text-white">
                                        {{-- <img src="{{ asset('frontend/img/icons/icon-img/1.png') }}" alt="#"> --}}
                                        {{$slider->description}}
                                    </h6>
                                    <h1 class="slide-title animated text-white">{{$slider->title}}</h1>
                                    <div class="slide-brief animated d-none text-white">
                                        <p>The Dawn Of new era</p>
                                    </div>
                                    @if( $slider->link != null)
                                    <div class="btn-wrapper animated">
                                        <a href="{{ $slider->link }}" class="theme-btn-1 btn btn-effect-1 text-uppercase">Explore Products</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 align-self-center">
                            <div class="slide-item-img">
                                <img src="{{ route('imagecache', ['template'=>'original','filename' => $slider->fi()]) }}" alt="Fresh Products" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty 
        <p>Here have no slider</p>
        @endforelse
    </div>
</div>
<!-- SLIDER AREA END -->



<!-- About Us - Agriculture Product Transport -->
<section class="about-style-two" style="padding: 80px 0; background: #fff;">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Left Content -->
      <div class="col-lg-6 col-md-6 col-sm-12 order-2 order-lg-1">
        <div class="content-box pe-lg-4">
          <p class="section-subtitle" style="color: #D10D2B; font-weight: 600; letter-spacing: 1px; margin-bottom: 15px; text-transform: uppercase; font-size: 14px;">
            Who We Are
          </p>
          <h2 class="section-title" style="font-size: 32px; font-weight: 700; color: #1D3564; line-height: 1.3; margin-bottom: 25px;">
           {{ $ws->about_title }}
          </h2>
          <p class="section-description" style="color: #555; font-size: 16px; line-height: 1.7; margin-bottom: 35px;"> {{ $ws->about_subtitle }}</p>
          <a href="#" class="btn-primary" style="display: inline-block; background: #66A931; color: #fff; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: none;">
            Learn More
            <i class="flaticon-send" style="margin-left: 8px;"></i>
          </a>
        </div>
      </div>

      <!-- Right Image Section -->
      <div class="col-lg-6 col-md-6 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
        <div class="image-box position-relative" style="max-width: 540px; margin: 0 auto;">
          <figure class="image-1 mb-0" style="margin: 0;">
            <img src="{{ asset('frontend/img/resource/about-2.jpg') }}" alt="Agriculture Transport" 
                 class="img-fluid w-100" 
                 style="border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
          </figure>
          <figure class="image-2 position-absolute d-none d-md-block" 
                  style="top: -20px; left: -20px; width: 160px; z-index: 2;">
            <img src="{{ asset('frontend/img/resource/about-3.jpg') }}" alt="Farm Products" 
                 class="img-fluid w-100" 
                 style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
          </figure>
          <figure class="image-3 position-absolute d-none d-md-block" 
                  style="bottom: -20px; right: -20px; width: 160px; z-index: 2;">
            <img src="{{ asset('frontend/img/resource/about-4.jpg') }}" alt="Delivery Service" 
                 class="img-fluid w-100" 
                 style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
          </figure>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Us - Agriculture Product Transport End -->



<!-- linear-gradient(135deg, #171F67, #D10D2B) -->
<!-- HOW IT WORKS SECTION START -->
<section class="how-it-works-section" style="padding: 80px 0; background: #f8f9fb;">
    <div class="container">
        <div class="sec-title text-center" style="margin-bottom: 60px;">
            <h2 style="font-size: 32px; font-weight: 700; color: #1D3564;">How It Works</h2>
        </div>

        <div class="row justify-content-center">
            @forelse($departments as $key => $department)
                <!-- Step 1 -->
                <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-5">
                    <div class="work-card" style="background: #fff; border-radius: 16px; padding: 30px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: 0.3s;">
                        <div class="position-relative mb-4">
                            <div class="circle-image" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto; border: 4px solid #171F67;">
                                <img src="{{ route('imagecache', [ 'template'=>'cpmd','filename' => $department->fi() ]) }}" alt="Request a Quote" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="small-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #66A931; color: #fff; font-weight: 600; display: flex; align-items: center; justify-content: center; position: absolute; left: 50%; bottom: -20px; transform: translateX(-50%); font-size: 15px;">
                                {{ str_pad(++$key, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 600; margin-top: 25px; color: #1D3564;">{{ $department->name_en }}</h4>
                        <p style="color: #555;">{{ $department->excerpt_en }}</p>
                    </div>
                </div>
            @empty 
                <p>Here have no work step</p>
            @endforelse 

            <!-- Step 2 -->
            {{--<div class="col-lg-3 col-md-6 col-sm-12 text-center mb-5">
                <div class="work-card" style="background: #fff; border-radius: 16px; padding: 30px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: 0.3s;">
                    <div class="position-relative mb-4">
                        <div class="circle-image" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto; border: 4px solid #171F67;">
                            <img src="{{ asset('frontend/img/how-it-works/how-it-work-img-2-prime.jpg') }}" alt="Plan & Schedule" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="small-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #66A931; color: #fff; font-weight: 600; display: flex; align-items: center; justify-content: center; position: absolute; left: 50%; bottom: -20px; transform: translateX(-50%); font-size: 15px;">
                            02
                        </div>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 600; margin-top: 25px; color: #1D3564;">Plan & Schedule</h4>
                    <p style="color: #555;">Submit your shipment details online or contact our team.</p>
                </div>
            </div>--}}

            <!-- Step 3 -->
            {{--<div class="col-lg-3 col-md-6 col-sm-12 text-center mb-5">
                <div class="work-card" style="background: #fff; border-radius: 16px; padding: 30px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: 0.3s;">
                    <div class="position-relative mb-4">
                        <div class="circle-image" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto; border: 4px solid #171F67;">
                            <img src="{{ asset('frontend/img/how-it-works/how-it-work-img-4-prime.jpg') }}" alt="Pickup & Transport" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="small-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #66A931; color: #fff; font-weight: 600; display: flex; align-items: center; justify-content: center; position: absolute; left: 50%; bottom: -20px; transform: translateX(-50%); font-size: 15px;">
                            03
                        </div>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 600; margin-top: 25px; color: #1D3564;">Pickup & Transport</h4>
                    <p style="color: #555;">Submit your shipment details online or contact our team.</p>
                </div>
            </div>--}}

            <!-- Step 4 -->
            {{--<div class="col-lg-3 col-md-6 col-sm-12 text-center mb-5">
                <div class="work-card" style="background: #fff; border-radius: 16px; padding: 30px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: 0.3s;">
                    <div class="position-relative mb-4">
                        <div class="circle-image" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto; border: 4px solid #171F67;">
                            <img src="{{ asset('frontend/img/how-it-works/how-work-image-3.jpg') }}" alt="Delivery & Confirmation" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="small-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #66A931; color: #fff; font-weight: 600; display: flex; align-items: center; justify-content: center; position: absolute; left: 50%; bottom: -20px; transform: translateX(-50%); font-size: 15px;">
                            04
                        </div>
                    </div>
                    <h4 style="font-size: 20px; font-weight: 600; margin-top: 25px; color: #1D3564;">Delivery & Confirmation</h4>
                    <p style="color: #555;">Submit your shipment details online or contact our team.</p>
                </div>
            </div>--}}
        </div>
    </div>
</section>
<!-- HOW IT WORKS SECTION END -->





<!-- BANNER AREA START -->
<div class="ltn__banner-area mt-120 mt--90 d-none">
    <div class="container">
        <div class="row ltn__custom-gutter--- justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="#"><img src="{{ asset('frontend/img/banner/1.jpg') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="#"><img src="{{ asset('frontend/img/banner/2.jpg') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="#"><img src="{{ asset('frontend/img/banner/1.jpg') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BANNER AREA END -->

<!-- BANNER AREA START -->
<div class="ltn__banner-area mt-120">
    <div class="container">
        <div class="row ltn__custom-gutter--- justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="#"><img src="{{ asset('frontend/img/banner/13.png') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="#"><img src="{{ asset('frontend/img/banner/14.png') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="#"><img src="{{ asset('frontend/img/banner/15.png') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BANNER AREA END -->

<!-- PRODUCT TAB AREA START (product-item-3) -->
<div class="ltn__product-tab-area ltn__product-gutter pt-85 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Our Products</h1>
                </div>
                
                <!-- Dynamic Category Tabs -->
                <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                    <div class="nav">
                        @foreach($categories as $index => $category)
                            <a class="{{ $index === 0 ? 'active show' : '' }}" 
                               data-bs-toggle="tab" 
                               href="#category_tab_{{ $category->id }}"
                               data-category-id="{{ $category->id }}">
                                {{ $category->name_en }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Dynamic Tab Content -->
                <div class="tab-content">
                    @foreach($categories as $index => $category)
                        <div class="tab-pane fade {{ $index === 0 ? 'active show' : '' }}" 
                             id="category_tab_{{ $category->id }}">
                            <div class="ltn__product-tab-content-inner">
                                <div class="row ltn__tab-product-slider-one-active slick-arrow-1" 
                                     id="products-container-{{ $category->id }}">
                                    <!-- Products will be loaded here via AJAX or directly -->
                                    @include('frontend.partials.products-grid', ['products' => $category->products])
                                </div>
                                
                                <!-- Loading Spinner -->
                                <div id="loading-{{ $category->id }}" class="text-center" style="display: none;">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT TAB AREA END -->

<!-- COUNTDOWN AREA START -->
<div class="ltn__call-to-action-area ltn__call-to-action-4 section-bg-1 pt-110 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <img src="{{ asset('frontend/img/banner/11.png') }}" alt="#">
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="call-to-action-inner call-to-action-inner-4 text-color-white--- text-center---">
                    <div class="section-title-area ltn__section-title-2 text-center---">
                        <h6 class="ltn__secondary-color">Todays Hot Deals</h6>
                        <h1 class="section-title">Farm to Market  <br> Transport</h1>
                    </div>
                    <div class="ltn__countdown ltn__countdown-3 bg-white--" data-countdown="2024/12/28"></div>
                    <div class="btn-wrapper animated">
                        <a href="#" class="theme-btn-1 btn btn-effect-1 text-uppercase">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- COUNTDOWN AREA END -->

<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Featured Products</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">

            <!-- ltn__product-item -->
            @forelse($feature_products as $feature)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="{{ route('productDetails', $feature->slug) }}">
                            <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $feature->fi()]) }}" alt="{{ $feature->name_en }}">
                        </a>
                        <!-- <div class="product-badge">
                            <ul>
                                <li class="sale-badge">New</li>
                            </ul>
                        </div> -->
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" class="quick-view-btn" data-id="{{ $feature->id }}"  >
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                        data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal"
                                        data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i></a>
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
                        <h2 class="product-title"><a href="{{ route('productDetails', $feature->slug) }}">{{ $feature->name_en }}</a></h2>
                        <small class="d-block text-uppercase mb-1">
                            @foreach ($feature->categories as $key => $cat)
                                <span class="font-weight-bold" style="color: #0e1573ff">
                                    {{ $cat->name_en }}
                                </span>@if(!$loop->last), @endif
                            @endforeach
                        </small>
                        <div class="product-price">
                            <span>{{ number_format($feature->final_price, 2) }} ৳</span> 
                            @if($feature->discount > 0.00)
                                <del>{{ number_format($feature->discount_price, 2) }} ৳</del>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            <p>There have no feature product</p>
            @endforelse
            <!--  -->
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->

<!-- VIDEO AREA START -->
<div class="ltn__video-popup-area ltn__video-popup-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__video-bg-img ltn__video-popup-height-600 bg-overlay-black-10-- bg-image"
                    data-bg="{{ asset('frontend/img/bg/15.jpg') }}">
                    <a class="ltn__video-icon-2 ltn__video-icon-2-border"
                        href="https://www.youtube.com/embed/ATI7vfCgwXE?autoplay=1&amp;showinfo=0"
                        data-rel="lightcase:myCollection">
                        <i class="fa fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- VIDEO AREA END -->

<!-- TESTIMONIAL AREA START (testimonial-4) -->
<div class="ltn__testimonial-area section-bg-1 pt-290 pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h6 class="section-subtitle ltn__secondary-color">// Testimonials</h6>
                    <h1 class="section-title">Clients Feedbacks<span>.</span></h1>
                </div>
            </div>
        </div>
        <div class="row ltn__testimonial-slider-3-active slick-arrow-1 slick-arrow-1-inner">
            @forelse($testimonials as $testimonial)
            <div class="col-lg-12">
                <div class="ltn__testimonial-item ltn__testimonial-item-4">
                    <div class="ltn__testimoni-img">
                        <img src="{{ Storage::disk('public')->url($testimonial->image) }}"
                            alt="testimonial {{ $testimonial->id }} image">

                    </div>
                    <div class="ltn__testimoni-info">
                        <p>{{ Str::limit(strip_tags($testimonial->text_en), 180) }}</p>
                        <h4>{{ $testimonial->name }}</h4>
                        <h6>{{ $testimonial->designation }}</h6>
                    </div>
                    <div class="ltn__testimoni-bg-icon">
                        <i class="far fa-comments"></i>
                    </div>
                </div>
            </div>
            @empty 
            <p>Here no testimonial </p>
            @endforelse

            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->

<!-- BLOG AREA START (blog-3) -->
<div class="ltn__blog-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">Latest Blog</h1>
                </div>
            </div>
        </div>
        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            <!-- Blog Item -->
             @foreach($newses as $news)
            <div class="col-lg-12">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ route('singleNews', ['id' => $news->id]) }}"><img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $news->fi()]) }}" alt="{{ $news->title }}"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                            <ul>
                                {{--<li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                </li>--}}
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>{{ $news->category->name }}</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="ltn__blog-title"><a href="{{ route('singleNews', ['id' => $news->id]) }}">{{ $news->title }}</a></h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ $news->created_at->format('M d, Y') }}</li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="{{ route('singleNews', ['id' => $news->id]) }}">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
            <!--  -->
        </div>
    </div>
</div>
<!-- BLOG AREA END -->


@endsection



@push('js')
<script>
    $(document).ready(function(){
        console.log('Initializing slider...');
        
        // Destroy any existing slick instances first
        if ($('.ltn__slide-one-active').hasClass('slick-initialized')) {
            $('.ltn__slide-one-active').slick('unslick');
        }
        
        // Initialize the slider with proper settings
        $('.ltn__slide-one-active').slick({
            autoplay: true,
            autoplaySpeed: 3000, // 3 seconds
            dots: true,
            arrows: true,
            infinite: true,
            speed: 600,
            fade: false,
            cssEase: 'ease-out',
            pauseOnHover: true,
            pauseOnFocus: false,
            adaptiveHeight: false,
            waitForAnimate: true,
            lazyLoad: 'ondemand',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                }
            ]
        });
        
        console.log('Slider initialized successfully');
        
        // Debug: Check if autoplay is working
        $('.ltn__slide-one-active').on('afterChange', function(event, slick, currentSlide){
            console.log('Slide changed to: ' + currentSlide);
        });
    });
</script>
<script>
    // Lazy load products when tab is clicked
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('[data-category-id]');
    
    tabLinks.forEach(tab => {
        tab.addEventListener('click', function(e) {
            const categoryId = this.getAttribute('data-category-id');
            const container = document.getElementById(`products-container-${categoryId}`);
            const loading = document.getElementById(`loading-${categoryId}`);
            
            // If container is empty, load products
            if (container && container.children.length === 0) {
                loadProducts(categoryId, container, loading);
            }
        });
    });
    
    // Load first tab products immediately
    const firstTab = document.querySelector('[data-category-id].active');
    if (firstTab) {
        const categoryId = firstTab.getAttribute('data-category-id');
        const container = document.getElementById(`products-container-${categoryId}`);
        const loading = document.getElementById(`loading-${categoryId}`);
        
        if (container && container.children.length === 0) {
            loadProducts(categoryId, container, loading);
        }
    }
});

function loadProducts(categoryId, container, loading) {
    loading.style.display = 'block';
    
    fetch(`/api/products/category/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = data.html;
            loading.style.display = 'none';
            
            // Re-initialize sliders if needed
            if (typeof $.fn.slick !== 'undefined') {
                $('.ltn__tab-product-slider-one-active').slick('refresh');
            }
        })
        .catch(error => {
            console.error('Error loading products:', error);
            loading.style.display = 'none';
            container.innerHTML = '<div class="col-12 text-center"><p>Error loading products.</p></div>';
        });
}
</script>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all Owl Carousel instances on the page
    const carousels = document.querySelectorAll('.owl-carousel');

    carousels.forEach(function(carousel) {
        // Wait until Owl Carousel initializes
        const waitForInit = setInterval(function() {
            if (carousel.classList.contains('owl-loaded')) {
                clearInterval(waitForInit);

                // Add hover pause/resume
                carousel.addEventListener('mouseenter', function() {
                    $(carousel).trigger('stop.owl.autoplay');
                });

                carousel.addEventListener('mouseleave', function() {
                    // Resume with your desired autoplay timeout
                    $(carousel).trigger('play.owl.autoplay', [3000]); // hero slider 2s
                });
            }
        }, 100);
    });
});
</script> -->

<!-- Lazy Background Loader Script -->
<!-- <script>
    
document.addEventListener("DOMContentLoaded", function () {
    const lazyBg = document.querySelectorAll(".lazy-bg");
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bgSection = entry.target;
                const bgUrl = bgSection.getAttribute("data-bg");
                bgSection.style.backgroundImage = `url('${bgUrl}')`;
                observer.unobserve(bgSection);
            }
        });
    });
    lazyBg.forEach(section => observer.observe(section));
});
</script> -->
@endpush