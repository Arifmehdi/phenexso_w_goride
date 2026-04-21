@php
use Illuminate\Support\Str;
@endphp

<div class="table-responsive table-responsive-sm">
    <table class="table-striped table-bordered table-hover table-sm mb-1 table">
    <thead class="text-muted thead-light">
        <tr>
        <th style="width: 10px">#SL</th>
        <th>Action</th>
        <th>Id</th>
        <th>UserId</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Transaction ID</th>
        <th>Date</th>
        <th>Order Status</th>
        <th>Sub Total</th>
        <th>Delivery Cost</th>
        <th>Total</th>
        <th>Payment Status</th>
        <th>Product Items</th>
        </tr>
        
    </thead>
    <tbody class="">
        <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
        @foreach($orders as $order)
        <tr>
        <td style="width: 10px">{{$i++}}</td>
        <td style="width: 80px">
            <div class="dropdown show">
                <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('admin.orderDeatils',$order->id)}}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>
                </div>
        </td>
        <td>{{$order->id}}</td>
        <td>
            <a href="{{ route('admin.all_user',['id' => $order->user_id ?? '' ])}}">
            {{$order->user_id ?? ''}}
            </a>
        </td>
        <td>{{$order->name}}</td>
        <td>{{$order->email}}</td>
        <td>{{$order->mobile}}</td>
        <td title="{{ $order->payment_trx_id }}">
            {{ Str::limit($order->payment_trx_id, 20) }}
        </td>
        
        <td>{{$order->created_at->format('d/m/Y')}}</td>
        <td>{{$order->order_status}}</td>
        <td>{{ '৳' .$order->subtotal}}</td>
        <td>{{ '৳' .$order->delivery_cost}}</td>
        <td>{{ '৳' . number_format($order->subtotal + $order->delivery_cost, 2) }}</td>
        <td>{{$order->payment_status}}</td>
        <td>{{$order->orderItems()->count()}}</td>
        
        </tr>  
        @endforeach
        <tr> 
            <th colspan="11" class="text-right w3-medium">Grand Total Amount</th>
            <th class="w3-medium text-center" colspan="4">{{ '৳' .number_format($orders->sum('grand_total'), 2,)}}</th>
        </tr>
    </tbody>
    </table>
</div>
<div class="w3-small float-right pt-1">
    {!! $orders->links() !!}
</div>