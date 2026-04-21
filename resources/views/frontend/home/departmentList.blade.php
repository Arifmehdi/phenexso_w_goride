@extends('frontend.layouts.master')

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md my-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Departments</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Departments List</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="section py-0 my-0">
<div class="container">
    <div class="row pt-5 py-3">
        <div class="col text-center mb-4">
            <h2 class="fw-semibold display-6 mb-2 text-primary">Departments</h2>
            <p class="text-muted fs-6 mb-0">Explore our specialized medical departments</p>
        </div>
    </div>

    <div class="row mt-4">

         @foreach ($departments as $department)
         <div class="col-lg-4">
            <div class="feature-box feature-box-style-2 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                <div class="feature-box-icon" style="min-width: 4.7rem;">
                    <img src="{{ route('imagecache', ['template'=>'original','filename' => $department->fi()]) }}" alt class="img-fluid" />
                </div>
                <div class="feature-box-info">
                    <h4 class="font-weight-semibold"><a href="javascript::void(0)" class="text-decoration-none">{{$department->name_en}}</a></h4>
                    <p>{{$department->excerpt_en}}</p>
                </div>	
            </div>
        </div>
         @endforeach
        
       
    </div>
   
    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col d-flex justify-content-center">
            {{ $departments->links() }}
        </div>
    </div>
</div>
</section>
@endsection
