@extends('frontend.layouts.pageMaster')
@section('content')
@push('css')

<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}"></script>
@endpush
   <section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <div class="card-title" style="margin-right: 5px;">Create Visit </div>
                        <a href="{{ route('agent.visits',Auth::user()->member->id) }}" class="w3-btn w3-tiny w3-border w3-border-blue w3-round-large" style="margin-right: 5px;">All Visits</a>
                        <a href="{{ route('change.profile') }}" class="w3-btn w3-tiny w3-border w3-border-blue w3-round-large">Update Profile</a>
                    </div>

                    <div class="card-body w3-light-gray">
                       <div class="row">
                           <div class="col-md-12">
                            <div class="card p-5">
                                <form action="{{ route('agent.visit.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <input type="text" id="jhfjsdfsjkdf" class="form-control">

                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Patient Name</label>
                                                <input type="text" class="form-control" value="{{ old('patient_name') }}" name="patient_name" placeholder="Enter Patient Name">
                                                @error('patient_name')
                                                <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Patient age</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1" value="{{ old('patient_age') }}" name="patient_age" placeholder="Patient Age">
                                                @error('patient_age')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Patient Genter</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">Choose Gender</option>
                                                    @foreach (config('parameter.gender') as $item)
                                                    <option value="{{ $item }}" {{ old('gender') == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Patient Mobile</label>
                                                <input type="tel" class="form-control allVisitCount" id="exampleInputEmail1" value="{{ old('patient_mobile') }}" placeholder="Patient Mobile" name="patient_mobile">
                                                @error('patient_mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="input-group input-group-static mb-4">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" value="{{ old('password') }}" placeholder="Patient Password" name="password">
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <div class="input-group input-group-static mb-4">
                                        <label>Patient Details</label>
                                        <textarea name="patient_details" id="" cols="30" rows="3" class="form-control"  placeholder="Patient Details">{{ old('patient_details') }}</textarea>
                                        @error('patient_details')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="input-group input-group-static mb-4">
                                        <label>Bisesoggo Category</label>
                                        <select name="bisesoggo_category_id" id="" class="form-control bisesoggo_category_select">
                                            <option value="">Select Bisesoggo Category</option>
                                            @foreach ($bisesoggo_categories as $category)
                                            <option value="{{$category->id}}" {{ old('bisesoggo_category_id') ==  $category->id ? 'selected' : ' '}}> {{$category->name_en}}</option>
                                            @endforeach
                                            @error('bisesoggo_category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </select>
                                    </div>


                                    <div class="input-group input-group-static mb-4">
                                        <label>Hospital Name</label>
                                        <select name="hospital_id" id="" class="form-control hospital_select" data-url="{{ route('select.get.doctor') }}">
                                            <option value="">Select Hospital</option>
                                            @foreach ($hospitals as $hospital)
                                                 <option value="{{$hospital->id}}"  {{ old('hospital_id') ==  $hospital->id ? 'selected' : ' '}}> {{$hospital->name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('hospital_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <div class="input-group input-group-static mb-4">
                                        <label>Doctor Name</label>
                                        <select id="doctor_id" class="doctor_select form-control" name="doctor_id">
                                            <option value="">Select Doctor</option>
                                          </select>
                                            @error('doctor_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                    </div>


                                    <div class="input-group input-group-static mb-4">
                                        <label>Visit Date</label>
                                        <input type="date" name="visit_date" value="{{ old('visit_date') }}" class="form-control">
                                        @error('visit_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group input-group-static mb-4">
                                        <label>Note</label>
                                        <textarea name="note"  cols="30" rows="3" class="form-control"  placeholder="Note">{{ old('note') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </form>
                              </div>
                           </div>
                       </div>

                    </div>
                </div>

            </div>



        </div>
       </div>
   </section>
@endsection

@push('scripts')
<script>



$(document).ready(function(){

    $(document).on('change', 'select[name="hospital_id"]', function() {

                var that = $(this);
                var hospital_id = that.val();
                var url = that.attr('data-url');
                $.ajax({
                url    : url,
                method : 'get',
                data   : {hospital_id : hospital_id },
                    success: function(result){
                        $('.doctor_select').empty();
                            $.each(result,function(key, value){
                                $('.doctor_select').append('<option value="'+value.id+'">'
                                +'Doctor Name : '+value.name_en+' ,Fee : '+value.pivot.fee+'Tk'+'</option>')
                        });

                    }
                });
    });

});
</script>

@endpush

