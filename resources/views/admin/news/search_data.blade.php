<table id="example1" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="20">SL</th>
        <th width="100">Action</th>
        <th>Title</th>
        <th>Image</th>
        <th>Active</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = (($newses->currentPage() - 1) * $newses->perPage() + 1); ?>
    @foreach($newses as $news)
        <tr>
            <td>{{$i++}}</td>
            <td>
                <a href="{{route('news.show',$news->id)}}" class="btn btn-xs btn-outline-info mr-1 float-left"><i class="fa fa-eye"></i></a>
                <a href="{{route('news.edit',$news->id)}}" class="btn btn-xs btn-outline-primary mr-1 float-left"><i class="fa fa-edit"></i></a>

                <form action="{{route('news.destroy',$news->id)}}" method="post" onclick="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs btn-outline-danger mr-1 float-left" style="cursor: pointer;"><i class="fa fa-trash"></i></button>
                </form>
            </td>
            <td>{{$news->title}}</td>
            <td>
                <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $news->fi()]) }}" alt="post">
            </td>
            <td>
                <input type="checkbox" name="toogle" data-url="{{route('news.active')}}" value="{{$news->id}}" data-toggle="toggle" data-size="sm" {{$news->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
            </td>
            <td>{{$news->status}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
{{ $newses->render() }}



