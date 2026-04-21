@extends('frontend.layouts.master')

@push('css')
<!-- Page-specific CSS -->
@endpush

@section('content')

@php
    $me = Auth::user();
    $dl = $me->locations()->first();
    $cartTotal = $cart_total ?? $cartItems->sum(fn($item) => $item->price * $item->quantity);
@endphp

<section class="my-0 section">
    <div class="container py-3">

        @if($cartItems->isEmpty())
            <div class="p-4 text-center">
                <p class="text-muted fs-5 py-5">Your cart is empty 🛒</p>
            </div>
        @else
            <div class="row g-4" id="checkoutMainWrapper">

                <!-- Left Column: Cart Items -->
                <div class="col-lg-7">
                    <div class="card shadow-sm border">
                        @include('frontend.home.includes.checkout-cart-items', ['cartItems' => $cartItems])
                    </div>
                </div>

                <!-- Right Column: Delivery & Payment -->
                <div class="col-lg-5 d-flex flex-column gap-3">

                    <!-- Delivery Form -->
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            @include('frontend.home.includes.checkout-delivery-form')

                            <!-- Flash Messages -->
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                    </div>

                    

                    <!-- Payment Method -->
                    <div class="card shadow-sm border">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 d-flex align-items-center gap-2">
                                <i class="fas fa-credit-card"></i> Payment Method
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="checkoutForm" method="POST" action="">
                                @csrf
                                <select id="paymentMethodSelect" name="payment_method" class="form-select mb-2">
                                    <option value="cod" selected>Cash on Delivery</option>
                                    <option value="online">Online Payment</option>
                                </select>

                                <button type="submit" class="btn btn-success w-100 fw-semibold" @if(!$dl) disabled @endif>
                                    Proceed to Pay <i class="fa fa-arrow-right ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    

                </div>
            </div>
        @endif

    </div>
</section>

@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.getElementById('checkoutForm');
    const paymentSelect = document.getElementById('paymentMethodSelect');
    const paymentNote = document.getElementById('paymentNote');

    const codRoute = "{{ route('codOrderStore') }}";
    const onlineRoute = "{{ url('order/store') }}";

    // Update note
    paymentSelect.addEventListener('change', () => {
        paymentNote.textContent = paymentSelect.value === 'cod'
            ? 'Pay in cash during product delivery.'
            : 'You will be redirected to the online payment gateway.';
    });

    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault(); // stop normal submit

        // Set form action dynamically
        checkoutForm.action = paymentSelect.value === 'cod' ? codRoute : onlineRoute;

        Swal.fire({
            title: 'Confirm Order',
            text: "Do you want to place this order?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, place order',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed) {
                checkoutForm.submit(); // normal submit now
            }
        });
    });
});

</script>
@endpush
