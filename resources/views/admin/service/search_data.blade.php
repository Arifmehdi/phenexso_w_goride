<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>SL</th>
            <th>Action</th>
            <th>Sercice Name</th>
            <th>Image</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>


        <?php $i = (($hospitals->currentPage() - 1) * $hospitals->perPage() + 1); ?>
        @forelse ($hospitals as $hospital)

            <tr style="hehigt:200px;">
                <td>{{ $i++ }}</td>

                <td>
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item" href="{{route('services.edit',$hospital)}}"><i class="fas fa-edit"></i>edit</a>
                            {{-- <a class="dropdown-item" href="{{route('hospital.allvisits',$hospital)}}"><i class="fas fa-users"></i> All Visits</a> 
                            <a class="dropdown-item" href="{{route('hospital.alldoctors',$hospital)}}"><i class="fas fa-users"></i> All Doctors</a>--}}
                            <form action="{{route('services.destroy', $hospital) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item ml-3" onclick="return confirm('Are you sure? you want to delete this gallery Item?')" style="all:unset; cursor: pointer;"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>

                </td>
                <td>{{ $hospital->name_en }}</td>
                <td>
                    <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $hospital->fi() ]) }}" alt="">
                </td>


                <td>
                    <input type="checkbox" name="toogle" data-url="{{route('hospital.active')}}" value="{{$hospital->id}}" data-toggle="toggle" data-size="sm" {{$hospital->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                </td>

            </tr>


        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Bisesoggo Category Found</td>
            </tr>
        @endforelse
    </tbody>

</table>

{{ $hospitals->links() }}
