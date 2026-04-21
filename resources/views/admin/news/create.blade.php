@extends('admin.master')
@section('title',"Admin Dashboard | Create News")
@section('body')
    <section class="pt-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Create News</h3>
            </div>

            <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-sm-7">
                            <div class="card card-default" style="margin-bottom: 5px;">
                                <div class="card-body">
                                

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter Title">
                                        @error('title')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control select2">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="excerpt">Excerpt</label>
                                        <textarea name="excerpt" class="form-control" id="">{{old('excerpt')}}</textarea>
                                        @error('excerpt')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="summernote" class="form-control" rows="5">{{old('description')}}</textarea>
                                        @error('description')
                                        <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="mr-3"><input type="checkbox"  name="active" value="1" {{  old('active') == 1 ? 'checked' : '' }}> Active</label>
                                        </div>

                                        <div class="form-group">
                                            <label class="mr-3"><input type="checkbox"  name="featured_slider" value="1" {{  old('featured_slider') == 1 ? 'checked' : '' }}> Feature Slider</label>
                                        </div>

                                            <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="editor" value="1" {{  old('editor') == 1 ? 'checked' : '' }}> Editor
                                            </label>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card card-default" style="margin-bottom: 20px;">
                                <div class="card-header">
                                    <h3 class="card-title">Add Feature Image</h3>
                                </div>
                                    <div class="card-body">
                                    <div class="form-group row">
                                        <label for="feature_image" class="col-sm-4 col-form-label">Feature Image</label>
                                        <div class="col-sm-6">
                                            <input type="file" class="form-control-file" id="feature_image" name="feature_image" value="{{old('feature_image')}}">
                                        </div>
                                        @error('feature_image')
                                        <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @include('admin.media.mediaContainer')

                        </div>
                    </div>

                </div>

                <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </section>
@endsection


@push('js')
<script>
    $(document).ready(function(){
   

     $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy URL');

            $(this).text('Coppied!');
            var copyText = $(this).attr('data-text');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");

            document.body.removeChild(textarea);
     });




        $('.selectAuthors').select2({
            minimumInputLength: 1,
            tags:true,
            tokenSeparators: [','],
            ajax: {
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                var data = $.map(data, function (obj) {
                obj.id = obj.id || obj.name;
                return obj;
                });
                var data = $.map(data, function (obj) {
                obj.text = obj.text || obj.name;
                return obj;
                });
                return {
                results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
            },
        });

    });

</script>
@endpush
