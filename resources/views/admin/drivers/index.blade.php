@extends('admin.master')
@section('title',"Admin Dashboard | Drivers")

@section('body')
    <div class="container py-3">
    <a href="{{ route('admin.drivers.create') }}" class="btn btn-success mb-2">Add New Driver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info">
            <h5 class="mb-0 text-white">All Drivers</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Name</th>
                        <th>License No</th>
                        <th>NID</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->mobile }}</td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->license_no }}</td>
                            <td>{{ $driver->nid }}</td>
                            <td>{{ $driver->address }}</td>
                            <td><span class="badge badge-{{ $driver->is_approve == '1' ? 'success' : 'warning' }}">{{ $driver->is_approve == '1' ? 'Approved' : 'Pending' }}</span></td>
                            <td>
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No drivers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $drivers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
