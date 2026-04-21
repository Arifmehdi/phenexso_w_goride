@extends('admin.master')
@section('title',"Admin Dashboard | Create Vehicle")

@section('body')
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="pt-3">
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title">Create New Vehicle</div>
        </div>
        <form action="{{ route('admin.vehicles.store') }}" method="POST">
            @csrf
            <div class="card-body w3-light-gray">
                <div class="row py-2">
                    <div class="col-12 col-md-12 m-auto card p-5">

                        <div class="form-group">
                            <label for="name">Vehicle Type Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Vehicle Type Name" name="vehicle_type" value="{{ old('vehicle_type') }}">
                            @error('vehicle_type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="plate_number">Plate Number</label>
                            <input type="text" class="form-control @error('plate_number') is-invalid @enderror" placeholder="Plate Number" name="plate_number" value="{{ old('plate_number') }}">
                            @error('plate_number')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacity (in kg or units)</label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" placeholder="Capacity" name="capacity" value="{{ old('capacity') }}">
                            @error('capacity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rider_id">Assign Rider</label>
                            <select name="rider_id" id="rider_id" class="form-control @error('rider_id') is-invalid @enderror">
                                <option value="">Select Rider</option>
                                @foreach($riders as $rider)
                                    <option value="{{ $rider->id }}" {{ old('rider_id') == $rider->id ? 'selected' : '' }}>
                                        {{ $rider->name }} ({{ $rider->mobile }})
                                    </option>
                                @endforeach
                            </select>
                            @error('rider_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2" value="Save Vehicle">
            </div>
        </form>
    </div>
</section>
@endsection
