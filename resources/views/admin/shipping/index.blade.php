@extends('admin.master')
@section('title',"Admin Dashboard | shipping Method")

@section('body')
    <div class="container py-3">
    <a href="{{ route('shipping.create') }}" class="btn btn-success mb-2">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Location Name</th>
                <th>Price</th>
                <th>Location</th>
                <th>Is Free</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($methods as $method)
           
                <tr>
                    <td>{{ $method->id }}</td>
                    <td>{{ $method->name }}</td>
                    <td>{{ number_format($method->price, 2) }}</td>
                    <td>{{ $method->location }} {{ $method->same_day ? '(Same Day)' : '' }}</td>
                    <td>{{ $method->is_free == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('shipping.edit', $method->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('shipping.destroy', $method->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


@push('js')
   

@endpush
