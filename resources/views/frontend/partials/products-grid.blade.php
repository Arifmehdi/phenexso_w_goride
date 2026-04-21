@if($products->count() > 0)
    @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="ltn__product-item ltn__product-item-3 text-center">
                <div class="product-img">
                    <a href="{{ route('productDetails', $product->slug) }}">
                        <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $product->fi()]) }}" alt="{{ $product->name_en }}">
                    </a>

                    <div class="product-hover-action">
                        <ul>
                            <li>
                                <a href="#" class="quick-view-btn" data-id="{{ $product->id }}">
                                    <i class="far fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="add-to-cart-btn" data-id="{{ $product->id }}">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="add-to-wishlist-btn" data-id="{{ $product->id }}">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="product-info">
                    <h2 class="product-title">
                        <a href="{{ route('productDetails', $product->slug) }}">
                            {{ $product->name_en ?? $product->name_bn ?? $product->name }}
                        </a>
                    </h2>

                    <div class="product-price">
                        @if($product->discount_price)
                            <span>{{ number_format($product->price, 2) }} ৳</span>
                            @if(number_format($product->discount_price, 2) != 0.00)
                                <del>{{ number_format($product->discount_price, 2) }} ৳</del>
                            @endif
                        @else
                            <span>${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center">
        <p>No products found.</p>
    </div>
@endif
