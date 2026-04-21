<div class="card shadow mt-3">
    <div class="card-header">
        <h3 class="card-title">Assign Rider & Vehicle</h3>
    </div>
    <form action="{{ route('admin.assignDriver', $order->id) }}" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="driver_id">Rider (Driver)</label>
                        <select name="driver_id" id="driver_id" class="form-control" required onchange="updateVehicle(this)">
                            <option value="">Select Rider</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $driver->id == $order->driver_id ? 'selected' : '' }} data-vehicle="{{ $driver->vehicle_id }}">
                                    {{ $driver->name }} ({{ $driver->mobile }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="vehicle_id">Vehicle</label>
                        <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                            <option value="">Select Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $vehicle->id == $order->vehicle_id ? 'selected' : '' }}>
                                    {{ $vehicle->plate_number }} ({{ $vehicle->vehicle_type }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Assign</button>
                    </div>
                </div>
            </div>
            @if($order->assigned_at)
                <div class="text-success mt-2">
                    <i class="fas fa-check-circle"></i> Assigned at: {{ $order->assigned_at->format('d M, Y h:i A') }}
                </div>
            @endif
        </div>
    </form>
</div>

<script>
    function updateVehicle(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var vehicleId = selectedOption.getAttribute('data-vehicle');
        var vehicleSelect = document.getElementById('vehicle_id');
        
        if (vehicleId) {
            vehicleSelect.value = vehicleId;
        } else {
            vehicleSelect.value = "";
        }
    }
</script>
