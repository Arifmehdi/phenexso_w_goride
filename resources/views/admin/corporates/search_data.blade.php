<table id="example1" class="table table-sm table-bordered table-striped text-nowrap">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="100">Action</th>
        <th>Name</th>
        <th>Company</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($corporates->currentPage() - 1) * $corporates->perPage() + 1); ?>

        @foreach($corporates as $corporate)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <div class="dropdown show">
                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{$corporate->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{$corporate->id}}">
                        <a class="dropdown-item" href="{{route('admin.corporates.show',$corporate->id)}}"><i class="fas fa-eye"></i> View Trips &amp; Billing</a>
                        <a class="dropdown-item" href="{{route('admin.corporates.edit',$corporate->id)}}"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.corporates.destroy', $corporate->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>{{$corporate->name}}</td>
            <td>{{$corporate->company_name}}</td>
            <td>{{$corporate->mobile}}</td>
            <td>{{$corporate->email}}</td>
            <td><span class="badge badge-{{ $corporate->status == 'active' ? 'success' : 'warning' }}">{{ ucfirst($corporate->status) }}</span></td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $corporates->render() }}
