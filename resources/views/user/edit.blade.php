@extends('user.master')
@section('body')
            <section class="pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">User Update</h3>
                                </div>


                                <form action="{{route('user.profile-update',$user->id)}}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                                            @error('name')
                                            <div class="alert alert-danger mt-2">{{'Select an User Name'}}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control"  value="{{$user->email}}" readonly>
                                            @error('email')
                                            <div class="alert alert-danger mt-2">{{'Select an User Name'}}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary" value="Update Detail">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                    <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                                </div>


                                <form action="{{route('user.change-password',$user->id)}}" method="post">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="">Old Password</label>
                                            <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
                                            @error('old_password')
                                            <div class="alert alert-danger">{{'Select an User Name'}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">New Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                                            @error('password')
                                            <div class="alert alert-danger">{{'Select an User Name'}}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary" value="Change Password User">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
@endsection
