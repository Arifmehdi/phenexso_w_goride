<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: Arial, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 24px; }
  .header { text-align: center; border-bottom: 2px solid #10713C; padding-bottom: 14px; margin-bottom: 18px; }
  .header h2 { color: #10713C; margin: 0; font-size: 22px; }
  .header p { margin: 2px 0; color: #666; }
  .meta { display: flex; justify-content: space-between; margin-bottom: 16px; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  th, td { border: 1px solid #eee; padding: 6px 8px; text-align: left; font-size: 11px; }
  th { background: #f5f5f5; color: #444; }
  .totals { margin-top: 16px; width: 260px; margin-left: auto; }
  .totals .row { display: flex; justify-content: space-between; padding: 4px 0; }
  .totals .grand { font-weight: bold; font-size: 15px; color: #10713C; border-top: 1px solid #ccc; padding-top: 6px; }
  .footer { text-align: center; margin-top: 24px; color: #aaa; font-size: 10px; }
</style>
</head>
<body>
<div class="header">
  <h2>GoRide</h2>
  <p>Corporate Invoice — {{ $month }}</p>
</div>

<div class="meta">
  <div>
    <strong>{{ $corporate->name ?? $corporate->company_name ?? 'Corporate Account' }}</strong><br>
    {{ $corporate->email ?? '' }}<br>
    {{ $corporate->mobile ?? '' }}
  </div>
  <div style="text-align:right;">
    <strong>Invoice Period</strong><br>
    {{ \Carbon\Carbon::parse($month.'-01')->format('F Y') }}
  </div>
</div>

<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Employee</th>
      <th>Ride Type</th>
      <th>Route</th>
      <th>Status</th>
      <th>Fare</th>
    </tr>
  </thead>
  <tbody>
    @forelse($rides as $ride)
      <tr>
        <td>{{ $ride->created_at?->format('d M') }}</td>
        <td>{{ $ride->booked_for_name ?? '—' }}</td>
        <td>{{ ucfirst($ride->ride_type) }}</td>
        <td>{{ \Illuminate\Support\Str::limit($ride->pickup_address, 15) }} → {{ \Illuminate\Support\Str::limit($ride->destination_address, 15) }}</td>
        <td>{{ ucfirst($ride->status) }}</td>
        <td>৳{{ number_format($ride->fare, 0) }}</td>
      </tr>
    @empty
      <tr><td colspan="6" style="text-align:center;color:#999;">No rides this period</td></tr>
    @endforelse
  </tbody>
</table>

<div class="totals">
  <div class="row"><span>Total Rides</span><span>{{ $rides->count() }}</span></div>
  <div class="row grand"><span>Total Amount</span><span>৳{{ number_format($totalAmount, 0) }}</span></div>
</div>

<div class="footer">GoRide Corporate Billing • gorides.musafirinternational.com</div>
</body>
</html>
