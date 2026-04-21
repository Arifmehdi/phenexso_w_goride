@extends('admin.master')
@section('title',"Admin Dashboard | Edit Vehicle Assignment")

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
            <div class="card-title">Edit Vehicle Assignment</div>
        </div>
        <form action="{{ route('admin.vehicle_assignments.update', $vehicleAssignment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body w3-light-gray">
                <div class="row py-2">
                    <div class="col-12 col-md-12 m-auto card p-5">

                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror">
                                <option value="">Select a Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $vehicleAssignment->vehicle_id) == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }} ({{ $vehicle->plate_number }})</option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="driver_id">Driver</label>
                            <select name="driver_id" id="driver_id" class="form-control @error('driver_id') is-invalid @enderror">
                                <option value="">Select a Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id', $vehicleAssignment->driver_id) == $driver->id ? 'selected' : '' }}>{{ $driver->name }} ({{ $driver->mobile }})</option>
                                @endforeach
                            </select>
                            @error('driver_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                <option value="">Select a Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id', $vehicleAssignment->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name_en }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="farmer_id">Farmer</label>
                            <select name="farmer_id" id="farmer_id" class="form-control @error('farmer_id') is-invalid @enderror">
                                <option value="">Select a Farmer</option>
                                @foreach($farmers as $farmer)
                                    <option value="{{ $farmer->id }}" {{ old('farmer_id', $vehicleAssignment->farmer_id) == $farmer->id ? 'selected' : '' }}>{{ $farmer->name }} ({{ $farmer->email }})</option>
                                @endforeach
                            </select>
                            @error('farmer_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity" name="quantity" value="{{ old('quantity', $vehicleAssignment->quantity) }}" step="0.01">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="delivery_location">Delivery Location</label>
                            <input type="text" class="form-control @error('delivery_location') is-invalid @enderror" placeholder="Delivery Location" name="delivery_location" value="{{ old('delivery_location', $vehicleAssignment->delivery_location) }}">
                            @error('delivery_location')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="delivery_time">Delivery Time</label>
                            <input type="datetime-local" class="form-control @error('delivery_time') is-invalid @enderror" name="delivery_time" value="{{ old('delivery_time', \Carbon\Carbon::parse($vehicleAssignment->delivery_time)->format('Y-m-d\TH:i')) }}">
                            @error('delivery_time')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $vehicleAssignment->status) == '1' ? 'selected' : '' }}>Assigned</option>
                                <option value="2" {{ old('status', $vehicleAssignment->status) == '2' ? 'selected' : '' }}>On the Way</option>
                                <option value="3" {{ old('status', $vehicleAssignment->status) == '3' ? 'selected' : '' }}>Delivered</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2" value="Update Assignment">
            </div>
        </form>
    </div>
</section>
@endsection
