@extends('frontend.layouts.master')

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>{{ $hospital->name_en }}</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('hospitalList') }}">Hospitals</a></li>
                    <li class="active">{{ $hospital->name_en }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Hospital Details -->
<section class="pt-5 pb-4">
    <div class="container">

        <!-- Hospital Info -->
        <div class="row mb-5">
            <div class="col-md-4">
                <img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $hospital->fi()]) }}" 
                     alt="{{ $hospital->name_en }}" 
                     class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-8">
                <h2 class="fw-bold text-primary">{{ $hospital->name_en }}</h2>
                <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i>{{ $hospital->address_en ?? 'No address available' }}</p>
                <p class="mb-2"><i class="fas fa-phone-alt me-2"></i>{{ $hospital->hospital_contacts ?? 'No phone available' }}</p>
                <p>{!! $hospital->description_en ?? 'No description available' !!}</p>
            </div>
        </div>

        <!-- Doctors Section -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="fw-bold text-dark">Doctors</h4>
            </div>
            <hr>
        </div>

        <!-- Doctors Grid -->
        <div class="row g-4">
            @forelse ($doctors as $doctor)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ route('imagecache', ['template'=>'pplg','filename' => $doctor->fi()]) }}" 
                                     alt="{{ $doctor->name_en }}" 
                                     class="img-fluid rounded-start">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title text-danger fw-bold mb-1">{{ $doctor->name_en }}</h5>
                                    <p class="text-success mb-1 fw-semibold">{{ $doctor->department->name_en ?? '' }}</p>
                                    <p class="mb-1">{{ $doctor->designation }}</p>
                                    <p class="small text-muted mb-0">
                                        {{ Str::limit($doctor->excerpt, 70, '...') }}
                                        <a href="{{ route('doctorDetails', $doctor->id) }}" class="text-danger fw-bold">More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">No doctors available in this hospital.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col d-flex justify-content-center">
                {{ $doctors->links() }}
            </div>
        </div>

    </div>
</section>
@endsection
