@extends('website.layouts.master')

@section('title', 'Wishlist - Hubli')

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
    <x-breadcrumb title="Wishlist" pageName="Wishlist" bgImage="frontend/img/bg/9.jpg" />
    <!-- BREADCRUMB AREA END -->

    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <!-- <th class="cart-product-quantity">Quantity</th> -->
                                    <th class="cart-product-subtotal">Action</th>
                                    </tr>

                                </thead>
                                    <tbody>
                                    @forelse ($wishlists as $w)
                                        <tr>
                                            <td class="cart-product-remove txt-danger remove-wishlist" data-id="{{ $w->id }}">x</td>

                                            <td>
                                                <img src="{{ route('imagecache', ['template'=>'small', 'filename'=>$w->product->fi()]) }}" width="80">
                                            </td>

                                            <td class="cart-product-info">
                                                <h4>
                                                    <a href="#" title="{{$w->product->name_en}}">{{ Str::limit($w->product->name_en, 20) }}</a>
                                                </h4>
                                            </td>

                                            <td>{{ $w->product->final_price }} ৳</td>

                                            <td class="cart-product-add-cart">
                                                <a class="submit-button-1" href="#" title="Add to Cart"
                                                    data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                    Add to Cart
                                                </a>
                                            </td>
                                        </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <h4>No wishlist products found</h4>

                                            <a href="{{ route('shop') }}" 
                                            class="btn btn-success mt-3"
                                            style="padding: 10px 25px; font-size: 16px;">
                                                Go to Shop
                                            </a>
                                        </td>
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
    <!-- WISHLIST AREA START -->

    <!-- FEATURE AREA START ( Feature - 3) -->
    <x-footer-feature />
    <!-- FEATURE AREA END -->
@endsection
@push('js')
<script>
$(document).on('click','.remove-wishlist',function(){
    var id = $(this).data('id');

    $.post("{{ route('wishlist.remove') }}", {
        id: id,
        _token: "{{ csrf_token() }}"
    }, function(res){
        location.reload();
    })
});
</script>
@endpush