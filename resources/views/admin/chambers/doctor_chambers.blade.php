@extends('admin.master')
@section('title', $doctor->name_en . " | Chambers")

@section('body')
<section class="pt-3">
    <div class="card">
         <div class="card-header bg-info py-2">
            <div class="card-title pt-1">Chamber Locations (Doctor Name : {{$doctor->name_en}})</div>
            <div class="card-tools">
                 <a href="{{ route('chambers.create', ['doctor_id' => $doctor]) }}" class="btn btn-success py-1">Add New Chamber</a>
            </div>
        </div>
        <div class="card-body w3-light-gray">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
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
                            <td colspan="5" class="text-center">No Chambers found for this doctor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
