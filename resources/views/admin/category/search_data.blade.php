<table id="example1" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="100">Action</th>
        <th>Name</th>
        <th>Active</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($categories->currentPage() - 1) * $categories->perPage() + 1); ?>
    @foreach($categories as $category)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <a href="{{route('categories.show',$category->id)}}" class="btn btn-xs btn-outline-info mr-1 float-left"><i class="fa fa-eye"></i></a>
                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-xs btn-outline-primary mr-1 float-left"><i class="fa fa-edit"></i></a>

                <form action="{{route('categories.destroy',$category->id)}}" method="post" onclick="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-xs btn-outline-danger mr-1 float-left" style="cursor: pointer;"><i class="fa fa-trash"></i></button>

                </form>
            </td>
            <td>{{$category->name}}</td>
            <td>
                <input type="checkbox" name="toogle" data-url="{{route('category.active')}}" value="{{$category->id}}" data-toggle="toggle" data-size="sm" {{$category->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

{{ $categories->render() }}
