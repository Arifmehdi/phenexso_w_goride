@extends('admin.master')
@section('body')
    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">All Users of Role</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="20">SL</th>
                                        <th width="100">Action</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role name</th>
                                        <th>Role Value</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <a href="{{route('admin.edit-role',$role->id)}}" class="btn btn-xs btn-outline-primary {{$role->user_id==Auth::user()->id ? 'disabled' : '' }}"><i class="fa fa-edit"></i></a>
                                                {{--<a href="{{route('admin.delete-role',$role->id)}}" class="btn btn-xs btn-outline-danger {{$role->user_id==Auth::user()->id ? 'disabled' : '' }}" ><i class="fa fa-trash"></i></a>--}}
                                            </td>
                                            @if(isset($role->user->name))
                                            <td>{{$role->user->name}}</td>
                                            <td>{{$role->user->email}}</td>
                                            @endif
                                            <td>{{$role->role_name}}</td>
                                            <td>{{$role->role_value}}</td>
                                            <td>{{ $role->created_at->diffForHumans() }}</td>

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

