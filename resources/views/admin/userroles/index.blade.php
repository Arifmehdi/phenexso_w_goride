@extends('admin.master')
@section('body')
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Users of Role</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="20">SL NO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    @if($user->hasAnyRole())
                                                        @foreach($user->roles as $role)
                                                            <span class="bg-success mr-2">{{$role->role_value}}</span>
                                                        @endforeach
                                                        <a href="{{route('admin.manage-role')}}" class="btn btn-xs btn-outline-primary "><i class="fa fa-edit"></i> Manage</a>
                                                    @else
                                                        <a href="{{route('admin.assign-role')}}" class="btn btn-xs btn-outline-primary "><i class="fa fa-plus"></i> Assign Role</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
