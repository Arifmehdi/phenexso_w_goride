@extends('admin.master')
@section('title',"Admin DashBoard | Assign Role")
@section('body')
            <section class="pt-5">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Assign Role</h3>
                    </div>


                    <form action="{{route('admin.assign-role')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <select name="user_id" class="form-control" required id="select2">
                                    <option disabled >--  Select Role --</option>
                                        @foreach($users as $user)
                                            @if($user->hasAnyRole())
                                            @else
                                                <option value="{{$user->id}}">{{$user->name}}, Email: {{$user->email}}</option>
                                            @endif
                                        @endforeach
                                </select>


                                <input type="number" name="added_by_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" hidden>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Value</label>
                                <select name="role_name" class="form-control" required>
                                    <option disabled >--  Select Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->role_name}}">{{$role->role_value}}</option>
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

@push('js')
<script>
    $(function () {
        $('#select2').select2()
    })
</script>
@endpush
