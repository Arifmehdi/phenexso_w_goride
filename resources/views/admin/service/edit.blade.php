@extends('admin.master')
@section('title',"Admin Dashboard | Create Hospital")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Edit Hospital </div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('services.update',$hospital->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hospital Name</label>
                                <input type="text" class="form-control @error('name_en') is_invalid @enderror" id="" placeholder="Name" name="name_en" value="{{ $hospital->name_en }}">
                                @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Excerpt</label>
                                <textarea name="excerpt_en" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt">{{ $hospital->excerpt_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description_en" id="summernote" class="form-control" rows="5">{{ $hospital->description_en }}</textarea>
                            </div>

                            
                            {{--<div class="form-group">
                                <label for="">Address English</label>
                                <textarea name="address_en" id="" cols="30" rows="3" class="form-control" placeholder="Address">{{ $hospital->address_en }}</textarea>
                                @error('address_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>--}}

                             {{--<div class="form-group">
                                <label>Hospital Contacts</label>
                                <select class="select_hospital_contact select2 select2-hidden-accessible"
                                 id="hospital_contacts"
                                 name="hospital_contacts[]"
                                 multiple="multiple"
                                 data-ajax-dataType="json"
                                 data-placeholder="Select Hospital Contact" style="width: 100%;"
                                 data-select2-id="23"
                                 data-ajax-delay="200"
                                 >

                                 @foreach ($hospital->hospital_contacts() as $contact)
                                  <option selected="selected">{{ $contact }}</option>
                                 @endforeach

                                </select>
                            </div>--}}


                            {{--<div class="form-group">
                                <label for="">Division</label>
                                <select name="division_id"  class="form-control division-select" data-url="{{ route('get.division') }}">
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"  {{ $hospital->division_id == $division->id ? 'selected' : ' '}}>
                                        {{ $division->name }}
                                    </option>
                                    @endforeach
                                 </select>

                            </div>--}}

                            {{--<div class="form-group">
                                <label for="">District</label>
                                <select id="district" data-url="{{ route('get.district') }}" class="district-select form-control" name="district_id" required >
                                    <option value="">Choose District</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}"
                                        {{ $hospital->district_id == $district->id ? 'selected' : ' '}}>
                                        {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>--}}


                            {{--<div class="form-group">
                                <label for="">Upazila</label>
                                <select id="upazila" class="upazila-select form-control" name="upazila_id" required>
                                    <option value="">Choose Upazila</option>
                                    @foreach($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}"
                                        {{ $hospital->upazila_id == $upazila->id ? 'selected' : ' '}}>
                                        {{ $upazila->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>--}}



                            <div class="form-group">
                                <label for="image">Image</label>
                               <input type="file" name="image" class="form-control"><br>
                               <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $hospital->fi() ]) }}" alt="">
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="featured" name="active" {{ $hospital->active ? "checked" : "" }}>
                                <label class="form-check-label" for="exampleCheck1">Active</label>
                            </div>


                            <input type="submit" class="btn btn-success mt-2">

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection



@push('js')
<script>
    $(document).ready(function(){

     $('.select2').select2({});
     $('.division-select').select2({});
     $('.district-select').select2({});
     $('.upazila-select').select2({});


     $(document).on('change', 'select[name="division_id"]', function() {
                var that = $(this);
                var division_id = that.val();
                var url = that.attr('data-url');
                $.ajax({
                url    : url,
                method : 'get',
                data   : {division_id : division_id },
                success: function(result){
                    $('.district-select').empty();
                        $.each(result,function(key, value){
                        $('.district-select').append('<option value="'+value.id+'">'
                            +value.name+'</option>')
                    });

                }
         });
    });


    $(document).on('change', 'select[name="district_id"]', function() {
                var that = $(this);
                var district_id = that.val();
                var url = that.attr('data-url');
                $.ajax({
                url    : url,
                method : 'get',
                data   : {district_id : district_id },
                success: function(result){
                    $('.upazila-select').empty();
                        $.each(result,function(key, value){
                        $('.upazila-select').append('<option value="'+value.id+'">'
                            +value.name+'</option>')
                    });

                }
         });
    });


    $('.select_hospital_contact').select2({
            minimumInputLength: 1,
            tags:true,
            tokenSeparators: [','],
    });



    });

</script>
@endpush


