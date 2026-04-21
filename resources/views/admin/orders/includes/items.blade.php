<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#SL</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
        
        </tr>
    </thead>
    <tbody class="addProductItem">
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Product Name --}}
                <td>{{ $item->product_name }}</td>

                {{-- Product Price --}}
                <td>{{ number_format($item->product_price, 2) }}</td>

                {{-- Quantity --}}
                <td>
                    @if($order->due() > 0)
                        @php
                            $isDisabled = in_array($order->order_status, ['confirmed', 'delivered']);
                        @endphp

                        {{-- <div class="d-flex cartItem w3-round" style="width: 110px; height:35px;">
                          
                            <input type="button"
                                class="w3-input pt-1 w3-border w3-large border-0 w3-red minus updateItem"
                                data-url="{{ route('updateQty', $item) }}"
                                data-qty="{{ $item->quantity }}"
                                value="-"
                                style="cursor: pointer; font-size: 16px;"
                                @disabled($isDisabled)>

                        
                            <input type="text"
                                class="w3-input w3-border w3-hover-green border-0 text-center updateItem"
                                title="Qty"
                                value="{{ $item->quantity }}"
                                readonly
                                style="font-size: 16px;">

                       
                            <input type="button"
                                class="w3-input pt-1 w3-border bg-primary border-0 w3-large plus updateItem"
                                data-url="{{ route('updateQty', $item) }}"
                                data-qty="{{ $item->quantity }}"
                                value="+"
                                style="cursor: pointer; font-size: 16px;"
                                @disabled($isDisabled)>
                        </div> --}}
                        {{ $item->quantity }}
                    @else
                        {{ $item->quantity }}
                    @endif
                </td>

                {{-- Total Cost --}}
                <td class="text-right">{{ number_format($item->quantity * $item->product_price, 2) }}</td>

             

            </tr>
            @endforeach

            @php
                $shippingCost = $order->shipping_cost ?? $ws->shipping_charge ?? 150;
                $totalWithShipping = $order->subtotal + $shippingCost;
            @endphp

            {{-- Sub Total --}}
            <tr class="text-right">
                <td colspan="4" class="text-end font-weight-bold">Sub Total</td>
                <td class="font-weight-bold">{{ number_format($order->subtotal, 2) }}</td>
            </tr>

            {{-- Shipping --}}
            <tr class="text-right">
                <td colspan="4" class="text-end font-weight-bold">Shipping Cost</td>
                <td class="font-weight-bold">{{ number_format($shippingCost, 2) }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="text-right">
                <td colspan="4" class="text-end font-weight-bold">Grand Total</td>
                <td class="font-weight-bold">{{ number_format($totalWithShipping, 2) }}</td>
            </tr>

            {{-- Paid --}}
            <tr class="text-right">
                <td colspan="4" class="text-end font-weight-bold">Paid Amount</td>
                <td class="font-weight-bold">{{ number_format($order->paid(), 2) }}</td>
            </tr class="text-right">

            {{-- Due --}}
            <tr class="text-right">
                <td colspan="4" class="text-end font-weight-bold">Due Amount</td>
                <td class="font-weight-bold">{{ number_format($totalWithShipping - $order->paid(), 2) }}</td>
            </tr>

    </tbody>
    
</table>



