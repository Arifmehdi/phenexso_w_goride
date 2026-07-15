@extends('admin.master')
@section('title')Admin Dashboard | Ride #{{ $ride->id }} Matching Details @endsection
@section('body')

<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                {{-- Navigation --}}
                <div class="mb-3">
                    <a href="{{ route('admin.ride-matching.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Ride Matching
                    </a>
                </div>

                {{-- Ride Info Card --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Ride #{{ $ride->id }} - 
                            <span class="badge badge-{{ 
                                match($ride->status) {
                                    'pending' => 'warning',
                                    'accepted' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                }
                            }}">
                                {{ ucfirst($ride->status) }}
                            </span>
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Rider Info --}}
                            <div class="col-md-4">
                                <div class="info-box bg-light p-3 rounded">
                                    <h5><i class="fas fa-user mr-2"></i> Rider</h5>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted">Name:</td>
                                            <td><strong>{{ $ride->user->name ?? 'N/A' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Mobile:</td>
                                            <td>{{ $ride->user->mobile ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email:</td>
                                            <td>{{ $ride->user->email ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            {{-- Driver Info --}}
                            <div class="col-md-4">
                                <div class="info-box bg-light p-3 rounded">
                                    <h5><i class="fas fa-motorcycle mr-2"></i> Assigned Driver</h5>
                                    @if($ride->driver)
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr>
                                                <td class="text-muted">Name:</td>
                                                <td><strong>{{ $ride->driver->name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Mobile:</td>
                                                <td>{{ $ride->driver->mobile }}</td>
                                            </tr>
                                        </table>
                                    @else
                                        <p class="text-muted mb-0">No driver assigned yet</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Ride Details --}}
                            <div class="col-md-4">
                                <div class="info-box bg-light p-3 rounded">
                                    <h5><i class="fas fa-info-circle mr-2"></i> Ride Info</h5>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted">Type:</td>
                                            <td>{{ ucfirst($ride->ride_type ?? 'N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Fare:</td>
                                            <td>
                                                @if($ride->actual_fare)
                                                    ৳{{ number_format($ride->actual_fare, 2) }}
                                                @elseif($ride->fare)
                                                    ৳{{ number_format($ride->fare, 2) }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Payment:</td>
                                            <td>
                                                {{ ucfirst($ride->payment_status ?? 'Pending') }}
                                                @if($ride->payment_method)
                                                    ({{ $ride->payment_method }})
                                                @endif
                                            </td>
                                        </tr>
                                        @if($ride->distance_km)
                                        <tr>
                                            <td class="text-muted">Distance:</td>
                                            <td>{{ $ride->distance_km }} km</td>
                                        </tr>
                                        @endif
                                        @if($ride->duration_minutes)
                                        <tr>
                                            <td class="text-muted">Duration:</td>
                                            <td>{{ $ride->duration_minutes }} mins</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Route Info --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="info-box bg-light p-3 rounded">
                                    <h6><i class="fas fa-road mr-2"></i> Route</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Pickup:</strong>
                                            <p class="mb-0">{{ $ride->pickup_address ?? 'N/A' }}</p>
                                            @if($ride->pickup_latitude && $ride->pickup_longitude)
                                                <small class="text-muted">
                                                    ({{ $ride->pickup_latitude }}, {{ $ride->pickup_longitude }})
                                                </small>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Destination:</strong>
                                            <p class="mb-0">{{ $ride->destination_address ?? 'N/A' }}</p>
                                            @if($ride->destination_latitude && $ride->destination_longitude)
                                                <small class="text-muted">
                                                    ({{ $ride->destination_latitude }}, {{ $ride->destination_longitude }})
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5><i class="fas fa-history mr-2"></i> Ride Timeline</h5>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Created:</td>
                                        <td>{{ $ride->created_at ? $ride->created_at->format('d M Y h:i A') : '--' }}</td>
                                    </tr>
                                    @if($ride->accepted_at)
                                    <tr>
                                        <td class="text-muted">Accepted:</td>
                                        <td>{{ $ride->accepted_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                    @endif
                                    @if($ride->started_at)
                                    <tr>
                                        <td class="text-muted">Started:</td>
                                        <td>{{ $ride->started_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                    @endif
                                    @if($ride->completed_at)
                                    <tr>
                                        <td class="text-muted">Completed:</td>
                                        <td>{{ $ride->completed_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                    @endif
                                    @if($ride->status === 'cancelled')
                                    <tr>
                                        <td class="text-muted">Cancelled By:</td>
                                        <td>{{ ucfirst($ride->cancelled_by ?? 'N/A') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Reason:</td>
                                        <td>{{ $ride->cancellation_reason ?? 'N/A' }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        {{-- Driver Offers Timeline --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>
                                    <i class="fas fa-handshake mr-2"></i> 
                                    Driver Offers Timeline
                                    <span class="badge badge-secondary ml-2">{{ $ride->offers->count() }} offers</span>
                                </h5>

                                @if($ride->offers->count() > 0)
                                    <div class="table-responsive mt-3">
                                        <table class="table table-hover table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Driver</th>
                                                    <th>Contact</th>
                                                    <th>Status</th>
                                                    <th>Offered At</th>
                                                    <th>Responded At</th>
                                                    <th>Response Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ride->offers as $offer)
                                                @php
                                                    $statusBadge = match($offer->status) {
                                                        'accepted' => 'success',
                                                        'declined' => 'danger',
                                                        'expired' => 'dark',
                                                        'pending' => 'warning',
                                                        default => 'secondary'
                                                    };
                                                    
                                                    // Calculate response time
                                                    $responseTime = null;
                                                    if ($offer->offered_at && $offer->responded_at) {
                                                        $diff = $offer->offered_at->diffInSeconds($offer->responded_at);
                                                        if ($diff < 60) {
                                                            $responseTime = $diff . 's';
                                                        } elseif ($diff < 3600) {
                                                            $responseTime = floor($diff / 60) . 'm ' . ($diff % 60) . 's';
                                                        } else {
                                                            $responseTime = floor($diff / 3600) . 'h ' . floor(($diff % 3600) / 60) . 'm';
                                                        }
                                                    }

                                                    // Icon for each status
                                                    $statusIcon = match($offer->status) {
                                                        'accepted' => 'fa-check-circle',
                                                        'declined' => 'fa-times-circle',
                                                        'expired' => 'fa-hourglass-end',
                                                        'pending' => 'fa-hourglass-half',
                                                        default => 'fa-question-circle'
                                                    };
                                                @endphp
                                                <tr class="{{ $offer->status === 'accepted' ? 'table-success' : ($offer->status === 'declined' ? 'table-danger' : '') }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <strong>{{ $offer->driver->name ?? 'Unknown' }}</strong>
                                                        <br><small class="text-muted">Priority #{{ $offer->priority_order }}</small>
                                                    </td>
                                                    <td>{{ $offer->driver->mobile ?? '--' }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $statusBadge }}">
                                                            <i class="fas {{ $statusIcon }} mr-1"></i>
                                                            {{ ucfirst($offer->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $offer->offered_at ? $offer->offered_at->format('d M Y h:i A') : '--' }}</td>
                                                    <td>{{ $offer->responded_at ? $offer->responded_at->format('d M Y h:i A') : '--' }}</td>
                                                    <td>
                                                        @if($responseTime)
                                                            <span class="badge badge-info">{{ $responseTime }}</span>
                                                        @else
                                                            <span class="text-muted">--</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Summary --}}
                                    @php
                                        $accepted = $ride->offers->where('status', 'accepted')->count();
                                        $declined = $ride->offers->where('status', 'declined')->count();
                                        $expired = $ride->offers->where('status', 'expired')->count();
                                        $pending = $ride->offers->where('status', 'pending')->count();
                                    @endphp
                                    <div class="mt-3">
                                        <span class="mr-3"><i class="fas fa-check-circle text-success"></i> Accepted: {{ $accepted }}</span>
                                        <span class="mr-3"><i class="fas fa-times-circle text-danger"></i> Declined: {{ $declined }}</span>
                                        <span class="mr-3"><i class="fas fa-hourglass-end text-dark"></i> Expired: {{ $expired }}</span>
                                        <span class="mr-3"><i class="fas fa-hourglass-half text-warning"></i> Pending: {{ $pending }}</span>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted"></i>
                                        <p class="mt-2 text-muted">No offers were made for this ride yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
