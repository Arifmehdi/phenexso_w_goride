
@extends('frontend.layouts.master')

@section('content')
<div role="main" class="main">

    <!-- <a class="envato-buy-redirect" href="login.html">
        <i class="fas fa-shopping-cart w3-large" style="color: #18443F"></i>
            <span class="extra-cart-info" style="background: #18443F">
                <span class="cartItemsCount" id="">2</span>
            </span>
        </a> -->

    <!-- Bottom Nav Bar start-->
    <div class="mobile-bottom-bar">
        <a href="#" class="checkout-btn">
            <span class="checkout-text">Checkout</span>
            <span class="checkout-price">৳120</span>
            <i class="fas fa-shopping-cart"></i>
        </a>
        <div class="other-icons">
            <a href="#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-th-large"></i></a>
            <a href="#"><i class="fas fa-search"></i></a>
        </div>
    </div>
    <!-- Bottom Nav Bar end-->



    <div class="owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark mb-2"
        data-plugin-options="{'items': 1, 'margin': 10, 'loop': true, 'nav': true, 'dots': true,'autoplay': true}">
        <div>
            <div class="img-thumbnail border-0 p-0 d-block">
                <a target="_blank" href="#">
                    <img class="img-fluid border-radius-0" src="uslive/original/slider_bg_1.webp" alt="">
                </a>
            </div>
        </div>
        <div>
            <div class="img-thumbnail border-0 p-0 d-block">
                <a target="_blank" href="#">
                    <img class="img-fluid border-radius-0" src="uslive/original/slider_bg_2.webp" alt="">
                </a>
            </div>
        </div>
        <div>
            <div class="img-thumbnail border-0 p-0 d-block">
                <a target="_blank" href="#">
                    <img class="img-fluid border-radius-0" src="uslive/original/slider_bg_1.webp" alt="">
                </a>
            </div>
        </div>
    </div>




    <!-- <section class="section-custom-medical">
<div class="container">
    <div class="row medical-schedules">
        
        <div class="col-xl-3 box-two bg-color-primary appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="600">
            <h5 class="m-0">
                <a href="doctor/list.html" title="">
                     Medical Treatment
                    <i class="icon-arrow-right-circle icons"></i>
                </a>
            </h5>
        </div>

        <div class="col-xl-3 box-two bg-color-tertiary appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="600">
            <h5 class="m-0">
                <a href="doctor/list.html" title="">
                    Doctors Timetable
                    <i class="icon-arrow-right-circle icons"></i>
                </a>
            </h5>
        </div>
        <div class="col-xl-3 box-three bg-color-primary appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="1200">
            <div class="expanded-info p-4 bg-color-primary">
                <div class="info custom-info">
                    <span>Sunday-Thursday</span>
                    <span>18:00 to 22:00 </span>
                </div>
                <div class="info custom-info">
                    <span>Friday</span>
                    <span>9:00 to 16:00</span>
                </div>
                <div class="info custom-info">
                    <span>Saturday</span>
                    <span>9:00 to 16:00</span>
                </div>
            </div>
            <h5 class="m-0">
                Opening Hours
                <i class="icon-arrow-right-circle icons"></i>
            </h5>
        </div>
        <div class="col-xl-3 box-four bg-color-secondary p-0 appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="1800">
            <a href="tel:+008001234567" class="text-decoration-none">
                <div class="feature-box feature-box-style-2 m-0">
                    <div class="feature-box-icon">
                        <i class="icon-call-out icons"></i>
                    </div>
                    <div class="feature-box-info">
                        <label class="font-weight-light">Emergency case</label>
                        <strong class="font-weight-normal">+88017xxxxxxxx</strong>
                    </div>
                </div>
            </a>
        </div>
    </div>
   
