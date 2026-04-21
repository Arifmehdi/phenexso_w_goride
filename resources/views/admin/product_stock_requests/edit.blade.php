@extends('admin.master')
@section('title',"Admin Dashboard | Edit Product Stock Request")

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
            <div class="card-title">Edit Product Stock Request</div>
        </div>
        <form action="{{ route('admin.stock_requests.update', $productStockRequest->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body w3-light-gray">
                <div class="row py-2">
                    <div class="col-12 col-md-12 m-auto card p-5">

                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $productStockRequest->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id', $productStockRequest->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name_en }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity" name="quantity" value="{{ old('quantity', $productStockRequest->quantity) }}" step="0.01">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="collection_datetime">Collection Date and Time</label>
                            <input type="datetime-local" class="form-control @error('collection_datetime') is-invalid @enderror" name="collection_datetime" value="{{ old('collection_datetime', \Carbon\Carbon::parse($productStockRequest->collection_datetime)->format('Y-m-d\TH:i')) }}">
                            @error('collection_datetime')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="collection_location">Collection Location</label>
                            <textarea name="collection_location" id="collection_location" class="form-control @error('collection_location') is-invalid @enderror" rows="3">{{ old('collection_location', $productStockRequest->collection_location) }}</textarea>
                            @error('collection_location')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status', $productStockRequest->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $productStockRequest->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $productStockRequest->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2" value="Update Request">
            </div>
        </form>
    </div>
</section>
@endsection
