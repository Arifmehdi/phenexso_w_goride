@extends('admin.master')
@section('title',"Admin Dashboard | All Galleries")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card mb-2 shadow-lg">
                <div class="card-header- px-2 py-2 d-flex justify-content-between align-items-center">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-sitemap text-primary"></i> Galleries
                    </h3>
                    <a href="{{ route('galleries.create') }}" class="btn btn-outline-primary btn-xs py-1">
                        <i class="fas fa-plus-square"></i> Add New Galleries
                    </a>
                </div>
           
            </div>
            <div class="card-body">
                 <div class="table-responsive">
                    <table class="table table-borderd table-sm">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Action</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>File</th>
                                <th>Priority</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = (($galleries->currentPage() - 1) * $galleries->perPage() + 1); ?>
                            @forelse ($galleries as $gallery)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>

                                    <td class="d-flex">
                                    <a href="{{route('galleries.edit',$gallery)}}" class="text-success mr-2"><i class="fas fa-edit"></i></a>

                                        <form action="{{route('galleries.destroy', $gallery) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button href="{{route('galleries.destroy', $gallery)}}" class="text-danger" onclick="return confirm('Are you sure? you want to delete this gallery Item?')" style="all:unset; cursor: pointer;"><i class="fas fa-trash"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $gallery->title }}</td>
                                    <td>{{ $gallery->file_type }}</td>
                                    <td>
                                        @if($gallery->file_type == 'image')
                                            <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $gallery->featured_image ]) }}" alt="" width="50">
                                        @elseif($gallery->file_type == 'video')
                                            @if($gallery->thumbnail_image)
                                                <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $gallery->thumbnail_image ]) }}" alt="" width="50">
                                            @else
                                                <video width="50" controls>
                                                    <source src="{{ asset('storage/galleries/' . $gallery->featured_image) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $gallery->priority }}</td>
                                    <td>
                                        @if ($gallery->active)
                                        <span class="badge badge-primary">Active</span>
                                        @endif

                                    </td>
                                 
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-danger h5 text-center">No gallery Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $galleries->links() }}
                 </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
