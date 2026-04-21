@extends('admin.master')
@section('title',"Admin Dashboard | Create Gallery")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Create Gallery </div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <input type="text" class="form-control @error('title') is_invalid @enderror" id="" placeholder="Title.." name="title" value="{{ old('title') }}">
                                @error('title')

                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_image">File</label>
                               <input type="file" name="featured_image" class="form-control" id="featured_image_input">
                               @error('featured_image')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>

                            <div class="form-group" id="thumbnail_image_group" style="display: none;">
                                <label for="thumbnail_image">Thumbnail Image (for videos)</label>
                               <input type="file" name="thumbnail_image" class="form-control">
                               @error('thumbnail_image')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="number" class="form-control" id="priority" placeholder="Priority.." name="priority" value="{{ old('priority', 0) }}">
                            </div>


                            {{-- <div class="form-group">
                                <label for="exampleInputPassword1">Images(Multiple Select)</label>
                               <input type="file" name="extraImages[]" class="form-control" multiple>
                            </div> --}}

                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="featured" name="featured" {{ old('featured') ? "checked" : "" }}>
                                <label class="form-check-label" for="exampleCheck1">Featured</label>
                            </div> --}}

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="active" name="active" {{ old('active') ? "checked" : "" }} checked>
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <input type="submit" class="btn btn-success mt-2">

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const featuredImageInput = document.getElementById('featured_image_input');
        const thumbnailImageGroup = document.getElementById('thumbnail_image_group');

        featuredImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileType = file.type;
                if (fileType.startsWith('video/')) {
                    thumbnailImageGroup.style.display = 'block';
                } else {
                    thumbnailImageGroup.style.display = 'none';
                }
            } else {
                thumbnailImageGroup.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection

