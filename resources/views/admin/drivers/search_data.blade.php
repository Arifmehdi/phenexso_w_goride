<table id="example1" class="table table-sm table-bordered table-striped text-nowrap">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="100">Action</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>License No</th>
        <th>NID</th>
        <th>Address</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($drivers->currentPage() - 1) * $drivers->perPage() + 1); ?>

        @foreach($drivers as $driver)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <div class="dropdown show">
                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{$driver->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{$driver->id}}">
                        <a class="dropdown-item" href="{{route('admin.drivers.edit',$driver->id)}}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>{{$driver->name}}</td>
            <td>{{$driver->mobile}}</td>
            <td>{{$driver->email}}</td>
            <td>{{$driver->license_no}}</td>
            <td>{{$driver->nid}}</td>
            <td>{{Str::limit($driver->address, 30)}}</td>
            <td><span class="badge badge-{{ $driver->status == '1' ? 'success' : 'warning' }}">{{ $driver->status == '1' ? 'Approved' : 'Pending' }}</span></td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $drivers->render() }}
