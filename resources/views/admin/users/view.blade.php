@extends('admin.master')
@section('title',"Admin Dashboard | User Show")
@section('body')
    <section class="pt-5">
        <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$user->mobile}}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                            <td>{{ Str::ucfirst($user->role == 0 ? 'buyer' : $user->role) }}</td>
                        {{--@if(isset($user->roles))
                            <td>
                                @foreach($user->roles as $role)
                                    {{$role->role_name}}
                                @endforeach
                            </td>
                        @else
                            <td>{{ $user->role = 0 ? 'Buyer' : $user->role }}</td>
                        @endif--}}

                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
