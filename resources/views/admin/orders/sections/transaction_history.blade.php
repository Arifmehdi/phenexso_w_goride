<div class="card shadow">
    <div class="card-header">
            <h3 class="card-title">
            Transaction History
        </h3>
    </div>
    <div class="card-body">
    <div class="row">
    <div class="col-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
            <thead>
            <tr>
                <th>SL</th>
                <th>Payment Status</th>
                <th>Payment Date</th>
                <th>Transaction Id</th>
                <th>Paid Amount</th>
            </tr>
            </thead>
        <tbody>
            
            @foreach($order->payments as $payment)  
            <tr>
                <td>{{$payment->id}}</td>
                <td>{{ Str::ucfirst($payment->payment_status) }}</td>
                <td>{{$payment->payment_date}}</td>
                <td>{{$payment->transaction_id}}</td>
                <td>{{$payment->paid_amount}}</td>
            </tr>
            @endforeach                   
        <tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</div>