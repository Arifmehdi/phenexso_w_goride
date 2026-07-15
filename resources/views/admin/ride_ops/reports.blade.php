@extends('admin.master')
@section('title')Admin | Ride Reports @endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-line"></i> Ride Reports</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="form-inline mb-4">
            <label class="mr-2">From</label>
            <input type="date" name="from" value="{{ $from->toDateString() }}" class="form-control mr-3">
            <label class="mr-2">To</label>
            <input type="date" name="to" value="{{ $to->toDateString() }}" class="form-control mr-3">
            <button class="btn btn-primary">Apply</button>
        </form>

        <div class="row mb-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner"><h3>৳{{ number_format($totalRevenue) }}</h3><p>Revenue (completed rides)</p></div>
                    <div class="icon"><i class="fas fa-coins"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner"><h3>{{ $totalTrips }}</h3><p>Completed Trips</p></div>
                    <div class="icon"><i class="fas fa-route"></i></div>
                </div>
            </div>
            @foreach($byStatus as $status => $count)
                @if(in_array($status, ['cancelled', 'pending']))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-{{ $status == 'cancelled' ? 'danger' : 'warning' }}">
                        <div class="inner"><h3>{{ $count }}</h3><p>{{ ucfirst($status) }} Rides</p></div>
                        <div class="icon"><i class="fas fa-{{ $status == 'cancelled' ? 'times-circle' : 'clock' }}"></i></div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-7">
                <h5>Daily Revenue</h5>
                <table class="table table-sm table-bordered">
                    <thead class="thead-light"><tr><th>Date</th><th>Trips</th><th>Revenue</th></tr></thead>
                    <tbody>
                        @forelse($daily as $d)
                            <tr><td>{{ $d->period }}</td><td>{{ $d->trips }}</td><td>৳{{ number_format((float) $d->revenue) }}</td></tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted">No completed rides in this period</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h5>Top Drivers</h5>
                <table class="table table-sm table-bordered">
                    <thead class="thead-light"><tr><th>Driver</th><th>Trips</th><th>Earnings</th></tr></thead>
                    <tbody>
                        @forelse($topDrivers as $d)
                            <tr>
                                <td>{{ $driverNames[$d->driver_id] ?? ('Driver #' . $d->driver_id) }}</td>
                                <td>{{ $d->trips }}</td>
                                <td>৳{{ number_format((float) $d->earnings) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted">No driver earnings in this period</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
