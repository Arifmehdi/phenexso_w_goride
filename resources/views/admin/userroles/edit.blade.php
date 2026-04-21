@extends('admin.master')
@section('body')
    <section class="pt-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Assign Role</h3>
            </div>

            <form action="{{route('admin.update-role',$role->id)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" class="form-control" name="{{$role->user->id}}" value="Name: {{$role->user->name}}, Email: {{$role->user->email}}" readonly>
                        <input type="number" name="edited_by_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" hidden>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Role Name</label>
                        <select name="role_name" class="form-control">
                            <option disabled >--  Select Role --</option>
                            @foreach($roles as $role_item)
                                <option value="{{$role_item->role_name}}" {{$role->role_name==$role_item->role_name? 'selected':''}}>{{$role_item->role_value}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </section>
@endsection

