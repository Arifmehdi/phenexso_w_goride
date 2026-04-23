@extends('admin.master')
@section('title', 'View Page Content | Admin Dashboard')
@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-file-alt mr-2"></i>Page Content Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page_contents.index') }}">Page Contents</a></li>
                    <li class="breadcrumb-item active">View Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Main Content</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.page_contents.edit', $pageContent->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Page Slug:</strong></div>
                            <div class="col-sm-9"><span class="badge badge-info">{{ $pageContent->page_slug }}</span></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Title:</strong></div>
                            <div class="col-sm-9"><h5>{{ $pageContent->title ?? 'N/A' }}</h5></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Subtitle:</strong></div>
                            <div class="col-sm-9 text-secondary">{{ $pageContent->subtitle ?? 'N/A' }}</div>
                        </div>
                        <hr>
                        <div class="mt-4">
                            <h6 class="text-muted"><strong>Description:</strong></h6>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($pageContent->description)) !!}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-muted"><strong>Full Content:</strong></h6>
                            <div class="p-3 border rounded">
                                {!! $pageContent->content ?? '<em class="text-muted">No content available</em>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Additional Info</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="text-muted"><strong>Highlights:</strong></h6>
                            @if($pageContent->highlights)
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->highlights, JSON_PRETTY_PRINT) }}</code></pre>
                            @else
                                <p class="text-muted small">No highlights defined.</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h6 class="text-muted"><strong>Meta Data:</strong></h6>
                            @if($pageContent->meta)
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->meta, JSON_PRETTY_PRINT) }}</code></pre>
                            @else
                                <p class="text-muted small">No meta data defined.</p>
                            @endif
                        </div>
                        <hr>
                        <div class="mt-3">
                            <p class="mb-1"><small class="text-muted">Created At: {{ $pageContent->created_at->format('M d, Y H:i') }}</small></p>
                            <p class="mb-0"><small class="text-muted">Updated At: {{ $pageContent->updated_at->format('M d, Y H:i') }}</small></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.page_contents.index') }}" class="btn btn-default btn-block">
                            <i class="fas fa-arrow-left mr-1"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
