@extends('admin.master')
@section('title',"Admin Dashboard | Create Category")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Edit Category </div>
            </div>
            <form action="{{ route('categories.update',$doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body w3-light-gray">
                    <div class="row py-2">
                        <div class="col-12 col-md-12 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Name (English)</label>
                                <input type="text" class="form-control @error('name_en') is_invalid @enderror" id="" placeholder="Category Name (English)" name="name_en" value="{{ $doctor->name_en }}">
                                @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ক্যাটাগরি নাম (বাংলা)</label>
                                <input type="text" class="form-control @error('name_bn') is_invalid @enderror" id="" placeholder="ক্যাটাগরি নাম (বাংলা)" name="name_bn" value="{{ $doctor->name_bn }}">
                                @error('name_bn')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{--<div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control @error('email') is_invalid @enderror" id="" placeholder="E-mail" name="email" value="{{$doctor->email }}" readonly>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mobile</label>
                                <input type="text" class="form-control @error('mobile') is_invalid @enderror" id="" placeholder="Mobile" name="mobile" value="{{ $doctor->mobile }}">
                                @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="whatsapp_number">Whatsapp Number</label>
                                <input type="text" class="form-control @error('whatsapp_number') is_invalid @enderror" id="" placeholder="Whatsapp Number" name="whatsapp_number" value="{{ $doctor->whatsapp_number }}">
                                @error('whatsapp_number')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Genter</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Choose Gender</option>
                                    @foreach (config('parameter.gender') as $item)
                                    <option value="{{ $item }}" {{ $item == $doctor->gender  ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select name="department_id"  class="form-control select2">
                                    <option value="">Choose Department</option>
                                    @foreach ($departments as $category)
                                    <option value="{{ $category->id }}" {{ $doctor->department_id == $category->id ? 'selected' : ' '}}>{{ $category->name_en }}</option>
                                    @endforeach
                                 </select>
                                 @error('department_id')
                                 <p class="text-danger">{{ $message }}</p>
                                 @enderror
                            </div>--}}

                            {{-- <div class="form-group">
                                <label for="exampleInputPassword1">Designation</label>
                                <input type="text" class="form-control @error('designation_en') is_invalid @enderror" id="" placeholder="Designation English" name="designation_en" value="{{ $doctor->designation_en }}">
                                @error('designation_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            {{--<div class="form-group">
                                <label for="">Doctor Fee</label>
                                <input class="form-control" type="number"  name="doctor_fee" placeholder="Doctor Fee" value="{{ $doctor->doctor_fee }}">
                                @error('doctor_fee')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Chamber location</label>
                                <input class="form-control" type="text"  name="chambar_location" placeholder="Chamber location" value="{{ $doctor->chambar_location }}">
                                @error('chambar_location')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>--}}




                            <div class="form-group">
                                <label for="">Excerpt</label>
                                <textarea name="excerpt_en" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt English">{{ $doctor->excerpt_en }}</textarea>
                            </div>


                          

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description_en" id="summernote" class="form-control" rows="5">{{ $doctor->description_en }}</textarea>
                            </div>

                            


                            <div class="form-group">
                                <label for="doctor_image">Image</label>
                               <input type="file" name="doctor_image" class="form-control"><br>
                               <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $doctor->fi() ]) }}" alt="">
                        </div>
                      </div>
                    </div>



                    {{--<div class="row py-2">
                        <div class="col-12 col-md-12 m-auto card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Hospital</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        @php
                                            $doctor_hospitals = $doctor->hospitals()->get();
                                            $filtered_hospitals = $hospitals->whereNotIn('id',$doctor->hospitals()->pluck('hospital_id')->toArray());
                                            $prepared_hospitals = $doctor_hospitals->concat($filtered_hospitals);
                                        @endphp

                                        @foreach ($prepared_hospitals as $hospital)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body w3-light-gray">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"  name="hospitals[]" value="{{ $hospital->id }}"
                                                           {{ $hospital->pivot ? "checked" : "" }}>
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



