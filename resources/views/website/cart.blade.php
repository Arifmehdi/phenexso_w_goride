@extends('website.layouts.master')

@section('title', 'Cart - '. env('APP_NAME') )

@section('meta')
<meta name="description"
    content="Contact North Bengal for inquiries, product details, or business queries. Get in touch via phone, email, or visit our office.">
<meta name="keywords" content="contact north bengal, contact us, north bengal inquiries, phone, email, office location">
<meta property="og:title" content="Contact Us - North Bengal">
<meta property="og:description" content="Reach North Bengal for product inquiries or business partnerships.">
<meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/contact_banner.png') }}">
<meta property="og:type" content="website">
@endsection
@section('content')
<!-- BREADCRUMB AREA START -->
<x-breadcrumb title="Cart" pageName="Cart" bgImage="frontend/img/bg/9.jpg" />
<!-- BREADCRUMB AREA END -->
@php
$me = Auth::user();
if($me){
$dl = $me->locations()->first();
}
else{
$dl = null;
}
$cartTotal = $cart_total ?? $cartItems->sum(fn($item) => $item->price * $item->quantity);
@endphp

@if($cartItems->isEmpty())
    <p class="text-center text-muted py-5 fs-5">Your cart is empty </p>
@else 
<!-- WISHLIST AREA START -->
<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                        <h5>Returning customer? <a class="ltn__secondary-color" href="#ltn__returning-customer-login"
                                data-bs-toggle="collapse">Click here to login</a></h5>
                        <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn_coupon-code-form ltn__form-box">
                                <p>Please login your accont.</p>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="ltn__name" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" name="ltn__email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                    <label class="input-info-save mb-0"><input type="checkbox" name="agree"> Remember
                                        me</label>
                                    <p class="mt-30"><a href="register.html">Lost your password?</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                        <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code"
                                data-bs-toggle="collapse">Click here to enter your code</a></h5>
                        <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn__coupon-code-form">
                                <p>If you have a coupon code, please apply it below.</p>
                                <form action="#">
                                    <input type="text" name="coupon-code" placeholder="Coupon code">
                                    <button class="btn theme-btn-2 btn-effect-2 text-uppercase">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Billing Details</h4>
                        <div class="ltn__checkout-single-content-info">
                            <!-- Flash Messages -->
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form id="checkoutForm" method="POST" action="">
                                @csrf
                                <h6>Personal Information</h6>
                                <input type="hidden" name="shipping_price" id="hidden-shipping-price" value="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="ltn__name" placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="ltn__lastname" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" name="ltn__email" placeholder="email address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" name="ltn__phone" placeholder="phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="ltn__company"
                                                placeholder="Company name (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="ltn__phone"
                                                placeholder="Company address (optional)">
                                        </div>
                                    </div>
                                </div>
                                <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Create an
                                        account?</label></p>
                                <h6>Order Notes (optional)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="ltn__message"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- SHOPING CART AREA START -->
            <div class="liton__shoping-cart-area mb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping-cart-inner">
                                <div class="shoping-cart-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th class="cart-product-remove">Remove</th>
                                            <th class="cart-product-image">Image</th>
                                            <th class="cart-product-info">Product</th>
                                            <th class="cart-product-price">Price</th>
                                            <th class="cart-product-quantity">Quantity</th>
                                            <th class="cart-product-subtotal">Subtotal</th>
                                        </thead>
                                        <tbody>
                                            @forelse($cartItems as $item)
                                            <tr id="cart-item-{{ $item->id }}">
                                                <td class="cart-product-remove">
                                                    <a href="javascript:void(0);"
                                                        class="cart-product-remove text-danger"
                                                        data-id="{{ $item->id }}">x</a>
                                                </td>
                                                <td class="cart-product-image">
                                                    <a href="{{ route('productDetails', $item->product->slug) }}">
                                                        <img src="{{ route('imagecache', ['template'=>'pnism','filename'=>$item->product->fi()]) }}"
                                                            alt="{{ $item->product->name_en }}">
                                                    </a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a href="{{ route('productDetails', $item->product->slug) }}"
                                                            title="{{ $item->product->name_en }}">{{ Str::limit($item->product->name_en, 20) }}</a>
                                                    </h4>
                                                </td>
                                                <td class="cart-product-price"
                                                    data-price="{{ $item->product->final_price }}">
                                                    {{ number_format($item->product->final_price,2) }} ৳</td>
                                                <td class="cart-product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input type="number" value="{{ $item->quantity }}"
                                                            name="qtybutton" class="cart-plus-minus-box"
                                                            data-id="{{ $item->id }}" min="1">
                                                    </div>
                                                </td>
                                                <td class="cart-product-subtotal" id="subtotal-{{ $item->id }}">
                                                    {{ number_format($item->quantity * $item->product->final_price,2) }}
                                                    ৳</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Your cart is empty!</td>
                                            </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOPING CART AREA END -->
            <div class="col-lg-6">
                <div class="ltn__checkout-payment-method mt-50">
                    <h4 class="title-2">Payment Method</h4>
                    <div id="checkout_accordion_1">
                        <!-- card -->
                        <div class="card">
                            <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2"
                                aria-expanded="true">
                                Cash on delivery <img src="{{ asset('frontend/img/icons/cash.png') }}" alt="#">
                            </h5>
                            <div id="faq-item-2-2" class="collapse show" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                        </div>

                        <!-- card -->
                        <div class="card">
                            <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                data-bs-target="#faq-item-2-4" aria-expanded="false">
                                Online Payment <img src="{{ asset('frontend/img/icons/payment-3.png') }}" alt="#">
                            </h5>
                            <div id="faq-item-2-4" class="collapse" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Pay via Online; you can pay with your credit card if you don’t have a PayPal
                                        account.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__payment-note mt-30 mb-30">
                        <p>Your personal data will be used to process your order, support your experience throughout
                            this website, and for other purposes described in our privacy policy.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Cart Totals</h4>
                    <table class="table">
                        <tbody>
                            <!-- <tr>
                                    <td>Vegetables Juices <strong>× 2</strong></td>
                                    <td>$298.00</td>
                                </tr>
                                <tr>
                                    <td>Orange Sliced Mix <strong>× 2</strong></td>
                                    <td>$170.00</td>
                                </tr> -->
                            <tr>
                                <td>Cart Subtotal</td>
                                <td id="cart-subtotal">{{ number_format($cartSubtotal,2) }} ৳</td>
                            </tr>
                            <tr>
                                <td>Shipping and Handing</td>
                                <td>{{$ws->shipping_charge ?? '0.00' }} ৳</td>
                            </tr>
                            <tr>
                                <td>Vat</td>
                                <td>00.00 ৳</td>
                            </tr>
                            <tr>
                                <td><strong>Order Total</strong></td>
                                <td id="order-total"><strong>{{ number_format($cartSubtotal , 2) }} ৳</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-wrapper text-right text-end mt-3">
                        <a href="{{ route('checkout') }}" class="theme-btn-1 btn btn-effect-1">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->
@endif

<!-- FEATURE AREA START ( Feature - 3) -->
<x-footer-feature />
<!-- FEATURE AREA END -->
@endsection

@push('js')

@endpush