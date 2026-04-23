@extends('admin.master')
@section('title', 'Edit Page Content | Admin Dashboard')
@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-edit mr-2"></i>Edit Page Content</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page_contents.index') }}">Page Contents</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Content for: {{ $pageContent->page_slug }}</h3>
                    </div>
                    <form action="{{ route('admin.page_contents.update', $pageContent->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ old('page_slug', $pageContent->page_slug) }}" required>
                                        <small class="text-muted">Used for identifying the page (e.g., 'home', 'about')</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $pageContent->title) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="2">{{ old('subtitle', $pageContent->subtitle) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $pageContent->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Full Content</label>
                                <textarea name="content" id="summernote" class="form-control">{{ old('content', $pageContent->content) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Highlights (JSON Array)</label>
                                        <textarea name="highlights" id="highlights" class="form-control" rows="4" placeholder='["Fast Delivery", "Secure Payment"]'>{{ old('highlights', json_encode($pageContent->highlights, JSON_PRETTY_PRINT)) }}</textarea>
                                        <small class="text-muted">Provide a valid JSON array.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta">Meta Data (JSON Object)</label>
                                        <textarea name="meta" id="meta" class="form-control" rows="4" placeholder='{"meta_title": "Home Page", "meta_desc": "..."}'>{{ old('meta', json_encode($pageContent->meta, JSON_PRETTY_PRINT)) }}</textarea>
                                        <small class="text-muted">Provide a valid JSON object.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update Page Content
                            </button>
                            <a href="{{ route('admin.page_contents.index') }}" class="btn btn-default float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
