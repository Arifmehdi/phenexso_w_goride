@extends('admin.master')
@section('title')Admin | Rental Fleet @endsection
@section('content')

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-car"></i> Rental Fleet</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary" onclick="rentalNew()">
                <i class="fas fa-plus"></i> Add Car
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Type</th>
                    <th>Seats</th>
                    <th class="text-right">One-way</th>
                    <th class="text-right">With return</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $c)
                    <tr>
                        <td>
                            <strong>{{ $c->name }}</strong>
                            @if($c->plate_number)<br><small class="text-muted">{{ $c->plate_number }}</small>@endif
                        </td>
                        <td>{{ ucfirst($c->type) }}</td>
                        <td>{{ $c->seats }}</td>
                        <td class="text-right">৳{{ number_format($c->price_one_way) }}</td>
                        <td class="text-right">৳{{ number_format($c->price_with_return) }}</td>
                        <td>
                            @if($c->is_available)
                                <span class="badge badge-success">Available</span>
                            @else
                                <span class="badge badge-secondary">Unavailable</span>
                            @endif
                            @if($c->active_bookings)
                                <span class="badge badge-info">{{ $c->active_bookings }} booked</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <button class="btn btn-xs btn-outline-primary"
                                    onclick='rentalEdit(@json($c))'>Edit</button>
                            <form method="POST" action="{{ route('admin.rental.cars.toggle', $c->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-xs btn-outline-secondary">
                                    {{ $c->is_available ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.rental.cars.delete', $c->id) }}" class="d-inline"
                                  onsubmit="return confirm('Remove this car?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No cars yet — add your first one.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add / edit modal --}}
<div class="modal fade" id="rentalModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.rental.cars.save') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="r_id">
            <div class="modal-header">
                <h5 class="modal-title" id="rentalModalTitle">Add Car</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Name *</label>
                        <input name="name" id="r_name" class="form-control" required placeholder="Toyota Corolla">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Type</label>
                        <select name="type" id="r_type" class="form-control">
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="microbus">Microbus</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Seats</label>
                        <input type="number" name="seats" id="r_seats" class="form-control" value="4" min="1" max="60">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Price — one way (৳) *</label>
                        <input type="number" step="0.01" min="0" name="price_one_way" id="r_p1" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Price — with return (৳) *</label>
                        <input type="number" step="0.01" min="0" name="price_with_return" id="r_p2" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Plate number</label>
                        <input name="plate_number" id="r_plate" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Transmission</label>
                        <select name="transmission" id="r_trans" class="form-control">
                            <option>Manual</option>
                            <option>Automatic</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Fuel</label>
                        <select name="fuel" id="r_fuel" class="form-control">
                            <option>Petrol</option>
                            <option>Diesel</option>
                            <option>CNG</option>
                            <option>Octane</option>
                            <option>Electric</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Image path</label>
                        <input name="image" id="r_image" class="form-control" placeholder="assets/car1.png">
                    </div>
                </div>
                <div class="form-group">
                    <label>Features <small class="text-muted">(comma separated)</small></label>
                    <input name="features" id="r_features" class="form-control" placeholder="AC, Music System, Comfortable Seats">
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="is_available" id="r_avail" value="1" checked>
                    <label class="custom-control-label" for="r_avail">Available for booking</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Car</button>
            </div>
        </form>
    </div>
</div>

<script>
function rentalNew() {
    document.getElementById('rentalModalTitle').textContent = 'Add Car';
    ['r_id','r_name','r_plate','r_image','r_features'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('r_seats').value = 4;
    document.getElementById('r_p1').value = '';
    document.getElementById('r_p2').value = '';
    document.getElementById('r_avail').checked = true;
    $('#rentalModal').modal('show');
}

function rentalEdit(car) {
    document.getElementById('rentalModalTitle').textContent = 'Edit Car';
    document.getElementById('r_id').value = car.id;
    document.getElementById('r_name').value = car.name || '';
    document.getElementById('r_type').value = car.type || 'sedan';
    document.getElementById('r_seats').value = car.seats || 4;
    document.getElementById('r_p1').value = car.price_one_way || 0;
    document.getElementById('r_p2').value = car.price_with_return || 0;
    document.getElementById('r_plate').value = car.plate_number || '';
    document.getElementById('r_trans').value = car.transmission || 'Manual';
    document.getElementById('r_fuel').value = car.fuel || 'Petrol';
    document.getElementById('r_image').value = car.image || '';
    document.getElementById('r_features').value = car.features || '';
    document.getElementById('r_avail').checked = !!car.is_available;
    $('#rentalModal').modal('show');
}
</script>

@endsection
