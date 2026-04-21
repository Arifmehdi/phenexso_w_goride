@php
    $cart = $cart ?? \App\Models\Cart::where('product_id', $product->id)
        ->when(Auth::check(), fn($q) => $q->where('user_id', Auth::id()))
        ->when(!Auth::check(), fn($q) => $q->where('session_id', session('session_id')))
        ->first();
@endphp

<div class="cart-action-wrapper" 
    data-product="{{ $product->id }}"
    @if($cart) data-cart="{{ $cart->id }}" @endif>
    
    @if($cart)
        <!-- Quantity Control -->
        <div class="d-flex justify-content-between align-items-center gap-2 p-0 border rounded-pill bg-primary-subtle border-primary shadow-sm">
            
            <button
                class="minus btn btn-sm btn-primary rounded-circle px-2 py-0 updateCartItem"
                data-url="{{ route('cartUpdateQty') }}"
                data-cart="{{ $cart->id }}"
                data-qty="{{ $cart->quantity }}"
            >−</button>

            <span class="fw-semibold px-3 cartQtyDisplay text-dark">{{ $cart->quantity }}</span>

            <button
                class="plus btn btn-sm btn-primary rounded-circle px-2 py-0 updateCartItem"
                data-url="{{ route('cartUpdateQty') }}"
                data-cart="{{ $cart->id }}"
                data-qty="{{ $cart->quantity }}"
            >+</button>
        </div>
    @else
        <!-- Add to Cart Button -->
        <input type="hidden" name="product_qty" value="1" class="product_qty">
        <button
            class="btn btn-outline-primary w-100 btn-sm addToCart"
            data-url="{{ route('addToCart') }}"
            data-product="{{ $product->id }}"
        >
           Buy Now
        </button>
    @endif
</div>
