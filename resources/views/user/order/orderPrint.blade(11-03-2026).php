<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice #{{ $order->id }}</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}alt/plugins/fontawesome-free/css/all.min.css">

  <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
      }
      .invoice-header {
        border-bottom: 2px solid #198754;
        margin-bottom: 20px;
        padding-bottom: 10px;
      }
      .table th {
        background: #198754;
        color: #fff;
        text-align: center;
      }
      .status-box {
        font-size: 1.2rem;
        font-weight: bold;
        padding: 15px;
        border-radius: .5rem;
      }
      @media print {
        body { -webkit-print-color-adjust: exact; }
        .btn { display: none; }
      }
  </style>
</head>
<body>

<div class="container my-4">
  <!-- Header -->
  <div class="row invoice-header align-items-center">
    <div class="col-2">
      @if($ws->logo())
      <img width="70" height="79" src="{{ route('imagecache', ['template'=>'original','filename'=>$ws->logo_alt()]) }}" alt="logo" class="img-fluid">
      @endif
    </div>
    <div class="col-7">
      <h3 class="mb-0 fw-bold">{{ $ws->website_title }}</h3>
      <p class="mb-0 small">{{ $ws->contact_address }}</p>
    </div>
    <div class="col-3 text-end">
      <p class="mb-0"><strong>Date:</strong> {{ date('d/m/Y') }}</p>
    </div>
  </div>

  <!-- Invoice Info -->
  <div class="row mb-4">
    <div class="col-md-8">
      <div class="p-3 border bg-light rounded">
        <h5 class="fw-bold mb-2">Invoice #{{ $order->id }}</h5>
        <p class="mb-1"><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('l, M d, Y') }}</p>
        @if($lastPayment = $order->payments()->latest('payment_date')->first())
        <p class="mb-0"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($lastPayment->payment_date)->format('l, M d, Y') }}</p>
        @endif
      </div>
    </div>
    <div class="col-md-4 text-center">
      <div class="status-box 
          @if($order->payment_status=='unpaid') bg-danger text-white
          @elseif($order->payment_status=='paid') bg-success text-white
          @elseif($order->payment_status=='partial') bg-warning text-dark
          @endif">
        {{ ucfirst($order->payment_status) }}
      </div>
    </div>
  </div>

  <!-- Customer Info -->
  <div class="row mb-4">
    <div class="col-md-8">
      <h6 class="fw-bold">Invoiced To</h6>
      <table class="table table-sm table-borderless">
        <tr>
          <th width="80">Name:</th>
          <td class="bg-light">{{ $order->user->name ?? '' }}</td>
        </tr>
        <tr>
          <th>Email:</th>
          <td class="bg-light">{{ $order->user->email ?? '' }}</td>
        </tr>
        <tr>
          <th>Mobile:</th>
          <td class="bg-light">{{ $order->user->mobile ?? '' }}</td>
        </tr>
        <tr>
          <th>Adress:</th>
          <td class="bg-light">{{ $order->address_title ?? $order->user->address }}</td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Order Items -->
  <div class="card shadow mb-4">
    <div class="card-header bg-success text-white">
      <h6 class="mb-0"><i class="fa fa-box"></i> Order Items</h6>
    </div>
    <div class="card-body p-0">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>#SL</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->product_name }}</td>
            <td class="text-end">{{ number_format($item->product_price,2) }}</td>
            <td class="text-center">{{ $item->quantity }}</td>
            <td class="text-end">{{ number_format($item->total_cost,2) }}</td>
          </tr>
          @endforeach

            @php
                $shippingCost = $order->delivery_cost ?? $ws->shipping_charge ?? 150;
                $totalWithShipping = $order->subtotal + $shippingCost;
            @endphp

          <tr class="fw-bold">
            <td colspan="4" class="text-end">Sub Total</td>
            <td class="text-end">{{ number_format($order->subtotal,2) }}</td>
          </tr>

  

          <tr class="fw-bold">
            <td colspan="4" class="text-end">Shipping Cost</td>
            <td class="text-end">{{ number_format($shippingCost,2) }}</td>
          </tr>

             {{-- Grand Total --}}
            <tr class="fw-bold">
                <td colspan="4" class="text-end">Grand Total</td>
                <td class="text-end">{{ number_format($totalWithShipping, 2) }}</td>
            </tr>

          <tr class="fw-bold">
            <td colspan="4" class="text-end">Paid</td>
            <td class="text-end">{{ number_format($order->paid(), 2) }}</td>
          </tr>
          <tr class="fw-bold">
            <td colspan="4" class="text-end">Due</td>
            <td class="text-end">{{ number_format($totalWithShipping - $order->paid(), 2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Transactions -->
  {{--<div class="card shadow mb-4">
    <div class="card-header bg-success text-white">
      <h6 class="mb-0"><i class="fa fa-receipt"></i> Transactions</h6>
    </div>
    <div class="card-body p-0">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>#SL</th>
            <th>Date</th>
            <th>Paid Amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->payments as $payment)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}</td>
            <td class="text-end">{{ number_format($payment->paid_amount,2) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>--}}

  <!-- Footer -->
  <div class="text-center mt-4">
    <p class="small text-muted">
      PDF Generated on {{ \Carbon\Carbon::now()->format('l, M d, Y') }}
    </p>
    <button class="btn btn-success d-print-none" onclick="window.print()">
      <i class="fa fa-print"></i> Print Invoice
    </button>
  </div>
</div>

</body>
</html>
