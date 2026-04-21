@extends('admin.master')
@section('title',"Admin Dashboard | Vehicles")

@section('body')
    <div class="container py-3">
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success mb-2">Add New Vehicle</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info">
            <h5 class="mb-0 text-white">All Vehicles</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vehicle Type</th>
                        <th>Plate Number</th>
                        <th>Capacity</th>
                        <th>Assigned Rider</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vehicle->vehicle_type }}</td>
                            <td>{{ $vehicle->plate_number }}</td>
                            <td>{{ $vehicle->capacity }}</td>
                            <td>
                                @if($vehicle->drivers->count() > 0)
                                    @foreach($vehicle->drivers as $rider)
                                        <span class="badge badge-secondary">{{ $rider->name }} ({{ $rider->mobile }})</span><br>
                                    @endforeach
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td><span class="badge badge-{{ $vehicle->status == '1' ? 'success' : ($vehicle->status == '0' ? 'warning' : 'danger') }}">{{ $vehicle->status == '1' ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No vehicles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
