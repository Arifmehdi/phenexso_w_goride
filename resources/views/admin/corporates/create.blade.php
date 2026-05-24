@extends('admin.master')
@section('title',"Admin Dashboard | Create Corporate")

@section('body')
<div class="container py-3">
    <div class="card">
        <div class="card-header bg-indigo" style="background-color: #6610f2 !important;">
            <h5 class="mb-0 text-white">Create New Corporate User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.corporates.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}">
                        @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required>
                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-indigo text-white" style="background-color: #6610f2 !important;">Create Corporate</button>
                    <a href="{{ route('admin.corporates.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
