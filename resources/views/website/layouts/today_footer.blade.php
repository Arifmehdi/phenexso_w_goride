    <style>
        /* Compact Copyright Area Styles */
.ltn__copyright-area {
    padding: 15px 15px !important; /* Reduced from default padding */
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


.footer-menu ul li {
    margin-bottom: 6px;
}

.footer-title {
    font-size: 18px;
    margin-bottom: 12px;
    font-weight: 600;
}

.footer-social ul li a {
    font-size: 18px;
    display: inline-block;
    padding: 6px 10px;
    background: #ffffff22;
    border-radius: 6px;
    transition: 0.3s;
}

.footer-social ul li a:hover {
    background: #fff;
    color: #000;
}

.footer-map iframe {
    box-shadow: 0 3px 10px rgb(0 0 0 / 20%);
}

    </style>


<!-- FOOTER AREA START -->
<footer class="ltn__footer-area">
<div class="footer-top-area section-bg-1 plr--5 py-60">
    <div class="container-fluid">
        <div class="row g-4">

            <!-- Map Left Side -->
            <div class="col-xl-4 col-lg-4">
                <div class="footer-widget">

                    <!-- Google Map -->
                    <div class="footer-map mb-20">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.902078785858!2d90.39135781543182!3d23.750876394591774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b894cf7199f5%3A0x1e4b028aaf77e651!2sDhaka!5e0!3m2!1sen!2sbd!4v000000"
                            width="100%" height="200" style="border:0;border-radius:10px;" 
                            allowfullscreen loading="lazy">
                        </iframe>
                    </div>

                    <!-- Social Icons -->
                    <div class="ltn__social-media mt-20">
                        <x-blog-media />
                    </div>

                </div>
            </div>

            <!-- Menu Right Side -->
            <div class="col-xl-8 col-lg-8">
                <div class="row g-4">

                    <!-- Company -->
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Company</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('news') }}">News</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Services</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Return Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Care -->
                    <div class="col-xl-4 col-md-6 col-sm-6">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Customer Care</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Report Issue</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


    <!-- Copyright -->
    <div class="ltn__copyright-area section-bg-2 ltn__border-top-2 plr--5 py-20">
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
                                                <a href="{{ route('cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                <a href="{{ route('checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
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
                                        <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
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

});
</script>
