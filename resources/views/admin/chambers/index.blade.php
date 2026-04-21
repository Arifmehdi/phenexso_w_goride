@extends('admin.master')
@section('title',"Admin Dashboard | Chamber Locations")

@section('body')
<section class="pt-3">
    <div class="card">
        <div class="card-header bg-info py-2">
            <div class="card-title pt-1">Chamber Locations</div>
            <div class="card-tools">
                 <a href="{{ route('chambers.create') }}" class="btn btn-success py-1">Add New Chamber</a>
            </div>
        </div>
        <div class="card-body w3-light-gray">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Chamber Title</th>
                        <th>Address</th>
                        <th>Schedules</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chambers as $index => $chamber)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $chamber->doctor->name_en }}</td>
                            <td>{{ $chamber->chamber_title }}</td>
                            <td>{{ $chamber->address }}</td>
                            <td>
                                <ul class="mb-0">
                                    @foreach($chamber->schedules as $schedule)
                                        <li>{{ $schedule['day'] }} - {{ $schedule['time'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('chambers.edit', $chamber->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('chambers.destroy', $chamber->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Chamber Locations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
