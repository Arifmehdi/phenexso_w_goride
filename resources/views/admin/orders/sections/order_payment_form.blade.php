<form action="{{ route('admin.orderPayment',$order) }}" method="post">
                        
    @csrf
        @php
            $shippingCost = $order->shipping_cost ?? $ws->shipping_charge ?? 150;
            $totalWithShipping = $order->subtotal + $shippingCost;
        @endphp

    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-credit-card"></i> Add Payment
            
            </h3>
        </div>
        <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                <div class="card shadow" style="margin-bottom: 5px;">
                <div class="card-body ">
                    
                    <div class="form-group input-group-sm w3-light-gray row mb-1">
                        <label for="payment_date" class="col-sm-5 col-form-label">Payment Date</label>
                        <div class="col-sm-7">
                        <input type="date" class="form-control mt-1 form-control-sm " id="payment_date" value="{{ old('payment_date') ? : date('Y-m-d') }}" name="payment_date" required>
                        </div>
                        @error('payment_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group input-group-sm mb-1 row w3-light-gray">
                        <label for="payement_method" class="col-sm-5 col-form-label">Payment Method</label>
                        <div class="col-sm-7">

                            <input type="text" class="form-control mt-1 form-control-sm " id="payment_method" value="" placeholder="payment method" list="payment_methods" name="payment_method">

                            <datalist id="payment_methods">
                                @foreach (config('parameter.payment_method') as $item)
                                    <option value="{{ $item }}" {{ old('payment_method') == $item  ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        @error('payment_method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group input-group-sm row w3-light-gray mb-1">
                        <label for="transaction_id" class="col-sm-5 col-form-label">Trans ID</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control bg-light mt-1 form-control-sm" id="transaction_id" name="transaction_id"
                        value="{{ old('transaction_id')}}" placeholder="Transaction Id">
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="card shadow" style="margin-bottom: 5px;">
            <div class="card-body">

                <div class="form-group input-group-sm mb-1 row w3-light-gray">
                    <label for="paid_amount" class="col-sm-5 col-form-label">Paid Amount</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control mt-1 form-control-sm orderTotalAmount" id="paid_amount" value="{{old('paid_amount') ?:  number_format($totalWithShipping + $order->paid(), 2) }}"  name="paid_amount" min="1" step="any" max="{{number_format($totalWithShipping + $order->paid())}}" placeholder="Paid Amount" required>
                        @error('paid_amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group input-group-sm row w3-light-gray mb-1">
                        <label for="remarks" class="col-sm-5 col-form-label">Note</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control bg-light mt-1 form-control-sm " placeholder="Note" id="note" value="" name="note">
                        </div>
                    </div>


                    <div class="form-group input-group-sm row w3-light-gray mb-1">

                        <div class="col-sm-5"></div>

                        <div class="col-sm-7">

                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            

        </div>
        </div>
    </div>
</form>