</div>
</section> -->


    <section class="section my-0">
        <div class="container">



            <div class="row text-center">
                <div class="col-md d-flex flex-column mb-3">
                    <a href="#" class="text-decoration-none d-block flex-fill">
                        <div class="thumb-info h-100">
                            <div class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details03.jpg">
                            </div>
                            <div class="thumb-info-caption py-3">
                                <h4 class="font-weight-semibold mb-1 w3-large">Best Ingredient</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md d-flex flex-column mb-3">
                    <a href="#" class="text-decoration-none d-block flex-fill">
                        <div class="thumb-info h-100">
                            <div class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details04.jpg">
                            </div>
                            <div class="thumb-info-caption py-3">
                                <h4 class="font-weight-semibold mb-1 w3-large">Big Milk Farm</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md d-flex flex-column mb-3">
                    <a href="#" class="text-decoration-none d-block flex-fill">
                        <div class="thumb-info h-100">
                            <div class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details03.jpg">
                            </div>
                            <div class="thumb-info-caption py-3">
                                <h4 class="font-weight-semibold mb-1 w3-large">Top Quality </h4>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md d-flex flex-column mb-3">
                    <a href="#" class="text-decoration-none d-block flex-fill">
                        <div class="thumb-info h-100">
                            <div class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details04.jpg">
                            </div>
                            <div class="thumb-info-caption py-3">
                                <h4 class="font-weight-semibold mb-1 w3-large">Natural Feed</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md d-flex flex-column mb-3">
                    <a href="javascript:void(0)" class="text-decoration-none d-block flex-fill">
                        <div class="thumb-info h-100">
                            <div class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details03.jpg">
                            </div>
                            <div class="thumb-info-caption py-3">
                                <h4 class="font-weight-semibold mb-1 w3-large">Hand Milk</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>



        </div>
    </section>



    <section class="my-5">
        <div class="container">

            <!-- Section Header -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold display-6 text-primary mb-2">Our Services</h2>
                    <p class="text-muted">Choose the best dairy and get world-class product</p>
                </div>
            </div>

            <!-- Owl Carousel -->
            <div class="row">
                <div class="owl-carousel owl-theme show-nav-title"
                    data-plugin-options='{"items": 4, "margin": 10, "loop": true, "nav": true, "autoplay":true, "dots": false}'>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b1.jpg"
                                        alt="Moon Hospital">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Quality Feed
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b2.jpg"
                                        alt="Health care">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Pure Milk
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b3.jpg"
                                        alt="Nurjan hospital">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Skill Seargeon
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b1.jpg"
                                        alt="Delta hospital">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Feed Manage
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b2.jpg"
                                        alt="Enam Hospital">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Pure Milk
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-0  rounded overflow-hidden h-100 hover-shadow ">

                                <!-- Hospital Image -->
                                <div class="position-relative">
                                    <img class="card-img-top img-fluid" src="uslive/cpmd/inner_b3.jpg"
                                        alt="Green Life Hospital, Rampura">

                                    <!-- Overlay Effect (light opacity) -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                        style="opacity:0; transition: all 0.3s ease-in-out;"
                                        onmouseover="this.style.opacity='0.25';" onmouseout="this.style.opacity='0';">
                                        <div class="d-flex h-100 justify-content-center align-items-center">
                                            <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body text-center py-3">
                                    <h5 class="card-title fw-semibold text-dark mb-0">
                                        Care Cattles
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>





    <section class="section section-no-border">
        <div class="container">
            <div class="row pt-3">
                <div class="col text-center mb-4">
                    <h2 class="fw-semibold display-6 mb-2 text-primary">Departments</h2>
                    <p class="text-muted fs-6 mb-0">Explore our Deaprtments</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeInUp"
                        data-appear-animation-delay="300">
                        <div class="feature-box-icon" style="min-width: 4.7rem;">
                            <img src="uslive/original/ab-icon-01.png" alt class="img-fluid" />
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-semibold"><a href="javascript::void(0)"
                                    class="text-decoration-none">Milk & Desert</a></h4>
                            <p>A Dairy Specialist is an agricultural professional trained in managing, improving, and
                                maintaining dairy production and herd health. They provide expert care in areas such as
                                milk quality, cattle nutrition, breeding, and disease prevention, helping farmers
                                increase productivity, ensure animal welfare, and deliver safe, high-quality dairy
                                products for consumers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeInUp"
                        data-appear-animation-delay="300">
                        <div class="feature-box-icon" style="min-width: 4.7rem;">
                            <img src="uslive/original/ab-icon-02.png" alt class="img-fluid" />
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-semibold"><a href="javascript::void(0)"
                                    class="text-decoration-none">Meat</a></h4>
                            <p>A Dairy Specialist is an agricultural professional trained in managing, improving, and
                                maintaining dairy production and herd health. They provide expert care in areas such as
                                milk quality, cattle nutrition, breeding, and disease prevention, helping farmers
                                increase productivity, ensure animal welfare, and deliver safe, high-quality dairy
                                products for consumers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeInUp"
                        data-appear-animation-delay="300">
                        <div class="feature-box-icon" style="min-width: 4.7rem;">
                            <img src="uslive/original/sve-icon3.png" alt class="img-fluid" />
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-semibold"><a href="javascript::void(0)"
                                    class="text-decoration-none">Food </a></h4>
                            <p>A Dairy Specialist is an agricultural professional trained in managing, improving, and
                                maintaining dairy production and herd health. They provide expert care in areas such as
                                milk quality, cattle nutrition, breeding, and disease prevention, helping farmers
                                increase productivity, ensure animal welfare, and deliver safe, high-quality dairy
                                products for consumers.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-2 pb-4">
                <div class="col-lg-12 text-center">
                    <a class="btn btn-outline btn-quaternary custom-button text-uppercase mt-4 font-weight-bold"
                        href="#">View More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 
