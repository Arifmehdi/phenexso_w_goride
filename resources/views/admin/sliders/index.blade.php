@extends('admin.master')
@section('title',"Admin Dashboard | Front Sliders")

@section('body')
   <section class="pt-5">
    <div class="card shadow bg-info">
        <div class="card-header">
            <div class="card-title">Front Slider</div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5 m-auto">
            <div class="card">
                <div class="card-header text-info">
                    <div class="card-title">Add Slider</div>
                </div>

                <div class="card-body">
                    <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title  here" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Description Here"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Link here...">
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control">
                            @error('featured_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="active"><input type="checkbox" name="active" id="active"> Active</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title">All Sliders</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderd table-sm">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Action</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Featured Image</th>
                            <th>Linik</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = (($sliders->currentPage() - 1) * $sliders->perPage() + 1); ?>
                        @forelse($sliders as $slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td class="d-flex">
                            <a href="{{route('sliders.edit',$slider)}}" data-toggle="modal" data-target="#fsedit{{$slider->id}}" class="text-success mr-2"><i class="fas fa-edit"></i></a>

                            <form action="{{route('sliders.destroy', $slider) }}" method="post">
                                @csrf
                                @method('delete')
                                <button href="{{route('sliders.destroy', $slider)}}" class="text-danger" onclick="return confirm('Are you sure? you want to delete this Slider Item?')" style="all:unset; cursor: pointer;"><i class="fas fa-trash"></i></button>
                            </form>

                            </td>

                            <td>{{ $slider->title}}</td>
                            <td>{{ $slider->description }}</td>
                            <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $slider->fi() ]) }}" alt=""></td>
                            <td>{{$slider->link}}</td>
                            <td>
                            @if ($slider->active)
                            <span class="badge badge-success">Actived</span>
                            @else
                            <span class="badge badge-danger">Inactived</span>
                            @endif
                            </td>
                        </tr>


                          {{-- MODAL START --}}
                          <div class="modal fade" id="fsedit{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('sliders.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" placeholder="Title  here"
                                                    class="form-control @error('title') is_invalid @enderror" value="{{ $slider->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tag">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Description Here"> {{ $slider->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="link">Link</label>
                                                <input type="text" name="link" id="link" class="form-control" placeholder="Link here..." value="{{ $slider->link ?? ""}}">
                                                @error('link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        <div class="form-group">
                                            <label for="featured_image">Featured Iamge</label><br>
                                            <input type="file" name="featured_image" id="featured_image">
                                            <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $slider->fi() ]) }}" alt="">
                                            @error('featured_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="active"><input type="checkbox" {{$slider->active? 'checked' : ''}} name="active" id="active"> Active</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>

                              </div>
                            </div>
                        </div>
                        {{-- MODAL END --}}
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger h5 text-center">No Slider Found</td>
                        </tr>
                       @endforelse
                    </tbody>
                </table>
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
   </section>
@endsection




