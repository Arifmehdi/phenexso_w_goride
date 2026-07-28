@extends('admin.master')
@section('title')Admin | SOS Alerts @endsection
@section('content')

{{-- Leaflet (OpenStreetMap) — free, no API key needed --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    {{-- Live map --}}
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> SOS Live Map</h3>
                <div class="card-tools"><small class="text-muted">Auto-refreshes every 20s</small></div>
            </div>
            <div class="card-body p-0">
                <div id="sosMap" style="height: 460px; border-radius: 0 0 16px 16px;"></div>
            </div>
        </div>
    </div>

    {{-- Alerts list --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Recent Alerts ({{ $alerts->count() }})</h3></div>
            <div class="card-body p-0" style="max-height: 500px; overflow-y:auto;">
                @forelse($alerts as $a)
                    <div class="p-3 border-bottom {{ $a->status == 'active' ? 'bg-danger-subtle' : '' }}"
                         style="{{ $a->status == 'active' ? 'background:#fff5f5;' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ $a->user->name ?? 'Unknown' }}</strong>
                                <span class="badge badge-{{ $a->status == 'active' ? 'danger' : 'secondary' }} ml-1">{{ $a->status }}</span>
                                <br><small>{{ $a->user->mobile ?? '' }} • {{ $a->created_at->diffForHumans() }}</small>
                                @if($a->user && $a->user->emergency_contact_phone)
                                    <br><small class="text-muted">Emergency: {{ $a->user->emergency_contact_name }} — {{ $a->user->emergency_contact_phone }}</small>
                                @endif
                                @if($a->latitude)
                                    <br><small><a href="https://www.google.com/maps?q={{ $a->latitude }},{{ $a->longitude }}" target="_blank">📍 {{ $a->latitude }}, {{ $a->longitude }}</a></small>
                                @endif
                            </div>
                            @if($a->status == 'active')
                                <form method="POST" action="{{ route('admin.ride-ops.sos.resolve', $a->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">Resolve</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-shield-alt fa-3x text-success"></i>
                        <h6 class="mt-3 text-muted">No SOS alerts — all clear</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    (function () {
        var points = @json($points);
        // Center on the first alert, else default to Dhaka.
        var center = points.length ? [points[0].lat, points[0].lng] : [23.8103, 90.4125];
        var map = L.map('sosMap').setView(center, points.length ? 13 : 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap', maxZoom: 19
        }).addTo(map);

        points.forEach(function (p) {
            var color = p.status === 'active' ? '#dc3545' : '#6c757d';
            var marker = L.circleMarker([p.lat, p.lng], {
                radius: 10, color: color, fillColor: color, fillOpacity: 0.7, weight: 2
            }).addTo(map);
            marker.bindPopup(
                '<strong>' + p.name + '</strong><br>' + p.mobile +
                '<br><span style="color:' + color + '">● ' + p.status + '</span>' +
                '<br><small>' + p.time + '</small>'
            );
            if (p.status === 'active') marker.openPopup();
        });

        // Auto-refresh to keep it live.
        setTimeout(function () { location.reload(); }, 20000);
    })();
</script>
@endsection
