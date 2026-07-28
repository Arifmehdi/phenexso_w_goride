@extends('admin.master')
@section('title')Admin | Rental Bookings @endsection
@section('content')

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ number_format($stats['total']) }}</h3><p>Total bookings</p></div>
            <div class="icon"><i class="fas fa-list"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-warning">
            <div class="inner"><h3>{{ number_format($stats['pending']) }}</h3><p>Awaiting confirmation</p></div>
            <div class="icon"><i class="fas fa-clock"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-primary">
            <div class="inner"><h3>{{ number_format($stats['ongoing']) }}</h3><p>Confirmed / ongoing</p></div>
            <div class="icon"><i class="fas fa-car-side"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>৳{{ number_format($stats['revenue']) }}</h3><p>Completed revenue</p></div>
            <div class="icon"><i class="fas fa-coins"></i></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar-check"></i> Rental Bookings</h3>
        <div class="card-tools">
            <form method="GET" class="form-inline">
                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="">All statuses</option>
                    @foreach(['pending','confirmed','ongoing','completed','cancelled'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Trip</th>
                    <th>Dates</th>
                    <th class="text-right">Price</th>
                    <th>Status</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                    <tr>
                        <td>{{ $b->id }}</td>
                        <td>
                            {{ $b->customer_name }}
                            <br><small class="text-muted">{{ $b->customer_phone ?: '—' }}
                                <span class="badge badge-light">{{ $b->owner_type }}</span></small>
                        </td>
                        <td>{{ $b->car->name ?? 'Car removed' }}</td>
                        <td>
                            <small>
                                {{ $b->pickup_district ?: '—' }}{{ $b->pickup_thana ? ', '.$b->pickup_thana : '' }}
                                <i class="fas fa-arrow-right mx-1"></i>
                                {{ $b->dest_district ?: '—' }}{{ $b->dest_thana ? ', '.$b->dest_thana : '' }}
                                <br>
                                <span class="badge {{ $b->with_return ? 'badge-primary' : 'badge-secondary' }}">
                                    {{ $b->with_return ? 'With return' : 'One way' }}
                                </span>
                            </small>
                        </td>
                        <td>
                            <small>
                                {{ optional($b->pickup_date)->format('d M Y') }}
                                {{ $b->pickup_time ? '· '.$b->pickup_time : '' }}
                                @if($b->return_date)<br>to {{ optional($b->return_date)->format('d M Y') }}@endif
                            </small>
                        </td>
                        <td class="text-right">৳{{ number_format($b->total_price) }}</td>
                        <td>
                            @php $map = ['pending'=>'warning','confirmed'=>'primary','ongoing'=>'info','completed'=>'success','cancelled'=>'danger']; @endphp
                            <span class="badge badge-{{ $map[$b->status] ?? 'secondary' }}">{{ ucfirst($b->status) }}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.rental.bookings.status', $b->id) }}" class="form-inline">
                                @csrf
                                <select name="status" class="form-control form-control-sm mr-1" onchange="this.form.submit()">
                                    @foreach(['pending','confirmed','ongoing','completed','cancelled'] as $s)
                                        <option value="{{ $s }}" @selected($b->status === $s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No rental bookings yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
        <div class="card-footer">{{ $bookings->links() }}</div>
    @endif
</div>

@endsection
