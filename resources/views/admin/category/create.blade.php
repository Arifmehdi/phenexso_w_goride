@extends('admin.master')
@section('title',"Admin Dashboard | Create Category")

@section('body')
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <section class="pt-3">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Create Category </div>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card-body w3-light-gray">
                    <div class="row py-2">
                        <div class="col-12 col-md-12 m-auto card p-5">
                            <div class="form-group">
                                <label for="name_en">Category Name (English)</label>
                                <input type="text" class="form-control @error('name_en') is_invalid @enderror" id="" placeholder="Category Name (English)" name="name_en" value="{{ old('name_en') }}">
                                @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name_bn">ক্যাটাগরি নাম (বাংলা)</label>
                                <input type="text" class="form-control @error('name_bn') is_invalid @enderror" id="" placeholder="ক্যাটাগরি নাম (বাংলা)" name="name_bn" value="{{ old('name_bn') }}">
                                @error('name_bn')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            {{--<div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is_invalid @enderror" id="" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" class="form-control @error('mobile') is_invalid @enderror" id="" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}">
                                @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="whatsapp_number">Whatsapp Number</label>
                                <input type="text" class="form-control @error('whatsapp_number') is_invalid @enderror" id="" placeholder="Whatsapp Number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                                @error('whatsapp_number')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Genter</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Choose Gender</option>
                                    @foreach (config('parameter.gender') as $item)
                                    <option value="{{ $item }}" {{ old('gender') == $item  ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department_id"  class="form-control select2">
                                    <option value="">Choose Department</option>
                                    @foreach ($departments as $category)
                                    <option value="{{ $category->id }}" {{ old('department_id') == $category->id ? 'selected' : '' }}>{{ $category->name_en }}</option>
                                    @endforeach
                                 </select>
                                 @error('department_id')
                                 <p class="text-danger">{{ $message }}</p>
                                 @enderror
                            </div>--}}

                            {{-- <div class="form-group">
                                <label for="designation_en">Designation</label>
                                <input type="text" class="form-control @error('designation_en') is_invalid @enderror" id="" placeholder="Designation" name="designation_en" value="{{ old('designation_en') }}">
                                @error('designation_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            {{--<div class="form-group">
                                <label for="">Doctor Fee</label>
                                <input class="form-control" type="number"  name="doctor_fee" placeholder="Doctor Fee" value="">
                                @error('doctor_fee')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>--}}

                            {{--<div class="form-group">
                                <label for="">Chamber location</label>
                                <input class="form-control" type="text"  name="chambar_location" placeholder="Chamber location" value="">
                                @error('chambar_location')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>--}}

                            <div class="form-group">
                                <label for="">Excerpt</label>
                                <textarea name="excerpt_en" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt">{{old('excerpt_en')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description_en" id="summernote" class="form-control" rows="5">{{old('description_en')}}</textarea>
                            </div>




                            <div class="form-group">
                                <label for="doctor_image">Image</label>
                                <input type="file" name="doctor_image" class="form-control">
                            </div>
                      </div>
                    </div>

                    {{--<div class="row py-2">
                        <div class="col-12 col-md-12 card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Hospital</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($hospitals as $hospital)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body w3-light-gray">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"  name="hospitals[]" value="{{  $hospital->id }}">
                                                            <label class="form-check-label">{{ $hospital->name_en }}</label>
                                                            @error('hospitals')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                        </div>

                    </div>--}}

            </div>

            <div class="card-footer text-right">
                <input type="submit" class="btn btn-success mt-2">
            </div>
        </form>

    </div>
    </section>
@endsection

@push('js')
<script>
    $(document).ready(function(){
     $('.select2').select2({});
    });

</script>
@endpush



