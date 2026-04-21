@extends('admin.master')
@section('title',"Admin Dashboard | Category Create")
@section('body')
    <section class="pt-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Category Create</h3>
            </div>

            <form action="{{route('categories.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Category Name">
                        @error('name')
                        <span style="color:red">{{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>

        </div>
    </section>
@endsection
