<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Invoice #{{ $order->id }}</title> <link rel="stylesheet" href="{{ asset('/') }}alt/plugins/fontawesome-free/css/all.min.css"> <style> body{ font-family: Arial, Helvetica, sans-serif; font-size:13px; color:#000; } /* A4 page setup */ @page{ size:A4; margin:15mm; } .container{ width:100%; } /* header */ .header{ border-bottom:2px solid #198754; margin-bottom:15px; padding-bottom:10px; } .company-title{ font-size:20px; font-weight:bold; } .small{ font-size:12px; } /* tables */ table{ width:100%; border-collapse:collapse; } th,td{ border:1px solid #000; padding:6px; } th{ background:#198754; color:#fff; } .text-right{ text-align:right; } .text-center{ text-align:center; } .no-border td{ border:none; } /* totals */ .total-table td{ border:1px solid #000; padding:6px; } /* print behavior */ thead{ display:table-header-group; } tr{ page-break-inside:avoid; } /* button */ .btn-print{ margin-top:20px; } @media print{ .btn-print{ display:none; }     table, th, td{
        border:1px solid #000 !important;
    } } </style> </head> <body> <div class="container"> <!-- HEADER --> <table class="header no-border"> <tr> <td width="70%">
    
    <style>
        table{
            width:100%;
            border-collapse:collapse;
        }
        
        table, th, td{
            border:1px solid #000;
        }
        
        th, td{
            padding:6px;
        }
        
        th{
            background:#198754;
            color:#fff;
        }
    </style>

@if($ws->logo())
<img src="{{ route('imagecache',['template'=>'original','filename'=>$ws->logo_alt()]) }}" width="60">
@endif

<div class="company-title">{{ $ws->website_title }}</div> <div class="small"> {{ $ws->contact_address }} </div> </td> <td width="30%" align="right">

<strong>INVOICE</strong><br>

Invoice #: {{ $order->id }}<br>

Date: {{ $order->created_at->format('d M Y') }}

</td> </tr> </table> <!-- CUSTOMER INFO --> <table class="no-border" style="margin-bottom:15px"> <tr> <td width="70%">

<strong>Bill To</strong><br>

{{ $order->name ?? $order->user?->name }}<br>

{{ $order->email ?? $order->user?->email }}<br>

{{ $order->mobile ?? $order->user?->mobile }}

</td> <td width="30%" align="right">

<strong>Status</strong><br>

@if($order->payment_status=='paid')
<span style="color:green;font-weight:bold;">PAID</span>
@elseif($order->payment_status=='unpaid')
<span style="color:red;font-weight:bold;">UNPAID</span>
@else
<span style="color:orange;font-weight:bold;">PARTIAL</span>
@endif

</td> </tr> </table> <!-- ITEMS TABLE --> <table> <thead> <tr> <th width="60">SL</th> <th>Product Name</th> <th width="120">Price</th> <th width="80">Qty</th> <th width="140">Total</th> </tr> </thead> <tbody>

@foreach($items as $item)

<tr> <td class="text-center">{{ $loop->iteration }}</td> <td>{{ $item->product_name }}</td> <td class="text-right">{{ number_format($item->product_price,2) }}</td> <td class="text-center">{{ $item->quantity }}</td> <td class="text-right">{{ number_format($item->total_cost,2) }}</td> </tr>

@endforeach

@php
$shippingCost = $order->shipping_cost ?? $ws->shipping_charge ?? 150;
$totalWithShipping = $order->subtotal + $shippingCost;
@endphp

<tr> <td colspan="4" class="text-right"><strong>Sub Total</strong></td> <td class="text-right">{{ number_format($order->subtotal,2) }}</td> </tr> <tr> <td colspan="4" class="text-right"><strong>Shipping</strong></td> <td class="text-right">{{ number_format($shippingCost,2) }}</td> </tr> <tr> <td colspan="4" class="text-right"><strong>Grand Total</strong></td> <td class="text-right"><strong>{{ number_format($totalWithShipping,2) }}</strong></td> </tr> <tr> <td colspan="4" class="text-right" style="color:green"><strong>Paid</strong></td> <td class="text-right" style="color:green">{{ number_format($order->paid(),2) }}</td> </tr> <tr> <td colspan="4" class="text-right" style="color:red"><strong>Due</strong></td> <td class="text-right" style="color:red"> {{ number_format($totalWithShipping - $order->paid(),2) }} </td> </tr> </tbody> </table> <!-- PAYMENTS -->

@if($order->payments->count())

<br>

<strong>Transactions</strong>

<table> <thead> <tr> <th width="60">SL</th> <th>Date</th> <th width="150">Paid Amount</th> </tr> </thead> <tbody>

@foreach($order->payments as $payment)

<tr> <td class="text-center">{{ $loop->iteration }}</td> <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td> <td class="text-right">{{ number_format($payment->paid_amount,2) }}</td> </tr>

@endforeach

</tbody> </table>

@endif

<!-- FOOTER --> <div style="text-align:center;margin-top:30px;font-size:12px">

Generated on {{ \Carbon\Carbon::now()->format('d M Y h:i A') }}

<br><br>

<button class="btn-print" onclick="window.print()"> <i class="fa fa-print"></i> Print Invoice </button> </div> </div> </body> </html>