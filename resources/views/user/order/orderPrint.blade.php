<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Invoice #{{ $order->id }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    font-family: Arial, sans-serif;
    font-size:14px;
    color:#000;
}

.invoice-box{
    width:100%;
    padding:20px;
}

/* Header */
.invoice-header{
    border-bottom:2px solid #000;
    margin-bottom:20px;
    padding-bottom:10px;
}

.company-name{
    font-size:22px;
    font-weight:bold;
}

.company-address{
    font-size:13px;
}

/* table */
.table th{
    background:#f2f2f2;
}

.table td, .table th{
    padding:6px !important;
}

/* total */
.total-table td{
    padding:6px;
}

/* footer */
.footer{
    margin-top:30px;
    border-top:1px dashed #999;
    padding-top:10px;
    font-size:12px;
}

/* print */

@media print{

    @page{
        size:A4;
        margin:10mm;
    }

    .btn-print{
        display:none;
    }

}

</style>
</head>

<body>

<div class="container-fluid">

<div class="invoice-box">

<!-- HEADER -->
<table width="100%" class="invoice-header">

<tr>

<td width="60%">

@if($ws->logo())
<img src="{{ route('imagecache',['template'=>'original','filename'=>$ws->logo_alt()]) }}" width="60">
@endif

<div class="company-name">{{ $ws->website_title }}</div>
<div class="company-address">{{ $ws->contact_address }}</div>

</td>

<td width="40%" align="right">

<h3>INVOICE</h3>

<strong>Invoice ID :</strong> #{{ $order->id }} <br>

<strong>Date :</strong>
{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}

@if($lastPayment = $order->payments()->latest('payment_date')->first())
<br>
<strong>Due Date :</strong>
{{ \Carbon\Carbon::parse($lastPayment->payment_date)->format('d M Y') }}
@endif

</td>

</tr>

</table>


<!-- CUSTOMER + STATUS -->

<table width="100%" style="margin-bottom:20px">

<tr>

<td width="60%" valign="top">

<strong>Bill To</strong><br>

{{ $order->user->name ?? '' }}<br>
{{ $order->user->email ?? '' }}<br>
{{ $order->user->mobile ?? '' }}<br>
{{ $order->address_title ?? $order->user->address }}

</td>

<td width="40%" align="right">

<strong>Payment Status</strong><br><br>

@if($order->payment_status=='paid')
<span style="color:green;font-weight:bold;">PAID</span>
@elseif($order->payment_status=='unpaid')
<span style="color:red;font-weight:bold;">UNPAID</span>
@elseif($order->payment_status=='partial')
<span style="color:orange;font-weight:bold;">PARTIAL</span>
@endif

</td>

</tr>

</table>


<!-- ITEMS -->

<table class="table table-bordered">

<thead>

<tr>
<th width="60">#</th>
<th>Product</th>
<th width="120">Price</th>
<th width="80">Qty</th>
<th width="140">Total</th>
</tr>

</thead>

<tbody>

@foreach($items as $item)

<tr>

<td align="center">{{ $loop->iteration }}</td>

<td>{{ $item->product_name }}</td>

<td align="right">{{ number_format($item->product_price,2) }}</td>

<td align="center">{{ $item->quantity }}</td>

<td align="right">{{ number_format($item->total_cost,2) }}</td>

</tr>

@endforeach

</tbody>

</table>


@php
$shippingCost = $order->delivery_cost ?? $ws->shipping_charge ?? 150;
$totalWithShipping = $order->subtotal + $shippingCost;
@endphp


<!-- TOTAL -->

<table width="100%" class="total-table">

<tr>

<td width="65%"></td>

<td width="35%">

<table width="100%" class="table table-bordered">

<tr>
<td>Sub Total</td>
<td align="right">{{ number_format($order->subtotal,2) }}</td>
</tr>

<tr>
<td>Shipping</td>
<td align="right">{{ number_format($shippingCost,2) }}</td>
</tr>

<tr>
<td><strong>Grand Total</strong></td>
<td align="right"><strong>{{ number_format($totalWithShipping,2) }}</strong></td>
</tr>

<tr>
<td style="color:green;">Paid</td>
<td align="right" style="color:green;">
{{ number_format($order->paid(),2) }}
</td>
</tr>

<tr>
<td style="color:red;">Due</td>
<td align="right" style="color:red;">
{{ number_format($totalWithShipping - $order->paid(),2) }}
</td>
</tr>

</table>

</td>

</tr>

</table>


<!-- FOOTER -->

<div class="footer text-center">

Generated on {{ \Carbon\Carbon::now()->format('d M Y h:i A') }}

<br><br>

<button class="btn btn-success btn-print" onclick="window.print()">
Print Invoice
</button>

</div>


</div>
</div>

</body>
</html>