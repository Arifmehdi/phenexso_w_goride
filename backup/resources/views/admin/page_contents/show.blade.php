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
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#english" data-toggle="tab">English Content</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bangla" data-toggle="tab">Bangla Content</a></li>
                        </ul>
                        <div class="card-tools" style="margin-top: -35px;">
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

                        <div class="tab-content">
                            <div class="tab-pane active" id="english">
                                <div class="row mb-4">
                                    <div class="col-sm-3 text-muted"><strong>Title (EN):</strong></div>
                                    <div class="col-sm-9"><h5>{{ $pageContent->getRawOriginal('title') ?? 'N/A' }}</h5></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-3 text-muted"><strong>Subtitle (EN):</strong></div>
                                    <div class="col-sm-9 text-secondary">{{ $pageContent->getRawOriginal('subtitle') ?? 'N/A' }}</div>
                                </div>
                                <hr>
                                <div class="mt-4">
                                    <h6 class="text-muted"><strong>Description (EN):</strong></h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($pageContent->getRawOriginal('description'))) !!}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="text-muted"><strong>Full Content (EN):</strong></h6>
                                    <div class="p-3 border rounded">
                                        {!! $pageContent->getRawOriginal('content') ?? '<em class="text-muted">No content available</em>' !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="bangla">
                                <div class="row mb-4">
                                    <div class="col-sm-3 text-muted"><strong>Title (BN):</strong></div>
                                    <div class="col-sm-9"><h5>{{ $pageContent->title_bn ?? 'N/A' }}</h5></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-3 text-muted"><strong>Subtitle (BN):</strong></div>
                                    <div class="col-sm-9 text-secondary">{{ $pageContent->subtitle_bn ?? 'N/A' }}</div>
                                </div>
                                <hr>
                                <div class="mt-4">
                                    <h6 class="text-muted"><strong>Description (BN):</strong></h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($pageContent->description_bn)) !!}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="text-muted"><strong>Full Content (BN):</strong></h6>
                                    <div class="p-3 border rounded">
                                        {!! $pageContent->content_bn ?? '<em class="text-muted">No content available</em>' !!}
                                    </div>
                                </div>
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
                            @if($pageContent->getRawOriginal('highlights'))
                                <strong>EN:</strong>
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->getRawOriginal('highlights'), JSON_PRETTY_PRINT) }}</code></pre>
                            @endif
                            @if($pageContent->highlights_bn)
                                <strong>BN:</strong>
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->highlights_bn, JSON_PRETTY_PRINT) }}</code></pre>
                            @endif
                            @if(!$pageContent->getRawOriginal('highlights') && !$pageContent->highlights_bn)
                                <p class="text-muted small">No highlights defined.</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h6 class="text-muted"><strong>Meta Data:</strong></h6>
                            @if($pageContent->getRawOriginal('meta'))
                                <strong>EN:</strong>
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->getRawOriginal('meta'), JSON_PRETTY_PRINT) }}</code></pre>
                            @endif
                            @if($pageContent->meta_bn)
                                <strong>BN:</strong>
                                <pre class="bg-dark text-white p-2 rounded"><code>{{ json_encode($pageContent->meta_bn, JSON_PRETTY_PRINT) }}</code></pre>
                            @endif
                            @if(!$pageContent->getRawOriginal('meta') && !$pageContent->meta_bn)
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