<section class="team pb-2">
    <div class="container">
        <div class="row pt-4">
            <div class="col text-center">
                <h2 class="fw-bold display-6 text-primary mb-2">Our Specialist Doctors</h2>
                <p class="text-muted"> Meet our specialists delivering expert care with dedication and compassion.</p>
        

                <div id="porfolioAjaxBoxMedical" class="ajax-box ajax-box-init mb-4">
                    <div class="bounce-loader">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="ajax-box-content" id="porfolioAjaxBoxContentMedical"></div>
                </div>
            </div>
        </div>

        <div class="row pb-5">
            <div class="owl-carousel owl-theme nav-bottom rounded-nav show-nav-title ps-1 pe-1" 
                 data-plugin-options="{'items': 4, 'loop': false, 'dots': false, 'nav': true}">
                
                                    <div class="pe-3 ps-3">
                        <a href="doctor/details/25.html" class="text-decoration-none">
                            <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                <span class="thumb-info-wrapper m-0">
                                    <img src="uslive/pfimd/1756020375.jpg" class="img-fluid" alt="Rahat Mia">
                                </span>
                                <span class="thumb-info-caption p-4">
                                    <span class="custom-thumb-info-title">
                                        <span class="custom-thumb-info-type font-weight-light text-4">Cardiologists</span>
                                        <span class="custom-thumb-info-inner font-weight-semibold text-5">Rahat Mia</span>
                                        <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                                    <div class="pe-3 ps-3">
                        <a href="doctor/details/26.html" class="text-decoration-none">
                            <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                <span class="thumb-info-wrapper m-0">
                                    <img src="uslive/pfimd/1756020342.jpg" class="img-fluid" alt="Rakib Hasan">
                                </span>
                                <span class="thumb-info-caption p-4">
                                    <span class="custom-thumb-info-title">
                                        <span class="custom-thumb-info-type font-weight-light text-4">Cardiologists</span>
                                        <span class="custom-thumb-info-inner font-weight-semibold text-5">Rakib Hasan</span>
                                        <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                                    <div class="pe-3 ps-3">
                        <a href="doctor/details/28.html" class="text-decoration-none">
                            <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                <span class="thumb-info-wrapper m-0">
                                    <img src="uslive/pfimd/1756020439.jpg" class="img-fluid" alt="Sultan Mahabub">
                                </span>
                                <span class="thumb-info-caption p-4">
                                    <span class="custom-thumb-info-title">
                                        <span class="custom-thumb-info-type font-weight-light text-4">Medicine</span>
                                        <span class="custom-thumb-info-inner font-weight-semibold text-5">Sultan Mahabub</span>
                                        <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                                    <div class="pe-3 ps-3">
                        <a href="doctor/details/29.html" class="text-decoration-none">
                            <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                <span class="thumb-info-wrapper m-0">
                                    <img src="uslive/pfimd/1756020489.jpg" class="img-fluid" alt="Jhon Doe">
                                </span>
                                <span class="thumb-info-caption p-4">
                                    <span class="custom-thumb-info-title">
                                        <span class="custom-thumb-info-type font-weight-light text-4">Gynecologist</span>
                                        <span class="custom-thumb-info-inner font-weight-semibold text-5">Jhon Doe</span>
                                        <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                                    <div class="pe-3 ps-3">
                        <a href="doctor/details/30.html" class="text-decoration-none">
                            <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                <span class="thumb-info-wrapper m-0">
                                    <img src="uslive/pfimd/1756021568.png" class="img-fluid" alt="Masum Billal">
                                </span>
                                <span class="thumb-info-caption p-4">
                                    <span class="custom-thumb-info-title">
                                        <span class="custom-thumb-info-type font-weight-light text-4">Cardiologists</span>
                                        <span class="custom-thumb-info-inner font-weight-semibold text-5">Masum Billal</span>
                                        <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                
            </div>
        </div>
    </div>
