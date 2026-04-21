@extends('admin.master')
@section('title',"Admin Dashboard | Create Hospital")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Create Service </div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Service Name English</label>
                                <input type="text" class="form-control @error('name_en') is_invalid @enderror" id="" placeholder="Name" name="name_en" value="{{ old('name_en') }}">
                                @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Excerpt</label>
                                <textarea name="excerpt_en" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt">{{old('excerpt_en')}}</textarea>
                            </div>

                            
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description_en" id="summernote" class="form-control" rows="5">{{old('description_en')}}</textarea>
                            </div>

                            {{--<div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address_en" id="" cols="30" rows="3" class="form-control" placeholder="Address">{{old('address_en')}}</textarea>
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
                                 @if(old('hospital_contacts'))
                                    @foreach(old('hospital_contacts') as $contact)
                                    <option selected="selected">{{ $contact }}</option>
                                    @endforeach
                                 @endif
                                </select>
                             </div>--}}



                            {{--<div class="form-group">
                                <label for="">Division</label>
                                <select name="division_id"  class="form-control division-select" data-url="{{ route('get.division') }}">
                                    <option value="">Choose Division</option>
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                 </select>

                            </div>--}}

                            {{--<div class="form-group">
                                <label for="">District</label>
                                <select id="district" data-url="{{ route('get.district') }}" class="district-select form-control" name="district_id" required >
                                    <option value="">Choose District</option>

                                </select>

                            </div>--}}


                            {{--<div class="form-group">
                                <label for="">Upazila</label>
                                <select id="upazila" class="upazila-select form-control" name="upazila_id" required>
                                    <option value="">Choose Upazila</option>

                                </select>

                            </div>--}}



                         


                            <div class="form-group">
                                <label for="image">Image</label>
                               <input type="file" name="image" class="form-control">
                               @error('image')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>


                            <input type="submit" class="btn btn-success mt-2">

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection



@section('script')
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

@endsection


