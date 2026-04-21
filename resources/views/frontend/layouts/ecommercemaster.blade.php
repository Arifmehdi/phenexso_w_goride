<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @yield('meta')
    @stack('css')

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">
    <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">

    <!-- Web Fonts -->
    <link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme-shop.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/skins/skin-medical.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">

    <!-- Analytics -->
    @if(!empty($ws->google_analytics_code)){!! $ws->google_analytics_code !!}@endif
    @if(!empty($ws->google_search_console)){!! $ws->google_search_console !!}@endif
    @if(!empty($ws->facebook_pixel_code)){!! $ws->facebook_pixel_code !!}@endif

    <style>
        /* ================= Floating Desktop Cart ================= */
        .envato-buy-redirect {
            position: fixed;
            top: 45%;
            right: 20px;
            z-index: 9999;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid #FF1493;
        }
        .envato-buy-redirect:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
        }
        .envato-buy-redirect i {
            font-size: 28px;
            color: #FF1493;
        }
        .extra-cart-info {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #FF1493;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ================= Floating WhatsApp ================= */
        .floating-message-icon {
            position: fixed;
            top: calc(45% + 80px);
            right: 20px;
            z-index: 9999;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #25D366;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease;
        }
        .floating-message-icon:hover {
            transform: scale(1.1);
        }
        .floating-message-icon img {
            width: 38px;
            height: 38px;
        }

        /* ================= Mobile Bottom Bar ================= */
        .mobile-bottom-bar {
            display: none;
        }
        @media (max-width: 768px) {
            /* .envato-buy-redirect, .floating-message-icon {
                display: none !important;
            } */
            .mobile-bottom-bar {
                display: flex !important;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 60px;
                align-items: center;
                justify-content: space-between;
                background: #ffffff;
                box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
                padding: 0 10px;
                z-index: 9999;
            }
            .checkout-btn {
                background: #0A52A3;
                color: #fff;
                font-weight: bold;
                padding: 6px 36px;
                border-radius: 10px;
                text-decoration: none;
                display: flex;
                align-items: center;
                position: relative;
            }
            .checkout-price {
                position: absolute;
                top: -6px;
                right: -8px;
                background: red;
                color: #fff;
                font-size: 12px;
                padding: 2px 6px;
                border-radius: 50%;
            }
            .other-icons {
                display: flex;
                gap: 15px;
            }
            .other-icons a {
                color: #0A52A3;
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
@php 
$count_info = \App\Models\Cart::when(Auth::check(), fn($q) => $q->where('user_id', Auth::id()))
    ->when(!Auth::check(), fn($q) => $q->where('session_id', session('session_id')));
$count_data = $count_info->count();
$totalCartPrice = \App\Models\Cart::totalCartPrice();
@endphp

<div class="body">
    @include('frontend.layouts.ecommerceheader')

    <div role="main" class="main mt-5">

        <!-- 🛒 Floating Add to Cart Button -->
        <a class="envato-buy-redirect" href="{{ route('new.checkout') }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="extra-cart-info"><span class="cartItemsCount">{{ $count_data }}</span></span>
        </a>

        <!-- 📱 Mobile Bottom Navigation Bar -->
        <div class="mobile-bottom-bar">
            <a href="{{ route('checkout') }}" class="checkout-btn">
                Checkout
                <span class="checkout-price">৳{{ $totalCartPrice }}</span>
                <i class="fas fa-shopping-cart ms-2"></i>
            </a>
            <div class="other-icons">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                <a href="{{ url('/') }}"><i class="fas fa-th-large"></i></a>
                <a href="#"><i class="fas fa-search"></i></a>
            </div>
        </div>

        <!-- ✅ Sweet Alert & Content -->
        @include('sweetalert::alert')
        @yield('content')
    </div>

    @include('frontend.layouts.footer')
</div>

<!-- ================= Scripts ================= -->
<script src="{{ asset('frontend/assets/vendor/plugins/js/plugins.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/theme.js') }}"></script>
<script src="{{ asset('frontend/assets/js/views/view.contact.js') }}"></script>
<script src="{{ asset('frontend/assets/js/demos/demo-medical.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
<script src="{{ asset('frontend/assets/js/theme.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@stack('js')

<script>
		$.ajaxSetup({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});

		$(document).ready(function () {

			$('#searchIcon').on('click', function(e) {
				e.preventDefault();
				$('#searchContainer').toggle();
			});


			// Add to Cart
			$(document).on("click", ".addToCart", function () {
				let btn = $(this);
				let url = btn.data("url");
				let product_id = btn.data("product");
				let qty = parseInt(btn.closest(".productCartItem").find(".product_qty").val()) || 1;

				$.post(url, { product: product_id, qty: qty }, function (res) {
					if (res.status) {
						btn.closest(".productCartItem").html(res.productCartItem);
						$(".cartCount").text(res.cartCount);
						$(".cartItemsCount").text(res.cartItemsCount);
						$(".cartTotalPrice").text(res.cartTotal.toFixed(2) + " tk");
						$(".mobileCartTotalPrice").text("৳" + res.cartTotal.toFixed(2));

						Swal.fire({
							toast: true, icon: "success", title: res.message,
							position: "top", timer: 2000, showConfirmButton: false
						});
					}
				}).fail(() => {
					Swal.fire("Error", "Could not add to cart.", "error");
				});
			});
			

			$(document).on('click', '.updateCartItemold', function (e) {
				e.preventDefault();

				let $btn = $(this);
				let cartId = $btn.data('cart');
				let url = $btn.data('url');
				let $wrapper = $btn.closest('.cart-action-wrapper');
				let qty = parseInt($wrapper.find('.cartQtyDisplay').text()) || 0;

				// Update quantity
				if ($btn.hasClass('plus')) {
					qty++;
				} else if ($btn.hasClass('minus')) {
					qty--;
					if (qty < 0) qty = 0; // prevent negative qty
				}

				// Disable button during AJAX
				$btn.prop('disabled', true);

				$.ajax({
					url: url,
					method: 'POST',
					data: {
						cart: cartId,
						new_qty: qty,
						_token: $('meta[name="csrf-token"]').attr('content')
					},
					success: function (res) {
						if (res.status) {
							if (qty === 0) {
								// Replace qty box with "Add to Cart"
								$wrapper.html(`
									<input type="hidden" name="product_qty" value="1" class="product_qty">
									<button class="btn btn-outline-primary w-100 btn-sm addToCart"
										data-url="${res.add_to_cart_url}"
										data-product="${res.product_id}">
										ADD TO CART
									</button>
								`);

								// If no cart items left → redirect

							
								if ($(".cart-item").length === 0) {
									window.location.href = "/";
								}
							} else {
								// Update qty display & button data
								$wrapper.find('.cartQtyDisplay').text(qty);
								$wrapper.find('.plus').data('qty', qty);
								$wrapper.find('.minus').data('qty', qty);

								// Update row subtotal
								let $row = $btn.closest('.cart-item');
								let $priceBox = $row.find('.itemTotalPrice');
								if ($priceBox.length) {
									let unitPrice = parseFloat($priceBox.data('unit-price'));
									$priceBox.text("Tk. " + (unitPrice * qty).toFixed(2));
								}
							}

							                            // Update header/cart summary
														$('.cartCount').text(res.cartCount);
														$('.cartItemsCount').text(res.cartItemsCount);
							
														$(".subtotal").text("Tk. " + res.cartTotal.toFixed(2));
														$(".discount").text("-Tk. " + res.discount.toFixed(2));
														$(".payable").text("Tk. " + res.payable.toFixed(2));
														$(".mobileCartTotalPrice").text('৳' + res.payable.toFixed(2));
													}
												},
												error: function () {						alert('Something went wrong! Please try again.');
					},
					complete: function () {
						$btn.prop('disabled', false);
					}
				});
			});


			$(document).on('click', '.updateCartItem', function (e) {
				e.preventDefault();

				let $btn = $(this);
				let cartId = $btn.data('cart');
				let url = $btn.data('url');
				let $wrapper = $btn.closest('.cart-action-wrapper');
				let qty = parseInt($wrapper.find('.cartQtyDisplay').text()) || 0;

				// Qty update
				if ($btn.hasClass('plus')) {
					qty++;
				} else if ($btn.hasClass('minus')) {
					qty--;
					if (qty < 0) qty = 0; // negative prevent
				}

				$btn.prop('disabled', true); // prevent double click

				$.ajax({
					url: url,
					method: 'POST',
					data: {
						cart: cartId,
						new_qty: qty,
						_token: $('meta[name="csrf-token"]').attr('content')
					},
					success: function (res) {
						if (res.status) {
							if (qty === 0) {
								// Show Add to Cart
								$wrapper.html(`
									<input type="hidden" name="product_qty" value="1" class="product_qty">
									<button class="btn btn-outline-primary w-100 btn-sm addToCart"
										data-url="${res.add_to_cart_url}"
										data-product="${res.product_id}">
										ADD TO CART
									</button>
								`);

								if ($(".cart-item").length === 0) {
									window.location.href = "/";
								}
							} else {
								// Update qty display
								$wrapper.find('.cartQtyDisplay').text(qty);
								$wrapper.find('.plus').data('qty', qty);
								$wrapper.find('.minus').data('qty', qty);

								// ✅ Row subtotal update (cart page)
								let $row = $btn.closest('.cart-item');
								let $priceBox = $row.find('.itemTotalPrice');
								if ($priceBox.length) {
									let unitPrice = parseFloat($priceBox.data('unit-price'));
									$priceBox.text("Tk. " + (unitPrice * qty).toFixed(2));
								}

								// ✅ Product details price update
								updateProductDetailsPrice(qty);
							}

							// ✅ Header/cart summary update
							$('.cartCount').text(res.cartCount);
							$('.cartItemsCount').text(res.cartItemsCount);
							$(".subtotal").text("Tk. " + res.cartTotal.toFixed(2));
							$(".discount").text("-Tk. " + res.discount.toFixed(2));
							$(".payable").text("Tk. " + res.payable.toFixed(2));
							$(".mobileCartTotalPrice").text('৳' + res.payable.toFixed(2));
						}
					},
					error: function () {
						alert('Something went wrong! Please try again.');
					},
					complete: function () {
						$btn.prop('disabled', false);
					}
				});
			});

			/**
			 * ✅ Update product details page price dynamically
			 */
			function updateProductDetailsPrice(qty) {
				let unitPriceBox = $('.unitPriceBox');
				let finalPriceBox = $('.finalPriceBox');

				if (finalPriceBox.length) {
					let unitFinal = parseFloat(finalPriceBox.data('unit-price'));
					finalPriceBox.text((unitFinal * qty).toFixed(2) + " ৳");
				}
				if (unitPriceBox.length) {
					let unitStrike = parseFloat(unitPriceBox.data('unit-price'));
					unitPriceBox.text((unitStrike * qty).toFixed(2) + " ৳");
				}
			}

			



			// Delete Cart Item
			$(document).on("click", ".deleteCartItem", function () {
				let btn = $(this);
				$.post(btn.data("url"), {}, function (res) {
					if (res.status) {
						$('.cart-item[data-cart="' + res.cart_id + '"]').remove();

						if ($(".cart-item").length === 0) {
							window.location.href = "/";
						}

						$(".cartCount").text(res.cartCount);
						$(".cartItemsCount").text(res.cartItemsCount);
						$(".cartTotalPrice").text(res.cartTotal.toFixed(2) + " tk");
						$(".subtotal").text("Tk. " + res.cartTotal.toFixed(2)).attr('data-value', res.cartTotal);
						$(".discount").text("-Tk. " + res.discount.toFixed(2)).attr('data-value', res.discount);
						$(".payable").text("Tk. " + res.payable.toFixed(2));
						$(".mobileCartTotalPrice").text('৳' + res.payable.toFixed(2));

						Swal.fire({
							toast: true, icon: "success", title: res.message,
							position: "top-end", timer: 2000, showConfirmButton: false
						});
					}
				}).fail(() => {
					Swal.fire("Error", "Cart item could not be removed.", "error");
				});
			});

		});
		</script>

<!-- ✅ Floating WhatsApp Icon -->
<a class="floating-message-icon" href="https://wa.me/8801334927985?text=Hello%20there!" target="_blank">
    <img src="{{ asset('frontend/assets/img/icons/whatsapp.svg') }}" alt="WhatsApp">
</a>

</body>
</html>
