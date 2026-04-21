@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Charity</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Charity</li>
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
        <h2 class="fw-bold display-6 text-primary mb-3">Charity Services</h2>
        <p class="text-muted">Charity show here !</p>
      </div>
    </div>

    <!-- Coming Soon Section -->
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm text-center p-4 rounded-3">
          <img src="https://cdn-icons-png.flaticon.com/512/3209/3209072.png" 
               alt="Coming Soon" 
               class="img-fluid mx-auto mb-3" 
               style="max-width: 180px;">
          <h4 class="fw-bold text-primary">Coming Soon!</h4>
          <p class="text-muted mb-0">We will be back soon. Stay tuned!</p>
        </div>
      </div>
    </div>

  </div>
</section>



@endsection

@push('js')
<script>
    // future JS scripts here
</script>
@endpush
