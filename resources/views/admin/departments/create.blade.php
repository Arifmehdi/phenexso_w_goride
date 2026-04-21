@extends('admin.master')
@section('title',"Admin Dashboard | Create How Works")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Create How Works</div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">How Works Title</label>
                                <input type="text" class="form-control @error('name_en') is_invalid @enderror" id="" placeholder="Department Name" name="name_en" value="{{ old('name_en') }}">
                                @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>                       

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="excerpt_en" id="" cols="30" rows="5" class="form-control" placeholder="Description">{{old('excerpt_en')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Image</label>
                               <input type="file" name="image" class="form-control">
                               @error('image')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="featured" name="featured" {{ old('featured') ? "checked" : "" }}>
                                <label class="form-check-label" for="exampleCheck1">Featured</label>
                            </div>

                            <input type="submit" class="btn btn-success mt-2">

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection

