@extends('frontend.layouts.master')

@push('css')
<style>
.gradient-btn {
    background: linear-gradient(135deg, #a54ebb, #e03b49);
    border: none;
    transition: all 0.3s ease-in-out;
}

.gradient-btn:hover {
    background: linear-gradient(135deg, #8a3ca0, #c9303d); /* Darker shades */
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    transform: translateY(-2px);
}
</style>
@endpush

@section('content')

<!-- Page Header -->
<!-- Page Header with Background Image -->
<section class="page-header page-header-modern py-5 text-light position-relative" 
         style="background: url('{{ route('imagecache', ['template'=>'original','filename' => 'doctor_appointment.jpg']) }}') center/cover no-repeat;">

    <!-- Dark Overlay -->
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(0,0,0,0.55); z-index:1; pointer-events:none; transition:none;">
    </div>

    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            
            <!-- Left Content -->
            <div class="col-md-8 order-2 order-md-1">
                <h1 class="fw-bold mb-3">Our Professional Doctor</h1>
                <h6 class="mb-4" style="color: #ece9e9;">
                    Most of the doctors of <strong>93-Shasthoseba Foundation</strong> are from SSC 93 batch. 
                    Apart from this, other specialist doctors also work with this foundation. 
                    The list of specialist doctors is described in detail below.
                </h6>

                <a href="{{ route('doctorAppointment', ['id' => $doctor->id])}}" 
                    class="btn btn-lg rounded-pill px-5 py-3 text-white fw-semibold shadow-sm gradient-btn">
                    Book Appointment
                </a>
            </div>

            <!-- Right Breadcrumb -->
            <div class="col-md-4 order-1 order-md-2 text-md-end mb-3 mb-md-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="breadcrumb-link text-light">Home</a>
                        </li>
                        <li class="breadcrumb-item active text-light" aria-current="page">
                            Doctor Details
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="team">
    <div class="container">
       
        <div class="row mt-5 mb-5 pt-1">
            <div class="col-lg-4">

                <div class="owl-carousel owl-theme" data-plugin-options="{'items': 1, 'margin': 10, 'animateOut': 'fadeOut', 'autoplay': true, 'autoplayTimeout': 3000}">
                    <div>
                        <span class="img-thumbnail d-block no-borders">
                            <img alt="" class="img-fluid" src="{{ route('imagecache', ['template'=>'pfimd','filename' => $doctor->fi()]) }}">
                        </span>
                    </div>
                    <div>
                        <span class="img-thumbnail d-block no-borders">
                            <img alt="" class="img-fluid" src="{{ route('imagecache', ['template'=>'pfimd','filename' => $doctor->fi()]) }}">
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <h3 class="font-weight-bold mb-3">{{$doctor->name_en}}</h3>

                <h4 class="mb-2 w3-medium font-weight-bold">Department: <span class="w3-text-deep-orange">{{$doctor->department->name_en}}</span></h5>
                 
                
              

                <ul class="list list-icons list-primary">
                    <li><i class="fas fa-phone"></i> {{$doctor->mobile}}</li>
                    <li><i class="far fa-envelope"></i> {{$doctor->email}}<</li>
                </ul>
                <p>{!! $doctor->description_en !!}</p>
             

            </div>
        </div>

          
    </div>
</section>
@endsection

@push('js')
<script>
    // এখানে future JS ফিল্টার / isotope script initialize করতে পারবেন
</script>
@endpush
