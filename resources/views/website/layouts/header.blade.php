<style>
    .special-link a, .theme-btn-1{
        padding: 10px 20px;
        background: #66A931;   /* change color */
        color: #fff;
        border-radius: 8px;     /* <-- Rounded corners */
        display: inline-block;
    }
    .btn-transparent {
        padding: 10px 20px;/* change color */
        border-radius: 8px;     /* <-- Rounded corners */
        display: inline-block;
    }
</style>
    <header class="ltn__header-area ltn__header-5 ltn__header-transparent-- gradient-color-4---">
        <!-- ltn__header-top-area start -->
        {{--<div class="ltn__header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li><a href="locations.html"><i class="icon-placeholder"></i> 15/A, Nest Tower, NYC</a></li>
                                <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> info@webmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="top-bar-right text-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li>
                                        <!-- ltn__language-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                            <ul>
                                                <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                    <ul>
                                                        <li><a href="#">Arabic</a></li>
                                                        <li><a href="#">Bengali</a></li>
                                                        <li><a href="#">Chinese</a></li>
                                                        <li><a href="#">English</a></li>
                                                        <li><a href="#">French</a></li>
                                                        <li><a href="#">Hindi</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- ltn__social-media -->
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                
                                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- ltn__header-top-area end -->

        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area  ltn__sticky-bg-white ltn__logo-right-menu-option plr--9---">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo-wrap">
                            <div class="site-logo">
                                <a href="{{ route('home') }}"><img
                                        src="{{ route('imagecache', ['template'=>'original','filename' => $ws->logo_alt()]) }}"
                                        alt="{{ $ws->website_title ?? '' }}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col header-menu-column menu-color-white---">
                        <div class="header-menu d-none d-xl-block">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About</a></li>
                                        <li><a href="{{ route('shop') }}">Shop</a> </li>
                                        <li><a href="{{ route('news') }}">News</a></li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="ltn__header-options ltn__header-options-2 mb-sm-20">
                        <!-- header-search-1 -->
                        <div class="header-search-wrap">
                            <div class="header-search-1">
                                <div class="search-icon">
                                    <i class="icon-search for-search-show"></i>
                                    <i class="icon-cancel  for-search-close"></i>
                                </div>
                            </div>
                            <div class="header-search-1-form">
                                <form method="get" action="{{ route('shop') }}">
                                    <input type="text" name="search" value="" placeholder="Search here..." />
                                    <button type="submit">
                                        <span><i class="icon-search"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- user-menu -->
                        <div class="ltn__drop-menu user-menu">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-user"></i></a>
                                    <ul>
                                        @if(Auth::check())
                                        @php $user = auth()->user(); @endphp
                                        @if ($user->hasRole('admin'))
                                        <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                        @endif
                                        <li><a href="{{ route('user.dashboard') }}">Member Dashboard</a></li>
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">Wishlist</a></li>
                                        <li><a href="{{ route('logout') }}">Log out</a></li>
                                        @else
                                        <li><a href="{{ route('login') }}">Log in</a></li>
                                        <li><a href="{{ route('login') }}">Register</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- mini-cart -->
                        <div class="mini-cart-icon">
                            <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                <i class="icon-shopping-cart"></i>
                                <sup id="cart-count">{{ $cartCount ?? 0 }}</sup>
                            </a>
                        </div>
                        <div class="special-link d-none d-xl-block ms-3"><a href="{{ route('contact') }}">Help Desk</a></div>
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) ">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-middle-area end -->
    </header>
<!-- Mini-cart content -->
<div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <span class="ltn__utilize-menu-title">Cart</span>
            <button class="ltn__utilize-close">×</button>
        </div>

        <div class="mini-cart-product-area ltn__scrollbar">
            @forelse($cartItems as $item)
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="{{ route('productDetails', $item->product->slug) }}">
                        <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $item->product->fi()]) }}" alt="{{ $item->product->name_en }}">
                    </a>
                    <span class="mini-cart-item-delete ">
                        <i class="icon-cancel cart-product-remove"  data-id="{{ $item->id }}"></i>
                    </span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="{{ route('productDetails', $item->product->slug) }}">{{ $item->product->name_en }}</a></h6>
                    <span class="mini-cart-quantity">{{ $item->quantity }} x {{ number_format($item->product->final_price, 2) }} ৳</span>
                </div>
            </div>
            @empty
            <p class="text-center">Your cart is empty!</p>
            @endforelse
        </div>

        <div class="mini-cart-footer">
            <div class="mini-cart-sub-total">
                <h5>Subtotal: <span>{{ number_format($cartItems->sum(fn($i) => $i->quantity * $i->product->final_price), 2) }} ৳</span></h5>
            </div>
            <div class="btn-wrapper">
                <a href="{{ route('new.checkout') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                {{--<a href="{{ route('new.checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>--}}
            </div>
            <!-- <p>Free Shipping on All Orders Over $100!</p> -->
        </div>
    </div>
</div>
    <!-- Utilize Cart Menu End -->

    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="index.html"><img src="img/logo.png" alt="Logo"></a>
                </div>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="ltn__utilize-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="ltn__utilize-menu">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{ route('news') }}">News</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>

                    @if(Auth::check())
                    @php $user = auth()->user(); @endphp
                    @if ($user->hasRole('admin'))
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    @endif
                    <li>
                        <a href="#" title="My Account">
                            <span class="utilize-btn-icon">
                                <i class="far fa-user"></i>
                            </span>
                            Member Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Wishlist">
                            <span class="utilize-btn-icon">
                                <i class="far fa-heart"></i>
                                <sup>3</sup>
                            </span>
                            Wishlist
                        </a>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                    @endif

                </ul>
            </div>
            <div class="ltn__social-media-2">
                <ul>
                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>

    <div class="ltn__utilize-overlay"></div>
    @push('js')
    <script>
$(document).ready(function() {
    let isUpdating = false; // Flag to prevent multiple simultaneous updates

    // Remove item functionality
    $(document).on('click', '.cart-product-remove', function(e) {
        e.preventDefault();
        var cartId = $(this).data('id');

        if (!cartId) return;

        $.ajax({
            url: '/cart/remove/item/' + cartId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.status) {
                    location.reload();
                } else {
                    alert(res.message);
                }
            },
            error: function(err) {
                alert(err.responseJSON?.message || 'Something went wrong!');
            }
        });
    });

    // Function to update cart totals
    function updateCartTotals() {
        let subtotal = 0;

        // Calculate subtotal from all items
        $('.cart-product-subtotal').each(function() {
            let val = parseFloat($(this).text().replace(/,/g, '').replace(' ৳', '')) || 0;
            subtotal += val;
        });

        // Update displayed totals
        $('#cart-subtotal').text(subtotal.toFixed(2) + ' ৳');
        $('#order-total strong').text(subtotal.toFixed(2) + ' ৳');
    }

    // Handle quantity changes - use only 'change' event
    $(document).on('change', '.cart-plus-minus-box', function() {
        if (isUpdating) return; // Prevent multiple simultaneous updates

        isUpdating = true;

        let $this = $(this);
        let cartId = $this.data('id');
        let quantity = parseInt($this.val()) || 1;

        // Ensure minimum quantity
        if (quantity < 1) {
            quantity = 1;
            $this.val(1);
        }

        // Get price from data attribute
        let price = parseFloat($('#cart-item-' + cartId + ' .cart-product-price').data('price')) || 0;

        // Calculate new subtotal for this item
        let newSubtotal = (quantity * price).toFixed(2);
        $('#subtotal-' + cartId).text(newSubtotal + ' ৳');

        // Update cart totals
        updateCartTotals();

        // Send AJAX request to update quantity in backend
        $.ajax({
            url: '/cart/update-quantity/' + cartId,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                quantity: quantity
            },
            success: function(res) {
                isUpdating = false;
                if (!res.status) {
                    alert(res.message);
                }
            },
            error: function(err) {
                isUpdating = false;
                console.log('Error updating quantity');
                alert('Error updating quantity. Please try again.');
            }
        });
    });

    // Alternative: If you want to use input for immediate feedback but prevent duplicates
    // $(document).on('input', '.cart-plus-minus-box', function() {
    //     clearTimeout(window.quantityTimeout);
    //     window.quantityTimeout = setTimeout(() => {
    //         $(this).trigger('change');
    //     }, 500);
    // });

    // If you have plus/minus buttons (add these to your HTML if needed)
    $(document).on('click', '.qtybutton', function() {
        let $input = $(this).closest('.cart-plus-minus').find('.cart-plus-minus-box');
        let currentVal = parseInt($input.val()) || 1;

        if ($(this).hasClass('inc')) {
            $input.val(currentVal + 1).trigger('change');
        } else if ($(this).hasClass('dec') && currentVal > 1) {
            $input.val(currentVal - 1).trigger('change');
        }
    });
});
    </script>

    <script>
