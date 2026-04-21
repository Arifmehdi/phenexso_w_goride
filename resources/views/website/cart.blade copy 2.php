@extends('website.layouts.master')

@section('title', 'Cart - '. env('APP_NAME') )

@section('content')
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
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4"><strong>Checkout</strong></h1>
        </div>
    </div>

    @if($cartItems->isEmpty())
        <p class="text-center text-muted py-5 fs-5">Your cart is empty ðŸ›’</p>
    @else 
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">

                   {{-- @include('frontend.home.includes.new_checkout-delivery-form')--}}

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="row">
                        <header class="py-2 px-3" style="background: #2D529F;">
                            <h2 class="text-white h5 d-flex align-items-center gap-2 mb-0">
                                <i class="fas fa-shipping-fast"></i> Shipping Address
                            </h2>
                        </header>
                        <div class="col-12 mt-3">
                            <div >
                                {{-- <p><b>Name:</b> {{ $dl ? $dl->name : Auth::user()->name }}</p>
                                <p><b>Email:</b> {{ $dl ? $dl->email : Auth::user()->email }}</p>
                                <p><b>Phone:</b> {{ $dl ? $dl->mobile : Auth::user()->mobile }}</p>
                                <p><b>Address:</b> {{ $dl ? $dl->address_title : old('address_title') }}</p> --}}
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <form>
                                            <div class="mb-3">
                                                <label for="billing-name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $dl ? $dl->name : (Auth::user() ? Auth::user()->name : '') }}" placeholder="Enter full name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="billing-email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $dl ? $dl->email : (Auth::user() ? Auth::user()->email : '') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="billing-phone" class="form-label">Phone</label>
                                                <input type="tel" 
                                                    class="form-control" 
                                                    id="mobile" 
                                                    name="mobile" 
                                                    value="{{ $dl ? $dl->mobile : (Auth::user() ? Auth::user()->mobile : '') }}" 
                                                    placeholder="e.g. 01XXXXXXXXX"
                                                    maxlength="11"
                                                    pattern="\d{11}"
                                                    title="Please enter exactly 11 digits">
                                            </div>

                                            <div class="mb-3">
                                                <label for="billing-address" class="form-label">Address</label>
                                                <textarea class="form-control" id="billing-address" name="billing_address" rows="3" placeholder="e.g. Home, Office, Momâ€™s House" value="{{ $dl ? $dl->address_title : old('address_title') }}">{{ $dl ? $dl->address_title : old('address_title') }}</textarea>
                                            </div>

                                            <div class="mb-3" style="display:none">
                                                <label for="district" class="form-label">District</label>
                                                <select class="form-select" id="district" name="district" required style="font-size: 13px" disabled>
                                                    <option selected disabled>Select a district</option>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" @if($district->name == 'Dhaka') selected @endif>{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="thana" class="form-label">Thana</label>
                                                <select class="form-select" id="thana" name="thana" required style="font-size: 13px">
                                                    <option selected disabled>Select a thana</option>
                                                </select>
                                            </div>
            
        
                                            <!-- Shipping Options -->
                                            <div id="shipping-options-container" style="display: none;">
                                                <div class="col-12 mt-3">
                                                    <h6 class="fw-semibold">Select Shipping Method:</h6>
                                                    <div id="shipping-options">
                                                        <!-- Shipping options will be loaded here dynamically -->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    {{--<div class="col-md-6 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ship-to-different-address">
                                            <label class="form-check-label" for="ship-to-different-address">
                                                Ship to different address
                                            </label>
                                        </div>
                                        <div id="shipping-details" style="display: none;">
                                            <h5 class="mt-4">Shipping Details</h5>
                                            <form>
                                                <div class="mb-3">
                                                    <label for="shipping-name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="shipping-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shipping-email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="shipping-email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shipping-phone" class="form-label">Phone</label>
                                                    <input type="tel" class="form-control" id="shipping-phone">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shipping-address" class="form-label">Address</label>
                                                    <textarea class="form-control" id="shipping-address" rows="3"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mt-4">
                                            <h5>Delivery Time</h5>
                                            <p>Inside Dhaka: 1 day</p>
                                            <p>Outside Dhaka: 2 days</p>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('frontend.home.includes.checkout-cart-items', ['cartItems' => $cartItems])
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payment Method</h5>

                    <!-- âœ… Form should wrap ALL payment methods -->
                    <form id="checkoutForm" method="POST" action="">
                        @csrf
                        <input type="hidden" name="shipping_price" id="hidden-shipping-price" value="0">
                        <div class="accordion" id="payment-accordion">

                            <!-- Direct Cash -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="direct-cash-heading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#direct-cash-collapse"
                                        aria-expanded="false" aria-controls="direct-cash-collapse">
                                        <div class="form-check">
                                            <input class="form-check-input paymentMethodSelect" type="radio"
                                                value="cod" name="payment-method" id="direct-cash-payment">
                                            <label class="form-check-label" for="direct-cash-payment">
                                                Cash on Delivery
                                            </label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="direct-cash-collapse" class="accordion-collapse collapse"
                                    aria-labelledby="direct-cash-heading" data-bs-parent="#payment-accordion">
                                    <div class="accordion-body">
                                        Pay with cash upon delivery.
                                    </div>
                                </div>
                            </div>

                            <!-- Cash on Delivery -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="cash-on-delivery-heading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#cash-on-delivery-collapse"
                                        aria-expanded="false" aria-controls="cash-on-delivery-collapse">
                                        <div class="form-check">
                                            <input class="form-check-input paymentMethodSelect" type="radio"
                                                value="online" name="payment-method" id="cash-on-delivery">
                                            <label class="form-check-label" for="cash-on-delivery">
                                                Online Payment
                                            </label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="cash-on-delivery-collapse" class="accordion-collapse collapse"
                                    aria-labelledby="cash-on-delivery-heading" data-bs-parent="#payment-accordion">
                                    <div class="accordion-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="bkash-tab" data-bs-toggle="tab" data-bs-target="#bkash" type="button" role="tab" aria-controls="bkash" aria-selected="true">bKash</button>
                                            </li>
                                            {{--<li class="nav-item" role="presentation">
                                                <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="bank" aria-selected="false">Bank</button>
                                            </li>--}}
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="bkash" role="tabpanel" aria-labelledby="bkash-tab">
                                                <div class="card-body">
                                                    <p><strong>bKash Number:</strong> 01790552864 (Merchant)</p>
                                                </div>
                                            </div>
                                            {{--<div class="tab-pane fade  " id="bank" role="tabpanel" aria-labelledby="bank-tab">
                                                <div class="card-body">
                                                    <p><strong>A/C Number:</strong> </p>
                                                    <p><strong>A/C Name:</strong> </p>
                                                </div>
                                            </div>--}}

                                        </div>
                                        <div id="online-payment-details" style="display: none;">
                                            <div class="mb-3">
                                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                                <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                                            </div>
                                        </div>
                                        <p class="mt-3">{{ __('Bkash Message') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- order note  -->
                                <div >
                                        <label for="order-note" class="form-label mt-2">Order Note (Optional)</label>
                                        <textarea name="order_note" id="order_note" rows="4" class="form-control" placeholder="Notes about your order, e.g.  special notes for delivery"></textarea>
                                </div>
                        </div>
                    </form>

                    <!-- Checkbox -->
                    {{--<div class="form-check mb-3 mt-2">
                        <input class="form-check-input" type="checkbox" id="receive-emails">
                        <p>By placing your order, you agree to our <a href="{{ route('terms') }}">Terms & Conditions</a>, <a href="{{ route('return-policy') }}">Return & Refund Policy</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</p>
                        <!-- <label class="form-check-label" for="receive-emails">
                            I would like to receive exclusive emails with discounts and product information
                        </label>
                        <label for="">
                            Shipment will be made within 24 hours of order confirmation. However, if the product is not in stock, there may be a delay in shipment.
                        </label> -->
                    </div>--}}

                    <!-- <div class="mb-3">
                        
                    </div> -->

                    <!-- Proceed Button -->
                    <button class="btn w-100 mt-3 text-white" id="proceed-to-pay-button" style="background:#2D529F;" disabled>
                        Proceed to Pay
                    </button>
                </div>
            </div>
        </div>

    </div>
    @endif
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.getElementById('checkoutForm');
    const paymentRadios = document.querySelectorAll('.paymentMethodSelect');
    const emailCheckbox = document.getElementById('receive-emails');
    const proceedBtn = document.getElementById('proceed-to-pay-button');
    const shippingToggle = document.getElementById('ship-to-different-address');
    const shippingDetails = document.getElementById('shipping-details');

    // Elements for address change functionality
    const changeAddressLink = document.getElementById('change-address-link');
    const addressSelectionForm = document.getElementById('address-selection-form');

    // Elements for dynamic address selection and shipping options
    const districtSelect = document.getElementById('district');
    const thanaSelect = document.getElementById('thana');
    const zipInput = document.getElementById('zip');
    const shippingOptionsContainer = document.getElementById('shipping-options-container');
    const selectedAddressElement = document.getElementById('selected-address');

    const codRoute = "{{ route('codOrderStore') }}";
    const onlineRoute = "{{ url('order/store') }}";

    // âœ… Enable/disable Proceed button based on conditions
    function toggleProceedButton() {
        const paymentSelected = document.querySelector('.paymentMethodSelect:checked');
        // const emailChecked = emailCheckbox ? emailCheckbox.checked : false;
        
        if (proceedBtn) {
            proceedBtn.disabled = !(paymentSelected);
        }
    }

    // âœ… Payment method change
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            toggleProceedButton();
            const onlinePaymentDetails = document.getElementById('online-payment-details');
            const transactionIdInput = document.getElementById('transaction_id');
            if (radio.value === 'online' && radio.checked) {
                onlinePaymentDetails.style.display = 'block';
                transactionIdInput.required = true;
            } else {
                onlinePaymentDetails.style.display = 'none';
                transactionIdInput.required = false;
            }
        });
    });

    // âœ… Email checkbox change
    if (emailCheckbox) {
        emailCheckbox.addEventListener('change', toggleProceedButton);
    }

    // âœ… Shipping toggle (for "Ship to different address" checkbox)
    if (shippingToggle && shippingDetails) {
        shippingToggle.addEventListener('change', function () {
            shippingDetails.style.display = this.checked ? 'block' : 'none';
        });
    }

    // âœ… Change address link click - FIXED
    if (changeAddressLink && addressSelectionForm) {
        changeAddressLink.addEventListener('click', function (e) {
            e.preventDefault();
            console.log('Change address clicked');
            
            if (addressSelectionForm.style.display === 'none' || addressSelectionForm.style.display === '') {
                addressSelectionForm.style.display = 'block';
            } else {
                addressSelectionForm.style.display = 'none';
            }
        });
    }

    // âœ… District change â†’ load thanas and shipping methods
    if (districtSelect && thanaSelect) {
        function loadThanas(districtId, selectedThanaId = null) {
            if (districtId) {
                fetch(`/get-upazilas/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        thanaSelect.innerHTML = '<option selected disabled>Select a thana</option>';
                        data.forEach(upazila => {
                            const option = document.createElement('option');
                            option.value = upazila.id;
                            option.textContent = upazila.name;
                            if (selectedThanaId && selectedThanaId == upazila.id) {
                                option.selected = true;
                            }
                            thanaSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        thanaSelect.innerHTML = '<option selected disabled>Error loading thanas</option>';
                    });
            }
        }

        function loadShippingMethods(upazilaId) {
            if (upazilaId) {
                fetch(`/get-shipping-methods/${upazilaId}`)
                    .then(response => response.json())
                    .then(data => {
                        const shippingOptionsContainer = document.getElementById('shipping-options');
                        shippingOptionsContainer.innerHTML = '';
                        data.forEach((method, index) => {
                            const div = document.createElement('div');
                            div.classList.add('form-check');
                            div.innerHTML = `
                                <input class="form-check-input" type="radio" name="shipping-option" id="shipping-option-${method.id}" value="${method.price}" ${index === 0 ? 'checked' : ''}>
                                <label class="form-check-label" for="shipping-option-${method.id}">
                                    ${method.name} (${method.min_weight} - ${method.max_weight} Kg): ${method.price}à§³
                                </label>
                            `;
                            shippingOptionsContainer.appendChild(div);
                        });

                        const shippingOptionInputs = document.querySelectorAll('input[name="shipping-option"]');
                        if (shippingOptionInputs) {
                            shippingOptionInputs.forEach(option => {
                                option.addEventListener('change', updateTotals);
                            });
                        }

                        document.getElementById('shipping-options-container').style.display = 'block';
                        updateTotals(); // Update totals after loading shipping methods
                    })
                    .catch(() => {
                        const shippingOptionsContainer = document.getElementById('shipping-options');
                        shippingOptionsContainer.innerHTML = '<p>Error loading shipping methods.</p>';
                        document.getElementById('shipping-options-container').style.display = 'block';
                    });
            }
        }

        districtSelect.addEventListener('change', () => {
            loadThanas(districtSelect.value);
        });

        thanaSelect.addEventListener('change', () => {
            loadShippingMethods(thanaSelect.value);
        });

        @if($location && $location->district_id)
            loadThanas("{{ $location->district_id }}", "{{ $location->upazila_id }}");
            loadShippingMethods("{{ $location->upazila_id }}");
        @endif
    }

    // âœ… Update totals function
    function updateTotals() {
        const subtotalElement = document.querySelector('.subtotal');
        const discountElement = document.querySelector('.discount');
        const shippingPriceElement = document.getElementById('shipping-price');
        const payableElement = document.querySelector('.payable');
        const shippingDiscountContainer = document.getElementById('shipping-discount-container');
        const shippingDiscountElement = document.getElementById('shipping-discount');

        if (subtotalElement && discountElement && payableElement) {
            const subtotal = parseFloat(subtotalElement.getAttribute('data-value')) || 0;
            const discount = parseFloat(discountElement.getAttribute('data-value')) || 0;

            const selectedShipping = document.querySelector('input[name="shipping-option"]:checked');
            let shippingCost = selectedShipping ? parseFloat(selectedShipping.value) : 0;
            let shippingDiscount = 0;

            if (subtotal >= 500) {
                shippingDiscount = shippingCost;
                shippingCost = 0;
                if (shippingDiscount > 0) {
                    shippingDiscountContainer.style.display = 'flex';
                    shippingDiscountElement.textContent = `-Tk. ${shippingDiscount.toFixed(2)}`;
                } else {
                    shippingDiscountContainer.style.display = 'none';
                }
            } else {
                shippingDiscountContainer.style.display = 'none';
            }

            const grandTotal = subtotal - discount + shippingCost;

            if (shippingPriceElement) {
                shippingPriceElement.textContent = `Tk. ${shippingCost.toFixed(2)}`;
                shippingPriceElement.setAttribute('data-value', shippingCost);
            }

            const hiddenShippingPriceInput = document.getElementById('hidden-shipping-price');
            if (hiddenShippingPriceInput) {
                hiddenShippingPriceInput.value = shippingCost;
            }

            payableElement.textContent = `Tk. ${grandTotal.toFixed(2)}`;
        }
    }

    // Function to refresh cart totals from the server
    function refreshCartTotals() {
        fetch('/get-cart-totals') // Assuming this route returns { totalCartPrice: ..., totalDiscountAmount: ... }
            .then(response => response.json())
            .then(data => {
                const subtotalElement = document.querySelector('.subtotal');
                const discountElement = document.querySelector('.discount');
                const savingElement = document.querySelector('.text-center.bg-primary.text-white.rounded.py-1.fw-semibold.mb-3.small');

                if (subtotalElement) {
                    subtotalElement.setAttribute('data-value', data.totalCartPrice);
                    subtotalElement.textContent = `Tk. ${parseFloat(data.totalCartPrice).toFixed(2)}`;
                }
                if (discountElement) {
                    discountElement.setAttribute('data-value', data.totalDiscountAmount);
                    discountElement.textContent = `-Tk. ${parseFloat(data.totalDiscountAmount).toFixed(2)}`;
                }
                if (savingElement) {
                    savingElement.textContent = `You are saving Tk. ${parseFloat(data.totalDiscountAmount).toFixed(2)} in this order.`;
                }

                const cartItemsCountElement = document.querySelector('.cartItemsCount');
                if (cartItemsCountElement) {
                    cartItemsCountElement.textContent = data.cartItemsCount;
                }
                updateTotals(); // Recalculate grand total with new subtotal/discount
            })
            .catch(error => console.error('Error fetching cart totals:', error));
    }

    // // âœ… Shipping option change event - FIXED VARIABLE NAME
    // const shippingOptionInputs = document.querySelectorAll('input[name="shipping-option"]');
    // if (shippingOptionInputs) {
    //     shippingOptionInputs.forEach(option => {
    //         option.addEventListener('change', updateTotals);
    //     });
    // }

    // // âœ… Thana change â†’ update billing address
    // if (thanaSelect && districtSelect) {
    //     thanaSelect.addEventListener('change', () => {
    //         const billingAddressTextarea = document.getElementById('billing-address');
    //         const districtName = districtSelect.options[districtSelect.selectedIndex]?.text || '';
    //         const thanaName = thanaSelect.options[thanaSelect.selectedIndex]?.text || '';

    //         if (billingAddressTextarea && districtName && thanaName) {
    //             billingAddressTextarea.value = `${thanaName}, ${districtName}`;
    //         }
    //     });
    // }

    // âœ… Zip code input for showing shipping options
    if (zipInput) {
        zipInput.addEventListener('input', function() {
            const zipCode = this.value.trim();
            
            if (zipCode.length > 0) {
                // Show shipping options
                if (shippingOptionsContainer) {
                    shippingOptionsContainer.style.display = 'block';
                }
                if (selectedAddressElement) {
                    selectedAddressElement.textContent = `Shipping options available for zip code: ${zipCode}`;
                }
                
                // Update totals
                updateTotals();
            } else {
                // Hide shipping options if zip code is empty
                if (shippingOptionsContainer) {
                    shippingOptionsContainer.style.display = 'none';
                }
                if (selectedAddressElement) {
                    selectedAddressElement.textContent = 'Please enter zip code to see shipping options.';
                }
                
                // Reset to free shipping and update totals
                const freeShipping = document.getElementById('free-shipping');
                if (freeShipping) {
                    freeShipping.checked = true;
                }
                updateTotals();
            }
        });
    }

    // âœ… Proceed button click â†’ confirm order
    if (proceedBtn) {
        proceedBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const selected = document.querySelector('.paymentMethodSelect:checked');
            if (!selected) {
                Swal.fire('Error', 'Please select a payment method.', 'error');
                return;
            }

            // Validate required fields
            const name = document.getElementById('name')?.value;
            const email = document.getElementById('email')?.value;
            const mobile = document.getElementById('mobile')?.value;
            const billingAddress = document.getElementById('billing-address')?.value;
            const billingDistrictId = document.getElementById('district')?.value;
            const billingThanaId = document.getElementById('thana')?.value;

            if (!name || !email || !mobile || !billingAddress) {
                Swal.fire('Error', 'Please fill in all required shipping address fields.', 'error');
                return;
            }

            if (selected.value === 'online') {
                const transactionId = document.getElementById('transaction_id')?.value;
                if (!transactionId) {
                    Swal.fire('Error', 'Please enter the transaction ID.', 'error');
                    return;
                }
            }

            // Set form action dynamically
            checkoutForm.action = selected.value === 'cod' ? codRoute : onlineRoute;

            // Dynamically add address fields to the form before submission
            const fieldsToSubmit = {
                name: name,
                email: email,
                mobile: mobile,
                billing_address: billingAddress,
                payment_method: selected.value,
                billing_district_id : billingDistrictId,
                billing_thana_id :  billingThanaId,
                transaction_id: selected.value === 'online' ? document.getElementById('transaction_id')?.value : null,
            };

            for (const [key, value] of Object.entries(fieldsToSubmit)) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                checkoutForm.appendChild(input);
            }

            Swal.fire({
                title: 'Confirm Order',
                text: "Do you want to place this order?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, place order',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    checkoutForm.submit();
                }
            });
        });
    }

    // Listen for a custom event to update totals after cart changes
    document.addEventListener('cartUpdated', function (e) {
        refreshCartTotals();
    });

    // Run once on load
    toggleProceedButton();
    updateTotals();
    
    // Trigger change event on district dropdown to load thanas for Dhaka
    var event = new Event('change');
    districtSelect.dispatchEvent(event);
});
</script>


@endpush
@endsection 