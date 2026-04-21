@extends('admin.master')

@section('title', 'Testimonial Details')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Testimonial Details</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <p>{{ $testimonial->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="company">Company:</label>
                        <p>{{ $testimonial->company ?? 'N/A' }}</p>
                    </div>
                    <div class="form-group">
                        <label for="text">Testimonial Text:</label>
                        <p>{{ $testimonial->text }}</p>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <p>{{ $testimonial->rating }}</p>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        @if ($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" width="150">
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection