@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>Meet our Specialists</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Doctors</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="team">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col">
                <!-- Department Filter -->
                <ul class="nav nav-pills sort-source mb-5 pb-1" data-sort-id="portfolio"
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
@endsection

@push('js')
<script>
    // এখানে future JS ফিল্টার / isotope script initialize করতে পারবেন
</script>
@endpush
