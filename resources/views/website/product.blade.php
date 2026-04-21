@extends('frontend.layouts.app')
@section('title', 'Products')
@section('content')

<div role="main" class="main">

    <!-- <a class="envato-buy-redirect" href="login.html">
							<i class="fas fa-shopping-cart w3-large" style="color: #18443F"></i>
							<span class="extra-cart-info" style="background: #18443F">
								<span class="cartItemsCount" id="">2</span>
							</span>
						</a> -->

    <!-- Bottom Nav Bar start-->
    <!-- <div class="mobile-bottom-bar">
							<a href="login.html" class="checkout-btn">
								<span class="checkout-text">Checkout</span>
								<span class="checkout-price">৳120</span>
								<i class="fas fa-shopping-cart"></i>
							</a>
							<div class="other-icons">
								<a href="index.html"><i class="fas fa-home"></i></a>
								<a href="shasthoseba.html""><i class="fas fa-th-large"></i></a>
								<a href="#"><i class="fas fa-search"></i></a>
							</div>
						</div> -->
    <!-- Bottom Nav Bar end-->
    </section>

    <!-- <div class="container">
        <ul class="breadcrumb breadcrumb-dark breadcrumb-sm px-0 py-2">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="active">Products</li>
        </ul>
    </div> -->

    <section class="section my-0 py-0">
        <div class="container py-5">

            <div class="row g-4">
                <!-- Sidebar -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar">

                        <h5 class="font-weight-semi-bold pt-3">Product Categories</h5>
                        <ul class="nav nav-list flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Dairy Product (3)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Healthy Food (3)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Cream Food (3)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Mixed (4)
                                </a>
                            </li>
                        </ul>

                    </aside>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9 order-1 order-lg-2">

                    <!-- Top filter section -->
                    <!-- <div class="row mb-4 align-items-center">
                        <div class="col-md-6">
                            <form method="GET" class="d-flex align-items-center gap-2">
                                <select name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                                    <option value="1">Sort by Latest</option>
                                    <option value="2">Sort by Oldest</option>
                                    <option value="3">Sort by Price: High → Low</option>
                                    <option value="4">Sort by Price: Low → High</option>
                                </select>
                                <input type="hidden" name="min_price" value="">
                                <input type="hidden" name="max_price" value="">
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted">
                                Showing <strong>1 - 12</strong> of
                                <strong>13</strong> results
                            </span>
                        </div>
                    </div> -->

                    <!-- Products Grid -->
                    <div class="row g-4">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img1.jpg" class="card-img-top rounded-top"
                                        alt="Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                            Curd
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            919.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="13">
                                        <div class="cart-action-wrapper" data-product="13">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="13">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img2.jpg" class="card-img-top rounded-top"
                                        alt="Supermom Baby Diaper Belt S (3- 8 kg)">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                           Milk
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            109.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="12">
                                        <div class="cart-action-wrapper" data-product="12">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="12">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img3.jpg" class="card-img-top rounded-top"
                                        alt="NeoCare New Born Diaper Belt (0-4 kg) 20 pcs">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                            Butter
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            620.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="11">
                                        <div class="cart-action-wrapper" data-product="11">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="11">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img4.jpg" class="card-img-top rounded-top"
                                        alt="Germnil Surgical Face Mask 50 pcs">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Health
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#" class="text-dark text-decoration-none">
                                            Cheese
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            500.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="10">
                                        <div class="cart-action-wrapper" data-product="10">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="10">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>


						                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img1.jpg" class="card-img-top rounded-top"
                                        alt="Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                            Curd
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            919.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="13">
                                        <div class="cart-action-wrapper" data-product="13">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="13">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img2.jpg" class="card-img-top rounded-top"
                                        alt="Supermom Baby Diaper Belt S (3- 8 kg)">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                           Milk
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            109.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="12">
                                        <div class="cart-action-wrapper" data-product="12">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="12">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img3.jpg" class="card-img-top rounded-top"
                                        alt="NeoCare New Born Diaper Belt (0-4 kg) 20 pcs">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Food
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#"
                                            class="text-dark text-decoration-none">
                                            Butter
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            620.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="11">
                                        <div class="cart-action-wrapper" data-product="11">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="11">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm card-hover">

                                <!-- Image -->
                                <a href="#" class="d-block">
                                    <img src="frontend/assets/img/product/img4.jpg" class="card-img-top rounded-top"
                                        alt="Germnil Surgical Face Mask 50 pcs">
                                </a>

                                <!-- Body -->
                                <div class="card-body d-flex flex-column p-3">

                                    <!-- Category -->
                                    <small class="d-block text-uppercase mb-1">
                                        <span class="font-weight-bold" style="color: #dc3545">
                                            Health
                                        </span> </small>

                                    <!-- Product Name -->
                                    <h6 class="fw-semibold text-truncate mb-1">
                                        <a href="#" class="text-dark text-decoration-none">
                                            Cheese
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold text-primary w3-small">
                                            500.00 ৳
                                        </span>
                                    </div>

                                    <div class="mt-auto productCartItem" data-product="10">
                                        <div class="cart-action-wrapper" data-product="10">

                                            <!-- Add to Cart Button -->
                                            <input type="hidden" name="product_qty" value="1" class="product_qty">
                                            <button class="btn btn-outline-primary w-100 btn-sm addToCart"
                                                data-url="#" data-product="10">
                                                Buy Now
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-4">
                        <div class="col">
                            <nav>
                                <ul class="pagination justify-content-end mb-0">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item disabled" aria-disabled="true"
                                                aria-label="&laquo; Previous">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>

                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="#" rel="next"
                                                    aria-label="Next &raquo;">&rsaquo;</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

</div>

@endsection