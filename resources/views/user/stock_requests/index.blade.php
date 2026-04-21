@extends('user.master')
@section('title',"User Dashboard | My Stock Requests")

@section('body')
<div class="container py-3">
    <a href="{{ route('user.stock_requests.create') }}" class="btn btn-success mb-2">Add New Stock Request</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Collection Date & Time</th>
                <th>Collection Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stockRequests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->product->name }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($request->collection_datetime)->format('d-m-Y h:i A') }}</td>
                    <td>{{ $request->collection_location }}</td>
                    <td><span class="badge badge-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'accepted' ? 'info' : 'success') }}">{{ ucfirst($request->status) }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No stock requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $stockRequests->links() }}
    </div>
</div>
@endsection