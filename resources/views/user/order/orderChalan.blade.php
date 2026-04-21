<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chalan #{{ $order->id }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    font-family:'Segoe UI',sans-serif;
    font-size:13px;
    background:#fff;
}

.chalan-box{
    border:1px solid #ddd;
    padding:25px;
}

.header{
    border-bottom:2px solid #198754;
    padding-bottom:10px;
    margin-bottom:20px;
}

.table th{
    background:#198754;
    color:white;
    text-align:center;
    font-weight:600;
}

.info-title{
    font-weight:600;
    margin-bottom:8px;
    border-bottom:1px solid #ddd;
    padding-bottom:4px;
}

.signature{
    margin-top:60px;
}

.signature hr{
    margin-top:40px;
}

@media print{

    .btn{
        display:none;
    }

    body{
        -webkit-print-color-adjust:exact;
    }

    .container{
        max-width:100%;
    }

    /* force two columns in print */
    .col-6{
        width:50% !important;
        float:left;
    }

}

</style>
</head>

<body>

<div class="container my-4">

<div class="chalan-box">

<!-- Header -->
<div class="row header align-items-center">

<div class="col-2">
@if($ws->logo())
<img width="70" src="{{ route('imagecache',['template'=>'original','filename'=>$ws->logo_alt()]) }}">
@endif
</div>

<div class="col-7">
<h4 class="mb-0 fw-bold">{{ $ws->website_title }}</h4>
<small>{{ $ws->contact_address }}</small>
</div>

<div class="col-3 text-end">
<strong>Date:</strong> {{ date('d/m/Y') }}
</div>

</div>


<!-- Customer & Chalan Info -->
<div class="row mb-4">

<div class="col-6">

<div class="info-title">Chalan To</div>

<p class="mb-1"><strong>Name:</strong> {{ $order->user->name ?? '' }}</p>
<p class="mb-1"><strong>Email:</strong> {{ $order->user->email ?? '' }}</p>
<p class="mb-1"><strong>Mobile:</strong> {{ $order->user->mobile ?? '' }}</p>
<p class="mb-0"><strong>Address:</strong> {{ $order->address_title ?? $order->user->address }}</p>

</div>


<div class="col-6 text-end">

<div class="info-title">Chalan Info</div>

<p class="mb-1"><strong>Chalan #:</strong> {{ $order->id }}</p>

<p class="mb-0">
<strong>Date:</strong>
{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
</p>

</div>

</div>


<!-- Items Table -->

<table class="table table-bordered table-sm">

<thead>
<tr>
<th width="60">SL</th>
<th>Product Name</th>
<th width="120">Price</th>
<th width="80">Qty</th>
<th width="140">Total</th>
</tr>
</thead>

<tbody>

@foreach($items as $item)

<tr>

<td class="text-center">{{ $loop->iteration }}</td>

<td>{{ $item->product_name }}</td>

<td class="text-end">
{{ number_format($item->product_price,2) }}
</td>

<td class="text-center">
{{ $item->quantity }}
</td>

<td class="text-end">
{{ number_format($item->total_cost,2) }}
</td>

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


<!-- Signature -->

<div class="row signature text-center">

<div class="col-4">
<hr>
Prepared By
</div>

<div class="col-4">
<hr>
Checked By
</div>

<div class="col-4">
<hr>
Customer Signature
</div>

</div>


<!-- Footer -->

<div class="text-center mt-4">

<small class="text-muted">
Chalan Generated on {{ \Carbon\Carbon::now()->format('d M, Y') }}
</small>

<br><br>

<button class="btn btn-success" onclick="window.print()">
Print Chalan
</button>

</div>


</div>

</div>

</body>
</html>
