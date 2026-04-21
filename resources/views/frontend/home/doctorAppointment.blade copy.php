@extends('frontend.layouts.master')

@push('css')
<style>
.form-control:focus {
    border: 2px solid #1abc9c; /* bright green border */
    box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
}

.form-select:focus {
    border: 2px solid #1abc9c;
    box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
}

textarea.form-control:focus {
    border: 2px solid #1abc9c;
    box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
}

</style>
@endpush

@section('content')

@php
 $doctor = \App\Models\Doctor::findOrFail(request()->id);
@endphp

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Doctor Appointment</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Doctor Appointment</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <!-- Card -->
                <div class="card shadow-lg border-0 rounded overflow-hidden">
                    
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="h3 mb-1 fw-bold">Book an Appointment</h2>
                        <p class="mb-0 text-dark">Send a message or book your visit with our specialists</p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                       {{-- <form action="{{ route('storeAppointment')}}" method="POST">
                            @csrf

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <!-- Department -->
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <select id="department" class="form-select" disabled>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ (request()->id && $doctors->where('id', request()->id)->first()?->department_id == $department->id) ? 'selected' : '' }}>
                                                {{ $department->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="department_id" 
                                        value="{{ request()->id ? $doctors->where('id', request()->id)->first()?->department_id : '' }}">
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Doctor -->
                                <div class="col-md-6">
                                    <label for="doctor" class="form-label">Doctor</label>
                                    <select id="doctor" class="form-select" disabled>
                                        <option value="">Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ request()->id == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="doctor_id" value="{{ request()->id }}">
                                    @error('doctor_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="doctor_fee" class="form-label">Doctor Fee</label>
                                    <input type="tel" id="doctor_fee" name="doctor_fee" class="form-control" placeholder="Doctor Fee" 
                                        value="{{ $doctor ? $doctor->doctor_fee : old('doctor_fee')}}" required disabled>
                                    @error('doctor_fee')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="chambar_location" class="form-label">Chamber Location</label>
                                    <input type="text" id="chambar_location" name="chambar_location" class="form-control" 
                                        value="{{ $doctor ? $doctor->chambar_location : old('chambar_location')}}" placeholder="Chamber Location" required disabled>
                                    @error('chambar_location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Phone</label>
                                    <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Phone" required>
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="appointment_date" class="form-label">Appointment Date</label>
                                    <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
                                    @error('appointment_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea id="message" name="message" rows="4" class="form-control" placeholder="Message"></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                    Make an Appointment
                                </button>

                              
                            </div>
                        </form> --}}

                        <form id="appointmentForm">
                            @csrf

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <!-- Department -->
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <select id="department" class="form-select" disabled>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ (request()->id && $doctors->where('id', request()->id)->first()?->department_id == $department->id) ? 'selected' : '' }}>
                                                {{ $department->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="department_id" 
                                        value="{{ request()->id ? $doctors->where('id', request()->id)->first()?->department_id : '' }}">
                                </div>

                                <!-- Doctor -->
                                <div class="col-md-6">
                                    <label for="doctor" class="form-label">Doctor</label>
                                    <select id="doctor" class="form-select" disabled>
                                        <option value="">Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ request()->id == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="doctor_id" value="{{ request()->id }}">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="doctor_fee" class="form-label">Doctor Fee</label>
                                    <input type="text" id="doctor_fee" class="form-control" 
                                        value="{{ $doctor ? $doctor->doctor_fee : old('doctor_fee')}}" disabled>
                                    <input type="hidden" name="doctor_fee" value="{{ $doctor ? $doctor->doctor_fee : old('doctor_fee') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="chambar_location" class="form-label">Chamber Location</label>
                                    <input type="text" id="chambar_location" class="form-control" 
                                        value="{{ $doctor ? $doctor->chambar_location : old('chambar_location')}}" disabled>
                                    <input type="hidden" name="chambar_location" value="{{ $doctor ? $doctor->chambar_location : old('chambar_location') }}">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Phone</label>
                                    <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Phone" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="appointment_date" class="form-label">Appointment Date</label>
                                    <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea id="message" name="message" rows="4" class="form-control" placeholder="Message"></textarea>
                            </div>

                            <div class="text-center">
                                
                                 <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                        token="if you have any token validation"
                                        postdata="your javascript arrays or objects which requires in backend"
                                        order="If you already have the transaction generated for current order"
                                        endpoint="{{ url('/pay-via-ajax') }}">   Pay & Make Appointment
                                </button>
                            </div>
                        </form>



                        


                    </div> <!-- End Card Body -->
                </div> <!-- End Card -->

            </div>
        </div>
    </div>
</section>


<!-- Doctors Section -->
<section class="team section">
    <div class="container">
        <div class="row  mb-5">
            <div class="col text-center">

                <h2 class="fw-bold display-6 text-primary mb-2">Our Specialist Doctors</h2>
                <p class="text-muted"> Meet our specialists delivering expert care with dedication and compassion.</p>
        
                <!-- Department Filter -->
                <ul class="nav nav-pills sort-source mb-5 pb-1 pt-3" data-sort-id="portfolio"
                    data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">

                    <li class="nav-item active" data-option-value="*">
                        <a class="nav-link active" href="#">Show All</a>
                    </li>

                    @foreach($departments as $department)
                        <li class="nav-item" data-option-value=".dep-{{ $department->id }}">
                            <a class="nav-link w3-small" href="#">{{ $department->name_en }}</a>
                        </li>
                    @endforeach
                </ul>

                <!-- Doctors List -->
                <div class="sort-destination-loader sort-destination-loader-showing">
                    <div class="row portfolio-list sort-destination" data-sort-id="portfolio">

                        @foreach($doctors as $doctor)
                            <div class="col-md-6 col-lg-3 isotope-item dep-{{ $doctor->department_id }}">
                                <div class="portfolio-item">
                                    <a href="{{ route('doctorDetails', $doctor->id) }}" 
                                       class="text-decoration-none">
                                        <span class="thumb-info thumb-info-no-zoom thumb-info-hide-wrapper-bg">
                                            <span class="thumb-info-wrapper m-0">
                                                <img src="{{ route('imagecache', ['template'=>'pfimd','filename' => $doctor->fi()]) }}"
                                                     class="img-fluid" alt="{{ $doctor->name_en }}">
                                            </span>
                                            <span class="thumb-info-caption p-4">
                                                <span class="custom-thumb-info-title">
                                                    <span class="custom-thumb-info-type font-weight-light text-4">
                                                        {{ $doctor->department->name_en ?? 'Specialist' }}
                                                    </span>
                                                    <span class="custom-thumb-info-inner font-weight-semibold text-5">
                                                        {{ $doctor->name_en }}
                                                    </span>
                                                    <i class="icon-arrow-right-circle icons font-weight-semibold text-5"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 text-center">

            <!-- Box 1 -->
            <div class="col-md-4">
                <div class="card border-0 bg-white h-100 shadow-sm p-4">
                    <div class="mb-3">
                        <i class="icon-user-following icons fs-1" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">The Best Doctors</h4>
                    <p class="text-muted mb-0">
                        In addition to the doctors of the 93 Shasthoseba Foundation, round-the-clock medical services are provided by doctors specializing in various diseases.
                    </p>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="col-md-4">
                <div class="card border-0 bg-white h-100 shadow-sm p-4">
                    <div class="mb-3">
                     <i class="icon-heart icons fs-1" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Care About All Clients</h4>
                    <p class="text-muted mb-0">
                        People from different walks of life can register with the 93 Shasthoseba Foundation and receive medical services at any time.
                    </p>
                </div>
            </div>

            <!-- Box 3 -->
            <div class="col-md-4">
                <div class="card border-0 bg-white h-100 shadow-sm p-4">
                    <div class="mb-3">
                     <i class="icon-bubbles icons fs-1" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Communication With Patients</h4>
                    <p class="text-muted mb-0">
                        Considering the patient’s condition, the doctors and related staff of 93-Shasthoseba Foundation are always connected with the patient.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection

@push('js')
<script>
    var obj = {};
    // If you want to pass some value from frontend, you can do like this, but be aware, this value can be modified by anyone, so it's not secure to pass total_amount, store_passwd etc from frontend.
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();

    $('#sslczPayBtn').prop('postdata', obj);

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endpush
