@extends('admin.master')
@section('title',"Admin Dashboard | Vehicle Assignments")

@section('body')
    <div class="container py-3">
    <a href="{{ route('admin.vehicle_assignments.create') }}" class="btn btn-success mb-2">Add New Vehicle Assignment</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info">
            <h5 class="mb-0 text-white">All Vehicle Assignments</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vehicle</th>
                        <th>Driver</th>
                        <th>Product</th>
                        <th>Farmer</th>
                        <th>Quantity</th>
                        <th>Delivery Location</th>
                        <th>Delivery Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicleAssignments as $assignment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $assignment->vehicle->name ?? 'N/A' }} ({{ $assignment->vehicle->plate_number ?? 'N/A' }})</td>
                            <td>{{ $assignment->driver->name ?? 'N/A' }} ({{ $assignment->driver->mobile ?? 'N/A' }})</td>
                            <td>{{ $assignment->product->name_en ?? 'N/A' }}</td>
                            <td>{{ $assignment->farmer->name ?? 'N/A' }}</td>
                            <td>{{ $assignment->quantity }}</td>
                            <td>{{ $assignment->delivery_location }}</td>
                            <td>{{ \Carbon\Carbon::parse($assignment->delivery_time)->format('d-m-Y h:i A') }}</td>
                            <td><span class="badge badge-{{ $assignment->status == 1 ? 'info' : ($assignment->status == 2 ? 'primary' : 'success') }}">{{ $assignment->status == 1 ? 'Assigned' : ($assignment->status == 2 ? 'On the Way' : 'Delivered') }}</span></td>
                            <td>
                                <a href="{{ route('admin.vehicle_assignments.edit', $assignment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.vehicle_assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No vehicle assignments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $vehicleAssignments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
