@extends('admin.master')
@section('title',"Admin Dashboard | Create Ambulance")

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
    <section class="pt-5">
        <div class="card">
            <div class="card-header bg-info">
                <div class="card-title">Create Ambulance Service</div>
            </div>
            <form action="{{ route('ambulances.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card-body w3-light-gray">
                    <div class="row py-2">
                        <div class="col-12 col-md-12 m-auto card p-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control @error('name') is_invalid @enderror" id="" placeholder="Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tagline">Tagline</label>
                                <input type="text" class="form-control @error('tagline') is_invalid @enderror" id="" placeholder="Tagline" name="tagline" value="{{ old('tagline') }}">
                                @error('tagline')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control @error('email') is_invalid @enderror" id="" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="exampleInputPassword1">Mobile</label>
                                <input type="text" class="form-control @error('mobile') is_invalid @enderror" id="" placeholder="Mobile" name="mobile" value="{{ old('mobile') }}">
                                @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                         

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is_invalid @enderror" id="" placeholder="Address" name="address" value="{{ old('address') }}">
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" id="" cols="30" rows="3" class="form-control" placeholder="Excerpt">{{old('excerpt')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="summernote" class="form-control" rows="5">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control">
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




