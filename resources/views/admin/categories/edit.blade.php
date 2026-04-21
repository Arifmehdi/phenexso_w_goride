@extends('admin.master')
@section('title',"Admin Dashboard | Category Edit")
@section('body')
    <section class="pt-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>

            <form action="{{route('categories.update',$category->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{$category->name}}" placeholder="Enter Category Name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="mr-3"><input type="checkbox"  name="active" value="1" {{ $category->active === 1 ? 'checked' : ' ' }}> Active</label>
                    </div>

                </div>

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
    </section>
@endsection
