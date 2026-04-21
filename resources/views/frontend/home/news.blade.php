@extends('frontend.layouts.master')

@section('title', "News List")

@section('content')

<!-- Page Header -->
<section class="page-header page-header-modern bg-color-primary page-header-md">
    <div class="container">
        <div class="row">
              <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1>News</h1>
            </div>
            <div class="col-md-4 order-1 order-md-2 align-self-center">
                <ul class="breadcrumb d-block text-md-end breadcrumb-light">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>News List</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Hospital Related News -->
<section class="py-5 bg-light">
    <div class="container">


        <div class="row g-4">
            @forelse ($news as $post)
                <div class="col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="row g-0">
                            <!-- Image -->
                            <div class="col-md-4">
                                <a href="{{ route('singleNews', ['id' => $post->id]) }}">
                                    <img src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}" 
                                         alt="{{ $post->title }}" 
                                         class="img-fluid rounded-start w-100 h-100 object-fit-cover">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ route('singleNews', ['id' => $post->id]) }}" class="text-dark text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted mb-3">
                                        {{ Str::limit($post->excerpt, 300, '...') }}
                                    </p>
                                    <a href="{{ route('singleNews', ['id' => $post->id]) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No news available for this hospital.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-end">
            {{ $news->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
</section>

@endsection
