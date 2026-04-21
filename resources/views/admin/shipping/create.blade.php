@extends('admin.master')
@section('title',"Admin Dashboard | Shipping Method")

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
            <div class="card-title">Shipping Method</div>
        </div>
        <form action="{{ route('shipping.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body w3-light-gray">
                <div class="row py-2">
                    <div class="col-12 col-md-12 m-auto card p-5">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is_invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control @error('location') is_invalid @enderror" placeholder="Location" name="location" value="{{ old('location') }}">
                            @error('location')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control @error('price') is_invalid @enderror" placeholder="Price" name="price" value="{{ old('price') }}">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ✅ New Checkbox Field -->
                        <div class="form-group form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="is_free" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_free">Is Free Shipping</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2" value="Save">
            </div>
        </form>
    </div>
</section>
@endsection