</section> -->

    <section class="section overlay overlay-show overlay-color-primary custom-overlay-opacity-40 border-0 m-0" style="background: url(uslive/pfimd/parallax.jpg); 
                background-size: cover; 
                background-position: center;">
        <div class="container position-relative z-index-2 pt-5">
            <div class="row">
                <div class="col text-center">
                    <h3 class="font-weight-bold text-color-light text-4-5 ls-0 mb-2">About Us</h3>
                    <h2 class="font-weight-bold text-color-light text-8 line-height-3 line-height-md-1 mb-1">Product
                        Summary</h2>
                </div>
            </div>

            <div class="row counters counters-sm text-6 pb-5 pt-4 mt-5">
                <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="counter">
                        <strong class="text-color-light font-weight-extra-bold text-8 line-height-1" data-to="100"
                            data-append="+">100%</strong>
                        <span class="text-color-light font-weight-normal line-height-1 text-0 mt-0">Quality</span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="counter">
                        <strong class="text-color-light font-weight-extra-bold text-8 line-height-1" data-to="1575"
                            data-append="+">1575+</strong>
                        <span class="text-color-light font-weight-normal line-height-1 text-0 mt-0">Customer</span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
                    <div class="counter">
                        <strong class="text-color-light font-weight-extra-bold text-8 line-height-1" data-to="26"
                            data-append="+">26+</strong>
                        <span class="text-color-light font-weight-normal line-height-1 text-0 mt-0">People
                            working</span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="counter">
                        <strong class="text-color-light font-weight-extra-bold text-8 line-height-1" data-to="5"
                            data-append="+">5+</strong>
                        <span class="text-color-light font-weight-normal line-height-1 text-0 mt-0">Years of
                            experience</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{--<section class="section my-0">
        <div class="container">

            <!-- Section Title -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold display-6 text-primary mb-2">Ambulance Services</h2>
                    <p class="text-muted">Choose the best ambulance service and get world-class treatment</p>
                </div>
            </div>

            <!-- Custom Nav -->
            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-outline-primary btn-sm me-2 custom-owl-prev">
                    <i class="icon-arrow-left icons"></i>
                </button>
                <button class="btn btn-outline-primary btn-sm custom-owl-next">
                    <i class="icon-arrow-right icons"></i>
                </button>
            </div>

            <!-- Owl Carousel -->
            <div class="owl-carousel owl-theme" id="ambulance-carousel"
                data-plugin-options='{"items": 4, "margin": 10, "loop": true, "nav": false, "autoplay":true, "dots": false}'>
                <div class="item">
                    <div class="card border-0 shadow-sm h-100 rounded overflow-hidden">
                        <a href="javascript:void(0)" class="text-decoration-none">
                            <img src="uslive/pfimd/1756267306.png" class="card-img-top img-fluid"
                                alt="CityCare Ambulance">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-1">CityCare Ambulance</h5>
                                <p class="card-subtitle w3-small text-muted">24/7 Emergency</p>
                                <p class="mb-0 mt-2">📞 01711-111111</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow-sm h-100 rounded overflow-hidden">
                        <a href="javascript:void(0)" class="text-decoration-none">
                            <img src="uslive/pfimd/1756523712.jpg" class="card-img-top img-fluid"
                                alt="SafeRide Ambulance">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-1">SafeRide Ambulance</h5>
                                <p class="card-subtitle w3-small text-muted">Long Distance</p>
                                <p class="mb-0 mt-2">📞 01644-444444</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow-sm h-100 rounded overflow-hidden">
                        <a href="javascript:void(0)" class="text-decoration-none">
                            <img src="uslive/pfimd/1756523827.jpg" class="card-img-top img-fluid"
                                alt="HealthLine Ambulance">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-1">HealthLine Ambulance</h5>
                                <p class="card-subtitle w3-small text-muted">ICU Support</p>
                                <p class="mb-0 mt-2">📞 01933-333333</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow-sm h-100 rounded overflow-hidden">
                        <a href="javascript:void(0)" class="text-decoration-none">
                            <img src="uslive/pfimd/1756523882.jpg" class="card-img-top img-fluid" alt="Rapid Response">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold mb-1">Rapid Response</h5>
                                <p class="card-subtitle w3-small text-muted">AC / Non-AC</p>
                                <p class="mb-0 mt-2">📞 01822-222222</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}


    <section class=" my-5">
        <div class="container">

            <!-- Section Title -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold display-6 text-primary mb-2">Latest News</h2>
                    <p class="text-muted">Be the first to read</p>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <span
                            class="thumb-info thumb-info-side-image thumb-info-side-image-custom thumb-info-no-zoom thumb-info-no-zoom thumb-info-side-image-custom-highlight d-block">
                            <span class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details03.jpg">
                            </span>
                            <span class="thumb-info-caption px-4 pb-3">
                                <span class="thumb-info-caption-text p-xl">
                                    <h4 class="font-weight-semibold mb-1">Lactose Intolerance: Challenges in Dairy
                                        Consumption</h4>
                                    <p class="text-3">Lactose intolerance is a common digestive disorder caused by the
                                        inability to break down lactose, a sugar found in milk and dairy products,
                                        leading to bloating, gas, and discomfort...</p>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <span
                            class="thumb-info thumb-info-side-image thumb-info-side-image-custom thumb-info-no-zoom thumb-info-no-zoom thumb-info-side-image-custom-highlight d-block">
                            <span class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/b_details04.jpg">
                            </span>
                            <span class="thumb-info-caption px-4 pb-3">
                                <span class="thumb-info-caption-text p-xl">
                                    <h4 class="font-weight-semibold mb-1">Advances in Dairy Nutrition: Enhancing Milk
                                        Quality</h4>
                                    <p class="text-3">Modern dairy research focuses on improving cattle diets to boost
                                        milk production and nutritional value, while also ensuring animal health,
                                        sustainability, and high-quality dairy output...</p>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <span
                            class="thumb-info thumb-info-side-image thumb-info-side-image-custom thumb-info-no-zoom thumb-info-no-zoom thumb-info-side-image-custom-highlight d-block">
                            <span class="thumb-info-side-image-wrapper">
                                <img alt="" class="img-fluid" src="uslive/cpmd/blog9.jpg">
                            </span>
                            <span class="thumb-info-caption px-4 pb-3">
                                <span class="thumb-info-caption-text p-xl">
                                    <h4 class="font-weight-semibold mb-1">Probiotics in Dairy: Supporting Gut Health
                                    </h4>
                                    <p class="text-3">Dairy-based probiotics, such as yogurt and kefir, play a vital
                                        role in maintaining digestive health by balancing gut microbiota, enhancing
                                        immunity, and preventing gastrointestinal disorders...</p>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>


            </div>
            <div class="row pb-4">
                <div class="col-lg-12 text-center">
                    <a href="#"
                        class="btn btn-outline btn-quaternary custom-button text-uppercase font-weight-bold">view
                        more</a>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection