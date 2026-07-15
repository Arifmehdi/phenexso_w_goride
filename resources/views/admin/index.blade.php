@extends('admin.master')

@section('title')
    Admin Dashboard | {{ env('APP_NAME') }}
@endsection

@section('body')
<section class="content pt-3" style="min-height: 700px;">

    {{-- Greeting --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h4 class="mb-0" style="font-weight:800;color:#1a2b22;">Welcome back, {{ $name[0] ?? 'Admin' }} 👋</h4>
            <p class="text-muted mb-0"><small>Here's what's happening on GoRide today — {{ \Carbon\Carbon::now()->format('l, d M Y') }}</small></p>
        </div>
        <div>
            <a href="{{ route('admin.ride-ops.live-rides') }}" class="btn btn-success">
                <i class="fas fa-broadcast-tower"></i> Live Rides
                <span class="badge badge-light ml-1">{{ $ride['active_rides'] }}</span>
            </a>
        </div>
    </div>

    {{-- ── Primary KPIs (ride operations) ── --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $ride['today_rides'] }}</h3>
                    <p>Rides Today</p>
                </div>
                <div class="icon"><i class="fas fa-route"></i></div>
                <a href="{{ route('admin.ride-ops.reports') }}" class="small-box-footer">
                    View reports <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>৳{{ number_format($ride['today_revenue']) }}</h3>
                    <p>Revenue Today</p>
                </div>
                <div class="icon"><i class="fas fa-coins"></i></div>
                <a href="{{ route('admin.ride-ops.reports') }}" class="small-box-footer">
                    Revenue trend <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $ride['active_rides'] }}</h3>
                    <p>Ongoing Rides</p>
                </div>
                <div class="icon"><i class="fas fa-taxi"></i></div>
                <a href="{{ route('admin.ride-ops.live-rides') }}" class="small-box-footer">
                    Live map <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $ride['online_drivers'] }}</h3>
                    <p>Drivers Online</p>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
                <a href="{{ route('admin.approvals.index') }}" class="small-box-footer">
                    Manage drivers <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- ── Secondary stats ── --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="card"><div class="card-body d-flex align-items-center justify-content-between">
                <div><h4 class="mb-0" style="font-weight:800;">{{ number_format($users) }}</h4><small class="text-muted">Total Passengers</small></div>
                <div class="text-success"><i class="fas fa-users fa-2x"></i></div>
            </div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card"><div class="card-body d-flex align-items-center justify-content-between">
                <div><h4 class="mb-0" style="font-weight:800;">{{ number_format($drivers) }}</h4><small class="text-muted">Total Drivers</small></div>
                <div class="text-info"><i class="fas fa-id-card fa-2x"></i></div>
            </div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card"><div class="card-body d-flex align-items-center justify-content-between">
                <div><h4 class="mb-0" style="font-weight:800;">{{ number_format($pendingApprovals) }}</h4><small class="text-muted">Pending Approvals</small></div>
                <div class="text-warning"><i class="fas fa-user-clock fa-2x"></i></div>
            </div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card"><div class="card-body d-flex align-items-center justify-content-between">
                <div><h4 class="mb-0" style="font-weight:800;">৳{{ number_format($ride['month_revenue']) }}</h4><small class="text-muted">Revenue This Month</small></div>
                <div class="text-success"><i class="fas fa-chart-line fa-2x"></i></div>
            </div></div>
        </div>
    </div>

    <div class="row">
        {{-- ── Weekly rides bar chart ── --}}
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-bar"></i> Rides — Last 7 Days</h3></div>
                <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between" style="height:200px;gap:14px;">
                        @foreach($weekly as $w)
                            <div class="d-flex flex-column align-items-center" style="flex:1;">
                                <div style="font-size:11px;font-weight:700;color:#10713C;margin-bottom:4px;">{{ $w['rides'] }}</div>
                                <div title="৳{{ number_format($w['revenue']) }} revenue"
                                     style="width:70%;
                                            height:{{ 20 + ($w['rides'] / $weeklyMax) * 150 }}px;
                                            background:linear-gradient(180deg,#16A34A,#10713C);
                                            border-radius:8px 8px 0 0;
                                            transition:all .2s;"></div>
                                <div style="font-size:12px;color:#6b7c74;margin-top:6px;">{{ $w['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Quick actions ── --}}
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h3></div>
                <div class="card-body">
                    <div class="row text-center">
                        @php $qa = [
                            ['route' => 'admin.approvals.index', 'icon' => 'fa-user-check', 'label' => 'Approvals', 'color' => '#E8830C'],
                            ['route' => 'admin.ride-ops.live-rides', 'icon' => 'fa-taxi', 'label' => 'Live Rides', 'color' => '#10713C'],
                            ['route' => 'admin.ride-ops.tickets', 'icon' => 'fa-headset', 'label' => 'Support', 'color' => '#1565C0'],
                            ['route' => 'admin.ride-ops.payouts', 'icon' => 'fa-hand-holding-usd', 'label' => 'Payouts', 'color' => '#16A34A'],
                            ['route' => 'admin.ride-ops.surge', 'icon' => 'fa-bolt', 'label' => 'Surge', 'color' => '#C62828'],
                            ['route' => 'admin.promo-codes.index', 'icon' => 'fa-tags', 'label' => 'Promos', 'color' => '#673AB7'],
                        ]; @endphp
                        @foreach($qa as $item)
                            <div class="col-4 mb-3">
                                <a href="{{ route($item['route']) }}" class="d-block text-decoration-none">
                                    <div style="width:56px;height:56px;margin:0 auto 6px;border-radius:16px;
                                                background:{{ $item['color'] }}1a;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas {{ $item['icon'] }} fa-lg" style="color:{{ $item['color'] }};"></i>
                                    </div>
                                    <small style="color:#1a2b22;font-weight:600;">{{ $item['label'] }}</small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Recent rides ── --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-history"></i> Recent Rides</h3>
            <a href="{{ route('admin.ride-matching.index') }}" class="btn btn-sm btn-outline-secondary">All history</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr><th>#</th><th>Passenger</th><th>Driver</th><th>Route</th><th>Fare</th><th>Status</th><th>Time</th></tr>
                </thead>
                <tbody>
                    @forelse($recentRides as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->user->name ?? '—' }}</td>
                        <td>{{ $r->driver->name ?? 'Unassigned' }}</td>
                        <td><small>{{ \Illuminate\Support\Str::limit($r->pickup_address, 20) }} → {{ \Illuminate\Support\Str::limit($r->destination_address, 20) }}</small></td>
                        <td>৳{{ number_format((float) $r->fare) }}</td>
                        <td>
                            @php $sc = ['completed'=>'success','cancelled'=>'danger','in_progress'=>'info','arriving'=>'warning','accepted'=>'primary','pending'=>'secondary'][$r->status] ?? 'secondary'; @endphp
                            <span class="badge badge-{{ $sc }}">{{ str_replace('_',' ',$r->status) }}</span>
                        </td>
                        <td><small>{{ $r->created_at->diffForHumans() }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No rides yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