$(document).ready(function() {
    let lastScrollTop = 0;
    let header = $('.ltn__header-middle-area');
    let headerContainer = $('.ltn__header-area');
    let headerHeight = header.outerHeight();

    $(window).on('scroll', function() {
        let st = $(this).scrollTop();

        if (st > 200) {
            headerContainer.css('height', headerHeight);
            if (st > lastScrollTop) {
                // Scrolling down
                header.removeClass('sticky-active');
            } else {
                // Scrolling up
                header.addClass('sticky-active');
            }
        } else {
            headerContainer.css('height', 'auto');
            header.removeClass('sticky-active');
        }

        lastScrollTop = st;
    });

    $(window).on('resize', function(){
        headerHeight = header.outerHeight();
    });
});
    </script>
    <script>
    $(document).ready(function() {
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
                if (qty < 1) {
                    // If quantity is less than 1, remove the item
                    $('.cart-item[data-cart="' + cartId + '"] .deleteCartItem').click();
                    return;
                }
            }
    
            $btn.prop('disabled', true); // prevent double click
    
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    cart: cartId,
                    new_qty: qty,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    if (res.status) {
                        refreshCartTotals();
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
    
        $(document).on("click", ".deleteCartItem", function () {
            let btn = $(this);
            $.post(btn.data("url"), {_token: '{{ csrf_token() }}'}, function (res) {
                if (res.status) {
                    refreshCartTotals();
                }
            }).fail(() => {
                Swal.fire("Error", "Cart item could not be removed.", "error");
            });
        });
    
        function refreshCartTotals() {
            location.reload();
        }
    });
    </script>
    @endpush