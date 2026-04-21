@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')

    {{-- <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Register Now</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="form-horizontal" action="{{route('register')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                        <span class="text-danger">{{$errors->has('name')?$errors->first('name'):''}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                        <span class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                        <span class="text-danger">{{$errors->has('password')?$errors->first('password'):''}}</span>
                                    </div>

                                    <div class="mt-3">
                                        <input type="submit" class="btn btn-primary btn-block waves-effect waves-light" value="Log In">
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

<section class="page-header page-header-modern bg-color-primary page-header-md my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Health Card Registration</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Registration</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section my-0">
    <div class="container py-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Registration Form -->
                <div class="card shadow-lg rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="my-1 font-weight-bold w3-xlarge">Health Card Registration Form</h4>
                        <hr class="my-2">
                        <p class="text-white">Health Card holders can purchase healthcare and medicine at special discounts from specific hospitals and pharmacies, as per the terms of the agreement with the Foundation.</p>
                    </div>
                    <div class="card-body p-4">

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Father Name -->
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father Name <span class="text-danger">*</span></label>
                                <input type="text" id="father_name" name="father_name" class="form-control" placeholder="Enter Father Name" value="{{ old('father_name') }}" required>
                                @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Present Address -->
                            <div class="mb-3">
                                <label for="present_address" class="form-label">Present Address <span class="text-danger">*</span></label>
                                <input type="text" id="present_address" name="present_address" class="form-control" placeholder="Enter Present Address" value="{{ old('present_address') }}" required>
                                @error('present_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Permanent Address -->
                            <div class="mb-3">
                                <label for="permanent_address" class="form-label">Permanent Address <span class="text-danger">*</span></label>
                                <input type="text" id="permanent_address" name="permanent_address" class="form-control" placeholder="Enter Permanent Address" value="{{ old('permanent_address') }}" required>
                                @error('permanent_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date of Registration -->
                            <div class="mb-3">
                                <label for="reg_date" class="form-label">Date Of Registration <span class="text-danger">*</span></label>
                                <input type="date" id="reg_date" name="reg_date" class="form-control" value="{{ old('reg_date') }}" required>
                                @error('reg_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                             <!-- Nid No -->
                            <div class="mb-3">
                                <label for="health_history" class="form-label">Health History</label>
                                <input type="text" id="health_history" name="health_history" class="form-control" placeholder="Enter health history" value="{{ old('health_history') }}">
                                @error('health_history')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                               <!-- Nid No -->
                            <div class="mb-3">
                                <label for="bkash_number" class="form-label">Payment bkash number/Bank Payment Details.</label>
                                <input type="text" id="bkash_number" name="bkash_number" class="form-control" placeholder="Enter bkash number" value="{{ old('bkash_number') }}">
                                @error('bkash_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nid No -->
                            <div class="mb-3">
                                <label for="nid" class="form-label">NID Number <span class="text-danger">*</span></label>
                                <input type="text" id="nid" name="nid" class="form-control" placeholder="Enter Your Nid Number" value="{{ old('nid') }}" required>
                                @error('nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- TIN Number -->
                            <div class="mb-3">
                                <label for="tin_number" class="form-label">TIN Number <span class="text-danger"></span></label>
                                <input type="text" id="tin_number" name="tin_number" class="form-control" placeholder="Enter Your Tin Number" value="{{ old('tin_number') }}">
                                @error('tin_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile No -->
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="E.g. 01700 123456" value="{{ old('mobile') }}" required>
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="E.g. john@doe.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                                <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob') }}" required>
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Blood Group -->
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                                <select id="blood_group" name="blood_group" class="form-select" required>
                                    <option value="">Select One</option>
                                    @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                                        <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                                @error('blood_group')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- S.S.C Passing -->
                            <div class="mb-3">
                                <label for="ssc_passing" class="form-label">S.S.C Passing Year<span class="text-danger">*</span></label>
                                <input type="text" id="ssc_passing" name="ssc_passing" class="form-control" placeholder="S.S.C Passing Year" value="{{ old('ssc_passing') }}" required>
                                @error('ssc_passing')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- S.S.C Registration -->
                            <div class="mb-3">
                                <label for="ssc_registration" class="form-label">S.S.C Registration Year<span class="text-danger">*</span></label>
                                <input type="text" id="ssc_registration" name="ssc_registration" class="form-control" placeholder="S.S.C Registration Year" value="{{ old('ssc_registration') }}" required>
                                @error('ssc_registration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image Upload (Passport Size) <span class="text-danger">*</span></label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Register</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- End Registration Form -->


            </div>
        </div>
    </div>
</section>

@endsection
