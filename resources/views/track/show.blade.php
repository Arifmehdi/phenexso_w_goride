<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GoRide — Live Trip Tracking</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: Arial, sans-serif; background: #f5f5f5; }
  .header { background: #10713C; color: white; padding: 16px 20px; display: flex; align-items: center; gap: 12px; }
  .header h1 { font-size: 18px; }
  .header .logo { font-size: 24px; }
  #map { width: 100%; height: 60vh; }
  .card { background: white; margin: 12px; border-radius: 12px; padding: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0; }
  .row:last-child { border: none; }
  .label { color: #888; font-size: 13px; }
  .value { font-weight: 600; font-size: 14px; color: #222; }
  .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
  .status-in_progress { background: #e8f5e9; color: #10713C; }
  .status-arriving { background: #fff3e0; color: #e65100; }
  .status-completed { background: #e3f2fd; color: #1565c0; }
  .expired { text-align: center; padding: 40px 20px; color: #888; }
  .expired h2 { font-size: 20px; margin-bottom: 8px; color: #555; }
  .route-row { display: flex; align-items: flex-start; gap: 10px; padding: 6px 0; }
  .route-dot { width: 12px; height: 12px; border-radius: 50%; margin-top: 3px; flex-shrink: 0; }
  .dot-green { background: #10713C; }
  .dot-red { background: #ED1C24; }
  .refresh-note { text-align: center; color: #aaa; font-size: 11px; padding: 8px; }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>

@if($expired)
  <div class="header"><span class="logo">🚗</span><h1>GoRide</h1></div>
  <div class="expired">
    <h2>This tracking link has expired</h2>
    <p>Tracking links are valid for 24 hours from when they were created.</p>
  </div>
@else
  <div class="header">
    <span class="logo">🚗</span>
    <div>
      <h1>GoRide — Live Tracking</h1>
      <div style="font-size:12px;opacity:0.8;">Tracking {{ $ride['rider_name'] ?? 'Passenger' }}'s trip</div>
    </div>
  </div>

  <div id="map"></div>

  <div class="card">
    <div class="row">
      <span class="label">Status</span>
      <span class="value status-badge status-{{ $ride['status'] }}">
        {{ ucfirst(str_replace('_', ' ', $ride['status'])) }}
      </span>
    </div>
    <div class="row">
      <span class="label">Driver</span>
      <span class="value">{{ $ride['driver_name'] ?? 'Assigned' }}
        @if($ride['driver_rating']) ⭐ {{ number_format($ride['driver_rating'], 1) }} @endif
      </span>
    </div>
    <div class="row">
      <span class="label">Fare</span>
      <span class="value">৳{{ number_format($ride['fare'], 0) }}</span>
    </div>
  </div>

  <div class="card">
    <div class="route-row">
      <div class="route-dot dot-green"></div>
      <div><div class="label">Pickup</div><div class="value" style="font-size:13px">{{ $ride['pickup_address'] }}</div></div>
    </div>
    <div style="width:2px;height:16px;background:#ddd;margin-left:5px;"></div>
    <div class="route-row">
      <div class="route-dot dot-red"></div>
      <div><div class="label">Destination</div><div class="value" style="font-size:13px">{{ $ride['destination_address'] }}</div></div>
    </div>
  </div>

  <p class="refresh-note">Location updates every 5 seconds • Powered by GoRide</p>

  <script>
    const firebaseTripId = "{{ $ride['firebase_trip_id'] ?? '' }}";
    const firebaseConfig = {!! json_encode(config('services.firebase.web_config')) !!};

    // Leaflet map centered on Dhaka
    const map = L.map('map').setView([23.8103, 90.4125], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const driverIcon = L.divIcon({
      html: '<div style="background:#10713C;color:white;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;font-size:18px;border:2px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);">🚗</div>',
      iconSize: [36, 36], iconAnchor: [18, 18],
    });

    let driverMarker = null;

    // Poll driver location from backend every 5 seconds
    async function refreshLocation() {
      try {
        const res = await fetch('/api/public/track/{{ $token }}/location');
        const data = await res.json();
        if (data.lat && data.lng) {
          const pos = [data.lat, data.lng];
          if (!driverMarker) {
            driverMarker = L.marker(pos, { icon: driverIcon }).addTo(map);
          } else {
            driverMarker.setLatLng(pos);
          }
          map.setView(pos, 15);
        }
      } catch(e) {}
    }

    refreshLocation();
    setInterval(refreshLocation, 5000);
  </script>
@endif
</body>
</html>
