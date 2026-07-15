<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: Arial, sans-serif; font-size: 13px; color: #333; margin: 0; padding: 20px; }
  .header { text-align: center; border-bottom: 2px solid #10713C; padding-bottom: 12px; margin-bottom: 16px; }
  .header h2 { color: #10713C; margin: 0; font-size: 20px; }
  .header p { margin: 2px 0; color: #666; }
  .row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f0f0f0; }
  .row .label { color: #666; }
  .row .value { font-weight: bold; }
  .total { background: #f9f9f9; padding: 10px; border-radius: 6px; margin-top: 12px; }
  .total .row { border: none; }
  .total .fare { font-size: 18px; color: #10713C; }
  .footer { text-align: center; margin-top: 20px; color: #aaa; font-size: 11px; }
</style>
</head>
<body>
<div class="header">
  <h2>GoRide</h2>
  <p>Trip Receipt</p>
  <p>{{ $ride->completed_at?->format('d M Y, h:i A') ?? 'N/A' }}</p>
</div>

<div class="row"><span class="label">Receipt #</span><span class="value">GR-{{ str_pad($ride->id, 6, '0', STR_PAD_LEFT) }}</span></div>
<div class="row"><span class="label">Passenger</span><span class="value">{{ $ride->user?->name ?? 'N/A' }}</span></div>
<div class="row"><span class="label">Ride Type</span><span class="value">{{ ucfirst($ride->ride_type ?? 'Car') }}</span></div>
<div class="row"><span class="label">Pickup</span><span class="value">{{ $ride->pickup_address }}</span></div>
<div class="row"><span class="label">Destination</span><span class="value">{{ $ride->destination_address }}</span></div>
<div class="row"><span class="label">Distance</span><span class="value">{{ number_format($ride->distance_km ?? 0, 1) }} km</span></div>
<div class="row"><span class="label">Duration</span><span class="value">{{ $ride->duration_minutes ?? '—' }} min</span></div>
<div class="row"><span class="label">Payment</span><span class="value">{{ ucfirst($ride->payment_method ?? 'Cash') }}</span></div>

<div class="total">
  <div class="row"><span class="label">Base Fare</span><span class="value">৳50</span></div>
  <div class="row"><span class="label">Distance Charge</span><span class="value">৳{{ number_format(max(0, ($ride->fare ?? 0) - 50), 0) }}</span></div>
  <div class="row" style="border-top:1px solid #ccc; margin-top:6px; padding-top:6px;">
    <span class="label" style="font-weight:bold; font-size:15px;">Total</span>
    <span class="value fare">৳{{ number_format($ride->fare ?? 0, 0) }}</span>
  </div>
</div>

<div class="footer">Thank you for riding with GoRide • gorides.musafirinternational.com</div>
</body>
</html>
