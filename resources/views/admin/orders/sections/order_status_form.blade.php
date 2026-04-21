<div class="card shadow">
    <div class="card-header">
        <h3 class="card-title">
        Order Status
        </h3>
    </div>
    <form action="{{ route('admin.orderStatus',$order->id)}}" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="order_status" id="order_status" class="form-control">
                            <option value="">order status</option>
                            @foreach (config('parameter.order_status') as $item)
                                <option value="{{ $item }}" {{ $item == $order->order_status ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                        @error('order_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6">
                <button type="submit" class="form-control btn btn-primary btn-block">Submit</button>
                </div>
            
            </div>
        </div>
    </form>
</div>