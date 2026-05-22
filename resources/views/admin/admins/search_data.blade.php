<table id="example1" class="table table-sm table-bordered table-striped text-nowrap">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="100">Action</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($admins->currentPage() - 1) * $admins->perPage() + 1); ?>

        @foreach($admins as $admin)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <div class="dropdown show">
                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{$admin->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{$admin->id}}">
                        <a class="dropdown-item" href="{{route('admin.admins.edit',$admin->id)}}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $admins->render() }}
