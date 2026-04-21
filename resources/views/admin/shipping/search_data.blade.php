<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>SL</th>
            <th>Action</th>
            <th>Name</th>
            <th>Tagline</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Image</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = (($ambulances->currentPage() - 1) * $ambulances->perPage() + 1); ?>
        @forelse ($ambulances as $ambulance)
            <tr style="height: {{ $ambulances->count() < 3 ? '80px' : '' }};">
                <td>{{ $i++ }}</td>

                <td>
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item" href="{{route('ambulances.edit',$ambulance)}}"><i class="fas fa-edit"></i>edit</a>
                            <form action="{{route('ambulances.destroy', $ambulance) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item ml-3" onclick="return confirm('Are you sure? you want to delete this gallery Item?')" style="all:unset; cursor: pointer;"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>

                </td>
                <td>{{ Str::ucfirst($ambulance->name) }}</td>
                <td>{{ Str::ucfirst($ambulance->tagline) }}</td>
                <td>{{ $ambulance->email }}</td>
                <td>{{ $ambulance->mobile }}</td>
                <td>{{ $ambulance->address }}</td>

                <td>
                    <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $ambulance->fi() ]) }}" alt="">
                </td>


                <td>
                    <input type="checkbox" name="toogle" data-url="{{route('ambulanceActive')}}" value="{{$ambulance->id}}" data-toggle="toggle" data-size="sm" {{$ambulance->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="9" class="text-danger h5 text-center">No Doctor Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $ambulances->links() }}