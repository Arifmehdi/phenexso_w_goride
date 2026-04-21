@extends('frontend.layouts.master')

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Hospitals</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Hospitals</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Hospital List -->
<section class="my-5">
    <div class="container">

        <!-- Section Header -->
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="fw-bold display-6 text-primary mb-3">Hospital Services</h2>
                <p class="text-muted">Choose the best hospitals and get world-class treatment</p>
            </div>
        </div>

        <!-- Hospitals Grid -->
        <div class="row g-4">
            @foreach ($hospitals as $hospital)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('hospitalDetails', $hospital->id)}}" class="text-decoration-none">
                        <div class="card border-0 rounded overflow-hidden h-100 shadow-sm hover-shadow">
                            
                            <!-- Hospital Image -->
                            <div class="position-relative">
                                <img class="card-img-top img-fluid" 
                                     src="{{ route('imagecache', ['template'=>'cpmd','filename' => $hospital->fi()]) }}" 
                                     alt="{{ $hospital->name_en }}">

                                <!-- Overlay -->
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark"
                                     style="opacity:0; transition: all 0.3s ease-in-out;"
                                     onmouseover="this.style.opacity='0.25';"
                                     onmouseout="this.style.opacity='0';">
                                    <div class="d-flex h-100 justify-content-center align-items-center">
                                        <span class="btn btn-outline-light rounded-pill px-4">View Details</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body text-center py-3">
                                <h5 class="card-title fw-semibold text-dark mb-0">
                                    {{ $hospital->name_en }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col d-flex justify-content-center">
                {{ $hospitals->links() }}
            </div>
        </div>

    </div>
</section>
@endsection
