@extends('frontend.layouts.master')
@section('title', 'Diagnostic')

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Diagnostic</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Diagnostic</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- News Content -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body">
                <!-- Title -->
                <h2 class="card-title h3 fw-bold mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry</h2>

                <!-- Image -->
                {{--<img src="{{ route('imagecache', ['template' => 'original', 'filename' => $news->fi()]) }}"
                     alt="{{ $news->title }}"
                     class="img-fluid rounded mb-4">--}}
                <img src=""
                                    alt="Diagnostic"
                                    class="img-fluid rounded mb-4">
                <!-- Description -->
                <div class="card-text text-muted mb-4">
                    <p>Diagnostics play a crucial role in modern healthcare by helping doctors accurately identify and monitor various health conditions. Advanced diagnostic techniques and tools, including laboratory tests, imaging technologies, and genetic screenings, allow for early detection, precise treatment planning, and improved patient outcomes.

Through continuous innovation in diagnostics, healthcare providers can ensure faster results, reduce errors, and offer personalized care tailored to each patient’s needs. From routine blood tests to sophisticated imaging like MRI and CT scans, diagnostics form the backbone of preventive and curative medicine.</p>
                </div>

                <hr>

                <!-- Category -->
                <p class="mb-0 text-muted">
                    <strong>Category:</strong>
                    <a href="javascript:void(0)" class="text-decoration-none text-primary">
                        {{ $news->category->name ?? '' }}
                    </a>
                </p>
            </div>
        </div>

        <!-- Related News -->

    </div>
</section>

@endsection
