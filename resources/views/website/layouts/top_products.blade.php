<ul>
    @foreach($topClickedProducts as $item)
    <li>
        <div class="top-rated-product-item clearfix">
            <div class="top-rated-product-img">
                <a href="{{ route('productDetails', $item->slug) }}">
                    <img src="{{ route('imagecache', ['template' => 'pnism', 'filename' => $item->fi()]) }}" alt="{{ $item->name_en }}">
                </a>
            </div>

            <div class="top-rated-product-info">
                <h6>
                    <a href="{{ route('productDetails', $item->slug) }}">
                        {{ $item->name_en }}
                    </a>
                </h6>

                <div class="product-price">
                    <span>{{ number_format($item->final_price, 2) }} ৳</span>
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>