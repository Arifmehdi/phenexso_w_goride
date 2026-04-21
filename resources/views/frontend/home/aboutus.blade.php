@extends('frontend.layouts.master')

@push('css')
@endpush

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1> {{ $page->name_en }}</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"> {{ $page->name_en }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5 pt-5">
    
    <!-- Page Title -->
    <div class="text-center mb-5">
        <h1 class="h2 fw-bold text-dark">
            {{ $page->name_en }}
        </h1>
    </div>

    <!-- Page Items -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @forelse ($page->activePageItems() as $item)
                <div class="mb-4">
                    @if ($item->description_en)
                        <div class="mb-3">
                            {!! $item->description_en !!}
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted mb-0">No about found.</p>
            @endforelse
        </div>
    </div>

</section>

@endsection
