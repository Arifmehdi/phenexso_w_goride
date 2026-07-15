@extends('admin.master')
@section('title')Admin Dashboard | Ride Matching History @endsection
@section('body')

<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ride Matching History</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Stats Cards --}}
                        <div class="row mb-4">
                            <div class="col-lg-2 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $stats['total'] }}</h3>
                                        <p>Total Rides</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-route"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $stats['pending'] }}</h3>
                                        <p>Pending</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $stats['accepted'] }}</h3>
                                        <p>Accepted</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $stats['completed'] }}</h3>
                                        <p>Completed</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-flag-checkered"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $stats['cancelled'] }}</h3>
                                        <p>Cancelled</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-times-circle"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Status Filter Tabs --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" 
                                           href="{{ route('admin.ride-matching.index', ['status' => 'all']) }}">
                                            All
                                        </a>
                                    </li>
                                    @foreach(['pending', 'accepted', 'completed', 'cancelled'] as $s)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $status == $s ? 'active' : '' }}" 
                                               href="{{ route('admin.ride-matching.index', ['status' => $s]) }}">
                                                {{ ucfirst($s) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Rides Table --}}
                        @if($rides->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Rider</th>
                                            <th>Pickup → Destination</th>
                                            <th>Status</th>
                                            <th>Fare</th>
                                            <th>Assigned Driver</th>
                                            <th>Offers</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rides as $ride)
                                        @php
                                            $totalOffers = $ride->offers->count();
                                            $acceptedOffers = $ride->offers->where('status', 'accepted')->count();
                                            $declinedOffers = $ride->offers->where('status', 'declined')->count();
                                            $expiredOffers = $ride->offers->where('status', 'expired')->count();
                                            $pendingOffers = $ride->offers->where('status', 'pending')->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + ($rides->currentPage() - 1) * $rides->perPage() }}</td>
                                            <td>
                                                <strong>{{ $ride->user->name ?? 'N/A' }}</strong>
                                                <br><small class="text-muted">{{ $ride->user->mobile ?? '' }}</small>
                                            </td>
                                            <td style="max-width: 300px;">
                                                <small>
                                                    <strong>From:</strong> {{ Str::limit($ride->pickup_address, 40) }}<br>
                                                    <strong>To:</strong> {{ Str::limit($ride->destination_address, 40) }}
                                                </small>
                                            </td>
                                            <td>
                                                @php
                                                    $badgeClass = match($ride->status) {
                                                        'pending' => 'warning',
                                                        'accepted' => 'info',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $badgeClass }}">
                                                    {{ ucfirst($ride->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($ride->actual_fare)
                                                    ৳{{ number_format($ride->actual_fare, 2) }}
                                                @elseif($ride->fare)
                                                    ৳{{ number_format($ride->fare, 2) }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if($ride->driver)
                                                    {{ $ride->driver->name }}
                                                    <br><small class="text-muted">{{ $ride->driver->mobile }}</small>
                                                @else
                                                    <span class="text-muted">Not assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($totalOffers > 0)
                                                    <span class="badge badge-secondary" title="Total">{{ $totalOffers }}</span>
                                                    @if($acceptedOffers > 0)
                                                        <span class="badge badge-success" title="Accepted">{{ $acceptedOffers }}</span>
                                                    @endif
                                                    @if($declinedOffers > 0)
                                                        <span class="badge badge-danger" title="Declined">{{ $declinedOffers }}</span>
                                                    @endif
                                                    @if($expiredOffers > 0)
                                                        <span class="badge badge-dark" title="Expired">{{ $expiredOffers }}</span>
                                                    @endif
                                                    @if($pendingOffers > 0)
                                                        <span class="badge badge-warning" title="Pending">{{ $pendingOffers }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">--</span>
                                                @endif
                                            </td>
                                            <td>{{ $ride->created_at->format('d M Y h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('admin.ride-matching.show', $ride->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $rides->appends(['status' => $status])->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-route fa-4x text-muted"></i>
                                <h4 class="mt-3 text-muted">No ride requests found</h4>
                                <p class="text-muted">Ride requests will appear here once riders start requesting rides.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


