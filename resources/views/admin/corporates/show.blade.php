@extends('admin.master')
@section('title')Admin | {{ $corporate->company_name ?? $corporate->name }} @endsection
@section('content')

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-building"></i>
            {{ $corporate->company_name ?: $corporate->name }}
        </h3>
        <div class="card-tools">
            <a href="{{ route('admin.corporates.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> All Corporates
            </a>
            <a href="{{ route('admin.corporates.edit', $corporate->id) }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3"><strong>Contact:</strong> {{ $corporate->name }}</div>
            <div class="col-md-3"><strong>Email:</strong> {{ $corporate->email }}</div>
            <div class="col-md-3"><strong>Mobile:</strong> {{ $corporate->mobile ?: '—' }}</div>
            <div class="col-md-3"><strong>Joined:</strong> {{ optional($corporate->created_at)->format('d M Y') }}</div>
        </div>
    </div>
</div>

{{-- ── Month picker + totals ─────────────────────────────────── --}}
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-info">
            <div class="inner"><h3>{{ number_format($stats['month_rides']) }}</h3><p>Trips this month</p></div>
            <div class="icon"><i class="fas fa-route"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-primary">
            <div class="inner"><h3>৳{{ number_format($stats['month_total']) }}</h3><p>Month total</p></div>
            <div class="icon"><i class="fas fa-file-invoice"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-danger">
            <div class="inner"><h3>৳{{ number_format($stats['unpaid']) }}</h3><p>Unpaid</p></div>
            <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="small-box bg-success">
            <div class="inner"><h3>৳{{ number_format($stats['all_time']) }}</h3><p>All-time completed</p></div>
            <div class="icon"><i class="fas fa-coins"></i></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar"></i> Trips — {{ $month }}</h3>
        <div class="card-tools d-flex">
            <form method="GET" class="form-inline mr-2">
                <input type="month" name="month" value="{{ $month }}"
                       class="form-control form-control-sm" onchange="this.form.submit()">
            </form>
            @if($stats['unpaid'] > 0)
                <form method="POST" action="{{ route('admin.corporates.settle', $corporate->id) }}"
                      onsubmit="return confirm('Mark all completed unpaid trips for {{ $month }} as paid?')">
                    @csrf
                    <input type="hidden" name="month" value="{{ $month }}">
                    <button class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Settle ৳{{ number_format($stats['unpaid']) }}
                    </button>
                </form>
            @endif
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Route</th>
                    <th>Driver</th>
                    <th>Date</th>
                    <th class="text-right">Fare</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rides as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>
                            {{ $r->booked_for_name ?: '—' }}
                            @if($r->booked_for_mobile)<br><small class="text-muted">{{ $r->booked_for_mobile }}</small>@endif
                        </td>
                        <td>
                            <small>
                                {{ Str::limit($r->pickup_address, 28) }}
                                <i class="fas fa-arrow-right mx-1"></i>
                                {{ Str::limit($r->destination_address, 28) }}
                            </small>
                        </td>
                        <td><small>{{ $r->driver_id ? ($driverNames[$r->driver_id] ?? '—') : 'Unassigned' }}</small></td>
                        <td><small>{{ optional($r->created_at)->format('d M, H:i') }}</small></td>
                        <td class="text-right">৳{{ number_format((float) $r->fare) }}</td>
                        <td>
                            @php $m = ['completed'=>'success','cancelled'=>'danger','in_progress'=>'info','pending'=>'warning']; @endphp
                            <span class="badge badge-{{ $m[$r->status] ?? 'secondary' }}">{{ ucfirst(str_replace('_',' ',$r->status)) }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $r->payment_status === 'paid' ? 'success' : 'secondary' }}">
                                {{ $r->payment_status ?: 'unpaid' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No trips in {{ $month }}.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users"></i> Employees ({{ $employees->count() }})</h3>
        <div class="card-tools">
            <small class="text-muted">Managed by the company in their app</small>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-sm text-nowrap">
            <thead><tr><th>Name</th><th>Mobile</th><th>Department</th><th>Code</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($employees as $e)
                    <tr>
                        <td>{{ $e->name }}</td>
                        <td>{{ $e->mobile }}</td>
                        <td>{{ $e->department ?: '—' }}</td>
                        <td>{{ $e->employee_code ?: '—' }}</td>
                        <td>
                            <span class="badge badge-{{ $e->is_active ? 'success' : 'secondary' }}">
                                {{ $e->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">No employees added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
