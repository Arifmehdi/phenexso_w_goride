@extends('admin.master')
@section('title', 'Admin Dashboard | App Banners')

@section('body')
<section class="pt-5">
    <div class="card shadow bg-info">
        <div class="card-header"><div class="card-title">App Banners</div></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">
        {{-- Add form --}}
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header text-info"><div class="card-title">Add Banner</div></div>
                <div class="card-body">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.banners.form', ['banner' => null])
                        <button type="submit" class="btn btn-info">Add Banner</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- List --}}
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header bg-info"><div class="card-title">All Banners</div></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th><th>Image</th><th>Title</th><th>Order</th>
                                    <th>Expires</th><th>Status</th><th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = (($banners->currentPage() - 1) * $banners->perPage() + 1); ?>
                                @forelse($banners as $banner)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if($banner->image_url)
                                            <img src="{{ $banner->image_url }}" alt="" style="height:36px;border-radius:4px;">
                                        @else — @endif
                                    </td>
                                    <td>{{ $banner->title ?: '—' }}</td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>{{ $banner->expires_at ? $banner->expires_at->format('d M Y') : '—' }}</td>
                                    <td>
                                        @if($banner->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="#" data-toggle="modal" data-target="#bnedit{{ $banner->id }}" class="text-success mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class="text-danger" onclick="return confirm('Delete this banner?')" style="all:unset; cursor:pointer;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Edit modal --}}
                                <div class="modal fade" id="bnedit{{ $banner->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Banner</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @include('admin.banners.form', ['banner' => $banner])
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="7" class="text-danger h6 text-center">No banners yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $banners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
