@extends('admin.master')
@section('title',"Admin Dashboard | User Create")
@section('body')
            <section class="pt-5">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">User Create</h3>
                    </div>


                    <form action="{{route('admin.create-user')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="Enter Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Enter Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Enter Password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Create New User">
                        </div>
                    </form>
                </div>
            </section>
@endsection
