@extends('admin.master')
@section('title', 'Page Contents | Admin Dashboard')

@push('css')
<style>
    .page-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .page-card:hover {
        transform: translateY(-5px);
    }
    .slug-badge {
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 12px;
        background: #f1f5f9;
        color: #475569;
        padding: 4px 10px;
        border-radius: 6px;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .lang-indicator {
        display: flex;
        gap: 5px;
        margin-top: 8px;
    }
    .lang-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    .dot-en { background: #3b82f6; }
    .dot-bn { background: #10b981; }
</style>
@endpush

@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice mr-2 text-primary"></i>Content Management</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.page_contents.create') }}" class="btn btn-primary px-4 shadow-sm">
                    <i class="fas fa-plus-circle mr-1"></i> Create Page
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($pageContents as $content)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card page-card h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="slug-badge">{{ $content->page_slug }}</span>
                                <span class="status-badge {{ $content->active ? 'bg-success-light text-success' : 'bg-danger-light text-danger' }}" style="background: {{ $content->active ? '#ecfdf5' : '#fef2f2' }}">
                                    {{ $content->active ? 'Live' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4">
                            <h5 class="font-weight-bold mb-1">{{ $content->getRawOriginal('title') ?: 'Untitled' }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($content->description, 80) }}</p>
                            
                            <div class="lang-indicator">
                                <span class="small text-muted mr-2">Languages:</span>
                                <span class="lang-dot dot-en" title="English Ready"></span>
                                @if($content->title_bn)
                                    <span class="lang-dot dot-bn" title="Bangla Ready"></span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                            <hr class="mt-0">
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <a href="{{ route('admin.page_contents.edit', $content->id) }}" class="btn btn-outline-primary btn-sm px-3">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.page_contents.show', $content->id) }}" class="btn btn-outline-secondary btn-sm px-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                
                                <form action="{{ route('admin.page_contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Permanent delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger btn-sm p-0">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://illustrations.popsy.co/gray/data-analysis.svg" style="height: 200px;" alt="Empty">
                    <h4 class="mt-4 text-muted">No pages managed yet</h4>
                    <a href="{{ route('admin.page_contents.create') }}" class="btn btn-primary mt-3">Create Page Content</a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $pageContents->links() }}
        </div>
    </div>
</div>

@endsection
