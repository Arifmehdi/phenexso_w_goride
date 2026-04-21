<table id="example1" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th wisth="100">Action</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        {{--<th>Temp Password</th>--}}
        <th>Approval</th>
    </tr>
    </thead>
    <tbody class="">
        <?php $i = (($users->currentPage() - 1) * $users->perPage() + 1); ?>

        @foreach($users as $user)
        <tr style="height: {{ $users->count() < 3 ? '100px' : '' }};">
            <td>{{$i++}}</td>
            <td>


                <div class="dropdown show">
                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <a class="dropdown-item" href="{{route('admin.edit-user',$user->id)}}"><i class="fas fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="{{route('admin.show-user',$user->id)}}"><i class="fa fa-eye"></i> Show</a>
                        {{-- <a class="dropdown-item" href="{{ route('patient.allvists',$user->id) }}"><i class="fas fa-users"></i> All Visits</a> --}}
                        <a class="dropdown-item" href="{{route('admin.delete-user',$user->id)}}"><i class="fa fa-trash"> Delete</i></a>

                    </div>
                </div>
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{ Str::ucfirst($user->role == 0 ? 'buyer' : $user->role) }}</td>
            {{--<td>{{ $user->password_temp }}</td>--}}
            <td>
                <form action="{{ route('admin.user.toggle-approval', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="isApprovedSwitch{{ $user->id }}" name="is_approve" onchange="this.form.submit()" {{ $user->is_approve ? 'checked' : '' }}>
                        <label class="custom-control-label" for="isApprovedSwitch{{ $user->id }}"></label>
                    </div>
                </form>
            </td>
        </tr>

    @endforeach

    </tbody>

</table>

{{ $users->render() }}



