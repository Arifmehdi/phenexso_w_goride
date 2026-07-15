@extends('admin.master')
@section('title')Admin | Driver Payouts @endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-hand-holding-usd"></i> Driver Payouts</h3>
        <div class="card-tools">
            <a href="{{ route('admin.ride-ops.payouts.export') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>৳{{ number_format($totalPending) }}</h3>
                        <p>Total Pending Payouts</p>
                    </div>
                    <div class="icon"><i class="fas fa-coins"></i></div>
                </div>
            </div>
        </div>

        @if(count($payouts) > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Driver</th><th>Period</th><th>Gross</th>
                            <th>Commission</th><th>Net Payable</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payouts as $p)
                        <tr>
                            <td>
                                <strong>{{ $p['driver']['name'] ?? 'Driver #' . $p['driver_id'] }}</strong><br>
                                <small>{{ $p['driver']['mobile'] ?? '' }}</small>
                            </td>
                            <td><small>{{ $p['period_from'] }} → {{ $p['period_to'] }}</small></td>
                            <td>৳{{ number_format((float) $p['gross_earnings']) }}</td>
                            <td>৳{{ number_format((float) $p['commission']) }}</td>
                            <td><strong class="text-success">৳{{ number_format((float) $p['net_amount']) }}</strong></td>
                            <td>
                                <form method="POST" action="{{ route('admin.ride-ops.payouts.process') }}"
                                      onsubmit="return confirm('Pay ৳{{ number_format((float) $p['net_amount']) }} to this driver\'s wallet?')">
                                    @csrf
                                    <input type="hidden" name="payout_id" value="{{ $p['id'] }}">
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Pay Now
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-3x text-success"></i>
                <h5 class="mt-3 text-muted">No pending payouts — all drivers are settled</h5>
            </div>
        @endif
    </div>
</div>
@endsection
