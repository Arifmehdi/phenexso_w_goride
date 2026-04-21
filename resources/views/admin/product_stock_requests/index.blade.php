@extends('admin.master')
@section('title',"Admin Dashboard | Product Stock Requests")

@section('body')
    <div class="container py-3">
    <a href="{{ route('admin.stock_requests.create') }}" class="btn btn-success mb-2">Add New Stock Request</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-info">
            <h5 class="mb-0 text-white">Product Stock Requests</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Collection Date & Time</th>
                        <th>Collection Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockRequests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->user->name ?? 'N/A' }}</td>
                            <td>{{ $request->product->name_en ?? 'N/A' }}</td>
                            <td>{{ $request->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($request->collection_datetime)->format('d-m-Y h:i A') }}</td>
                            <td>{{ $request->collection_location }}</td>
                            <td><span class="badge badge-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">{{ ucfirst($request->status) }}</span></td>
                            <td>
                                <a href="{{ route('admin.stock_requests.edit', $request->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.stock_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No product stock requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $stockRequests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
