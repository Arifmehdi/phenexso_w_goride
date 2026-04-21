@extends('admin.master')
@section('title',"Admin Dashboard | Edit Ambulance Service")

@section('body')
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Edit Ambulance Service </div>
            </div>
            <form action="{{ route('ambulances.update',$ambulance->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body w3-light-gray">
                    <div class="row py-2">
                        <div class="col-12 col-md-12 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control @error('name') is_invalid @enderror" id="" placeholder="Name" name="name" value="{{ $ambulance->name }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tagline">Tagline</label>
                                <input type="text" class="form-control @error('tagline') is_invalid @enderror" id="" placeholder="Tagline" name="tagline" value="{{ $ambulance->tagline }}">
                                @error('tagline')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is_invalid @enderror" id="" placeholder="E-mail" name="email" value="{{$ambulance->email }}">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control @error('mobile') is_invalid @enderror" id="" placeholder="Mobile" name="mobile" value="{{ $ambulance->mobile }}">
                                @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is_invalid @enderror" id="" placeholder="Address" name="address" value="{{ $ambulance->address }}">
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt">{{ $ambulance->excerpt }}</textarea>
                            </div>


                          

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="5">{{ $ambulance->description }}</textarea>
                            </div>

                        

                            <div class="form-group">
                               <label for="doctor_image">Image</label>
                               <input type="file" name="image" class="form-control"><br>
                               <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $ambulance->fi() ]) }}" alt="">
                            </div>
                      </div>
                    </div>



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



