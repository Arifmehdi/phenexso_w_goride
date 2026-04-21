<style>
            /* Compact Copyright Area Styles */
.ltn__copyright-area {
    padding: 15px 70px !important; /* Reduced from default padding */
}

.ltn__copyright-area p {
    margin-bottom: 0;
    line-height: 1.4;
    font-size: 14px;
}

.ltn__copyright-area .row {
    align-items: center;
}

/* Extra compact version - use this for even less height */
.ltn__copyright-area.compact {
    padding: 10px 0 !important;
}

.ltn__copyright-area.compact p {
    font-size: 13px;
    line-height: 1.2;
}

/* Mobile responsive */
@media (max-width: 767px) {
    .ltn__copyright-area {
        padding: 12px 0 !important;
    }
    
    .ltn__copyright-area p {
        font-size: 13px;
        text-align: center !important;
    }
    
    .ltn__copyright-area .col-md-6 {
        margin-bottom: 5px;
    }
    
    .ltn__copyright-area .col-md-6:last-child {
        margin-bottom: 0;
    }
}

</style>
<!-- FOOTER AREA START -->
<footer class="ltn__footer-area">
    <div class="footer-top-area section-bg-1 plr--5">
        <div class="container-fluid">
            <div class="row">

                <!-- About + Address -->
                {{--<div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo">
                            <div class="site-logo">
                                <img src="{{ route('imagecache', ['template'=>'original','filename' => $ws->logo_alt()]) }}" alt="{{ $ws->website_title ?? '' }}">
                            </div>
                        </div>
                        <p>Hubli connects farmers, distributors, and businesses through a smart supply chain network across Bangladesh.</p>

                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>Banani, Dhaka 1213, Bangladesh</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="tel:+8801700000000">+880 1700-000000</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="mailto:info@hubli.com">info@hubli.com</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>--}}

                <!-- Company Links -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Company</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('shop') }}">Our Products</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Services</h4>
                        <div class="footer-menu">
                            <ul>
                                {{--<li><a href="#">Order Tracking</a></li>--}}
                                <li><a href="#">Wishlist</a></li>
                                {{--<li><a href="#">My Account</a></li>--}}
                                <li><a href="#">Return Policy</a></li>
                                {{--<li><a href="#">Delivery Info</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Customer Care -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Customer Care</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">FAQ</a></li>
                                {{--<li><a href="#">Support Center</a></li>--}}
                                <li><a href="#">Report Issue</a></li>
                                {{--<li><a href="{{ route('contact') }}">Contact Support</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget">
                        <h4 class="footer-title">Social & Media</h4>
                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        {{--<p>Subscribe to get updates, new products, and special offers.</p>

                        <div class="footer-newsletter">
                            <form action="#" method="post" style="display: flex; gap: 10px;">
                                <input type="email" name="email" placeholder="Email*" 
                                    style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                                <button class="theme-btn-1 btn" type="submit" 
                                        style="padding: 10px 20px; border-radius: 5px;">
                                    <i class="fas fa-location-arrow"></i>
                                </button>
                            </form>
                        </div>--}}


                        {{--<h5 class="mt-30">We Accept</h5>--}}
                        <div class="mt-20"><img src="{{ asset('frontend/img/icons/payment-4.png') }}" alt="Payment"></div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="ltn__copyright-area ltn__copyright-2 section-bg-2 ltn__border-top-2--- plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <p>© {{ date('Y') }} Hubli Bangladesh – All Rights Reserved.</p>
                </div>
                <div class="col-md-6 col-12 text-end">
                    <p>Developed by <strong>Phenexsoft</strong></p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- FOOTER AREA END -->
<!-- QUICK VIEW MODAL -->
<!-- <div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div id="quickViewContent" class="text-center py-5">
                    <p>Loading...</p>
                </div>
                
            </div>
            
        </div>
    </div>
</div> -->
    <!-- MODAL AREA START (Quick View Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quickViewModal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item" id="quickViewContent">
                                <p>Loading...</p>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

    <!-- MODAL AREA START (Add To Cart Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" id="cart_product_id">
                                        <div class="modal-product-img">
                                            <img id="cart_modal_img" src="" alt="Product">
                                            <!-- <img src="{{asset('frontend/img/product/1.png') }}" alt="#"> -->
                                        </div>
                                         <div class="modal-product-info">
                                            


                                             <!-- <h5><a href="product-details.html">Vegetables Juices</a></h5> -->
                                             <!-- <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Cart</p> -->
                                             <h5 id="cart_modal_name"></h5>
                                             <p class="added-cart">
                                                 <i class="fa fa-check-circle"></i> <span id="cart_modal_message"></span>
                                             </p>         
                                            <div class="btn-wrapper">
                                                <a href="{{ route('new.checkout') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                {{--<a href="{{ route('checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>--}}
                                            </div>
                                         </div>
                                         <!-- additional-info -->
                                         <div class="additional-info d-none---">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use (LoveBroccoli) discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="{{asset('frontend/img/icons/payment.png') }}" alt="#">
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

    <!-- MODAL AREA START (Wishlist Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="modal-product-img">
                                            <img src="{{ asset('frontend/img/product/7.png') }}" alt="#">
                                        </div>
                                         <div class="modal-product-info">
                                            <h5><a href="product-details.html">Vegetables Juices</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                            <div class="btn-wrapper">
                                                <a href="{{ route('wishlist.index')}}" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                            </div>
                                         </div>
                                         <!-- additional-info -->
                                         <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="{{ asset('frontend/img/icons/payment.png') }}" alt="#">
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).on("click", ".quick-view-btn", function (e) {
    e.preventDefault();
    
    let productId = $(this).data("id");
    $("#quickViewContent").html("<p>Loading...</p>");
    $("#quickViewModal").modal("show");

    $.ajax({
        url: "{{ route('quick.view') }}",
        type: "GET",
        data: { id: productId },
        success: function (response) {

            $("#quickViewContent").html(`
                <div class="row" >
                    <div class="col-lg-6 col-12">
                        <div class="modal-product-img">
                            <img src="${response.image}" alt="#">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="modal-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                    <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                </ul>
                            </div>
                            <h3>${response.name}</h3>
                            <div class="product-price">
                                <span>${response.price} ৳</span>
                                ${response.old_price ? `<del>${response.old_price} ৳</del>` : ""}
                            </div>
                            <div class="modal-product-meta ltn__product-details-menu-1">
                                <ul>
                                    <li>
                                        <strong>Categories:</strong> 
                                        <span>
                                            <a href="#">Parts</a>
                                            <a href="#">Car</a>
                                            <a href="#">Seat</a>
                                            <a href="#">Cover</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__product-details-menu-2">
                                <ul>
                                    <li>
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                                            <div class="inc qtybutton">+</div>
                                        </div>

                                    </li>
                                    <li>
                                        <a href="#" class="theme-btn-1 btn btn-effect-1 add-to-cart-btn" title="Add to Cart" data-id="${response.id}">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>ADD TO CART</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__product-details-menu-3">
                                <ul>
                                    <li>
                                        <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i>
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="fas fa-exchange-alt"></i>
                                            <span>Compare</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="ltn__social-media">
                                <ul>
                                    <li>Share:</li>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            `);

        }
    });

});

$(document).on("click", ".qtybutton", function () {
    let $button = $(this);
    let oldValue = parseInt($button.parent().find("input").val());

    if ($button.hasClass("inc")) {
        var newVal = oldValue + 1;
    } else {
        var newVal = oldValue > 1 ? oldValue - 1 : 1;
    }

    $button.parent().find("input").val(newVal);
});
</script>
