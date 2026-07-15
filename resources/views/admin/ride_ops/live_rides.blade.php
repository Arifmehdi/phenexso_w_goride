@extends('admin.master')
@section('title')Admin | Live Rides @endsection
@section('content')
{{-- Auto-refresh every 10 seconds so the feed stays live --}}
<meta http-equiv="refresh" content="10">

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-broadcast-tower text-success"></i> Live Rides ({{ $rides->count() }} ongoing)</h3>
        <div class="card-tools"><small class="text-muted">Auto-refreshes every 10s</small></div>
    </div>
    <div class="card-body">
        @if($rides->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th><th>Status</th><th>Passenger</th><th>Driver</th>
                            <th>Route</th><th>Fare</th><th>Accepted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rides as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>
                                <span class="badge badge-{{ $r->status == 'in_progress' ? 'success' : ($r->status == 'arriving' ? 'warning' : 'info') }}">
                                    {{ str_replace('_', ' ', $r->status) }}
                                </span>
                            </td>
                            <td>{{ $r->user->name ?? '—' }}<br><small>{{ $r->user->mobile ?? '' }}</small></td>
                            <td>{{ $r->driver->name ?? '—' }}<br><small>{{ $r->driver->mobile ?? '' }} ({{ $r->driver->vehicle_type ?? '' }})</small></td>
                            <td><small>{{ $r->pickup_address }} → {{ $r->destination_address }}</small></td>
                            <td>৳{{ number_format((float) $r->fare) }}</td>
                            <td><small>{{ optional($r->accepted_at)->diffForHumans() }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-map fa-3x text-muted"></i>
                <h5 class="mt-3 text-muted">No ongoing rides right now</h5>
            </div>
        @endif
    </div>
</div>
@endsection
