@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Ambulance Services</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Ambulance Services</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Ambulance Provider Section -->
<section class="section my-0">
  <div class="container pb-3">
    
    <!-- Section Title -->
    <div class="row mb-4">
      <div class="col text-center">
        <h2 class="fw-bold display-6 text-primary mb-3">Ambulance Services</h2>
        <p class="text-muted">Choose the best ambulance service and get world-class treatment</p>
      </div>
    </div>

    <!-- Ambulance Providers Grid -->
    <div class="row g-4">
      
      <!-- Provider Item -->
      @foreach ($ambulances as $ambulance)
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100 rounded-3 overflow-hidden">
          <a href="javascript:void(0)" class="text-decoration-none">
            <img src="{{ route('imagecache', ['template'=>'pfimd','filename'=>$ambulance->fi()]) }}" 
                 class="card-img-top img-fluid rounded-top-3" alt="{{ $ambulance->name }}">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-1">{{ $ambulance->name }}</h5>
              <p class="card-subtitle text-muted w3-small">{{ $ambulance->tagline }}</p>
              <p class="mb-0 mt-2">📞 {{ $ambulance->mobile }}</p>
            </div>
          </a>
        </div>
      </div>
      @endforeach


    </div>
  </div>
</section>


@endsection

@push('js')
<script>
    // future JS scripts here
</script>
@endpush
