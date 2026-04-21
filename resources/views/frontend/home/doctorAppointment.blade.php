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



@section('content')

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
            <div class="col-lg-8">

                <div class="card shadow-lg border-0 rounded">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h2 class="h4 mb-0">Book an Appointment</h2>
                          <p class="mb-0 text-dark">Send a message or book your visit with our specialists</p>
                    </div>

                    <div class="card-body p-4">
                        {{-- <form action="{{ url('/pay') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Your Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Your Mobile</label>
                                    <input type="text" name="mobile" class="form-control" placeholder="Your Mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Appointment Date</label>
                                    <input type="date" name="appointment_date" class="form-control"  required>
                                </div>
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

                                <div class="col-12">
                                    <label class="form-label">Your WhatsApp Mobile</label>
                                    <input type="text" name="whatsapp_number" class="form-control" placeholder="WhatsApp Mobile" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2">Make Appointment</button>
                            </div>
                        </form> --}}

                        <form action="{{ url('/pay') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Your Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                </div>

                                <!-- Mobile -->
                                <div class="col-md-6">
                                    <label class="form-label">Your Mobile</label>
                                    <input type="text" name="mobile" class="form-control" placeholder="Your Mobile" required>
                                </div>

                                <!-- Appointment Date -->
                                <div class="col-md-6">
                                    <label class="form-label">Appointment Date</label>
                                    <input type="date" name="appointment_date" class="form-control" required>
                                </div>

                                <!-- Department -->
                                <div class="col-md-6">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" value="{{ $doctor?->department?->name_en ?? '' }}" disabled>
                                    <input type="hidden" name="department_id" value="{{ $doctor?->department_id }}">
                                </div>

                                <!-- Doctor -->
                                <div class="col-md-6">
                                    <label class="form-label">Doctor</label>
                                    <input type="text" class="form-control" value="{{ $doctor?->name_en ?? '' }}" disabled>
                                    <input type="hidden" name="doctor_id" value="{{ $doctor?->id }}">
                                </div>

                                <!-- Doctor Fee -->
                                <div class="col-md-6">
                                    <label class="form-label">Doctor Fee</label>
                                    <input type="text" class="form-control" value="{{ $doctor?->doctor_fee ?? '' }}" disabled>
                                    <input type="hidden" name="doctor_fee" value="{{ $doctor?->doctor_fee ?? '' }}">
                                </div>

                                <!-- Chamber Location -->
                                <div class="col-md-6">
                                    <label class="form-label">Chamber Location</label>
                                    <select id="chamber_select" name="chambar_location" class="form-select" required>
                                        <option value="">Select Chamber</option>
                                        @foreach($doctor?->chambers ?? [] as $chamber)
                                            <option value="{{ $chamber->chamber_title }}" 
                                                    data-schedules='@json($chamber->schedules)'>
                                                {{ $chamber->address }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Chamber Schedules -->
                                <div class="col-md-12">
                                    <label class="form-label">Chamber Schedule</label>
                                    <select id="schedule_select" name="chamber_schedule" class="form-select" required>
                                        <option value="">Select Schedule</option>
                                    </select>
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="col-12">
                                    <label class="form-label">Your WhatsApp Mobile</label>
                                    <input type="text" name="whatsapp_number" class="form-control" placeholder="WhatsApp Mobile" required>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="Optional"></textarea>
                                </div>

                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2">Make Appointment</button>
                            </div>
                        </form>

                    </div>
                </div>

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
document.addEventListener('DOMContentLoaded', function() {
    const chamberSelect = document.getElementById('chamber_select');
    const scheduleSelect = document.getElementById('schedule_select');

    function renderSchedules(schedules) {
        scheduleSelect.innerHTML = '<option value="">Select Schedule</option>';
        if(schedules.length > 0) {
            schedules.forEach((s, index) => {
                const option = document.createElement('option');
                option.value = `${s.day} - ${s.time}`;
                option.textContent = `${s.day} - ${s.time}`;
                scheduleSelect.appendChild(option);
            });
        }
    }

    // On page load, render first chamber schedules if pre-selected
    if(chamberSelect.value) {
        const selectedOption = chamberSelect.options[chamberSelect.selectedIndex];
        const schedules = JSON.parse(selectedOption.dataset.schedules || '[]');
        renderSchedules(schedules);
    }

    // On chamber change
    chamberSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const schedules = JSON.parse(selectedOption.dataset.schedules || '[]');
        renderSchedules(schedules);
    });
});
</script>
@endpush