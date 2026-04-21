<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chalan #{{ $order->id }}</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 13px;
    }
    .invoice-header {
        border-bottom: 2px solid #198754;
        margin-bottom: 15px;
        padding-bottom: 10px;
    }
    .table th {
        background: #198754;
        color: #fff;
        text-align: center;
        font-size: 13px;
    }
    .status-box {
        font-size: 1rem;
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 5px;
    }
    @media print {
        .btn { display: none; }
        body { -webkit-print-color-adjust: exact; }
    }
</style>
</head>
<body>
<div class="container my-3">

    {{-- Header --}}
    <div class="row invoice-header align-items-center">
        <div class="col-2">
            @if($ws->logo())
                <img width="70" height="70" src="{{ route('imagecache', ['template'=>'original','filename'=>$ws->logo_alt()]) }}" alt="logo">
            @endif
        </div>
        <div class="col-7">
            <h4 class="mb-0 fw-bold">{{ $ws->website_title }}</h4>
            <p class="mb-0 small">{{ $ws->contact_address }}</p>
        </div>
        <div class="col-3 text-end">
            <p class="mb-0"><strong>Date:</strong> {{ date('d/m/Y') }}</p>
            {{-- <div class="status-box 
                @if($order->payment_status=='unpaid') bg-danger text-white
                @elseif($order->payment_status=='paid') bg-success text-white
                @elseif($order->payment_status=='partial') bg-warning text-dark
                @endif">
                {{ ucfirst($order->payment_status) }}
            </div> --}}
        </div>
    </div>

    {{-- Customer Info --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <h6 class="fw-bold">Chalan To:</h6>
            <table class="table table-sm table-borderless">
                <tr>
                    <th width="80">Name:</th>
                    <td>{{ $order->user->name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $order->user->email ?? '' }}</td>
                </tr>
                <tr>
                    <th>Mobile:</th>
                    <td>{{ $order->user->mobile ?? '' }}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td class="bg-light">{{ $order->address_title ?? $order->user->address }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 text-end">
            <h6 class="fw-bold">Chalan Info:</h6>
            <p class="mb-1"><strong>Chalan #:</strong> {{ $order->id }}</p>
            <p class="mb-0"><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="card mb-3">
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Product Name</th>
                        <th class="text-end">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Total</th>
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
                    <tr class="fw-bold">
                        <td colspan="4" class="text-end">Grand Total</td>
                        <td class="text-end">{{ number_format($totalWithShipping,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-3">
        <p class="small text-muted">Chalan Generated on {{ \Carbon\Carbon::now()->format('d M, Y') }}</p>
        <button class="btn btn-success d-print-none" onclick="window.print()">
            <i class="fa fa-print"></i> Print Chalan
        </button>
    </div>

</div>
</body>
</html>
