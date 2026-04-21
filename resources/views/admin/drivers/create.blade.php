@extends('admin.master')
@section('title',"Admin Dashboard | Create Driver")

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
            <div class="card-title">Create New Driver</div>
        </div>
        <form action="{{ route('admin.drivers.store') }}" method="POST">
            @csrf
            <div class="card-body w3-light-gray">
                <div class="row py-2">
                    <div class="col-12 col-md-12 m-auto card p-5">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Driver Name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}">
                            @error('mobile')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Number" name="email" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="license_no">License No</label>
                            <input type="text" class="form-control @error('license_no') is-invalid @enderror" placeholder="License Number" name="license_no" value="{{ old('license_no') }}">
                            @error('license_no')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nid">NID</label>
                            <input type="text" class="form-control @error('nid') is-invalid @enderror" placeholder="NID Number" name="nid" value="{{ old('nid') }}">
                            @error('nid')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="vehicle_id">Assigned Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror">
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} ({{ $vehicle->vehicle_type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_approve">Status</label>
                            <select name="is_approve" id="is_approve" class="form-control @error('is_approve') is-invalid @enderror">
                                <option value="1" {{ old('is_approve') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_approve') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_approve')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2" value="Save Driver">
            </div>
        </form>
    </div>
</section>
@endsection
