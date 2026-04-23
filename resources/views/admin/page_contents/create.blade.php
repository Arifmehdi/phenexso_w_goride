@extends('admin.master')
@section('title', 'Create Page Content | Admin Dashboard')
@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-plus-circle mr-2"></i>Create Page Content</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page_contents.index') }}">Page Contents</a></li>
                    <li class="breadcrumb-item active">Create</li>
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

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Add New Page Content</h3>
                    </div>
                    <form action="{{ route('admin.page_contents.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ old('page_slug') }}" required placeholder="e.g. home, about, services">
                                        <small class="text-muted">Unique identifier for the page.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Main heading of the page">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="2" placeholder="Brief sub-heading">{{ old('subtitle') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Page summary or meta description">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Full Content</label>
                                <textarea name="content" id="summernote" class="form-control">{{ old('content') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Highlights (JSON Array)</label>
                                        <textarea name="highlights" id="highlights" class="form-control" rows="4" placeholder='["Fast Delivery", "Secure Payment"]'>{{ old('highlights') }}</textarea>
                                        <small class="text-muted">Format: ["Item 1", "Item 2"]</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta">Meta Data (JSON Object)</label>
                                        <textarea name="meta" id="meta" class="form-control" rows="4" placeholder='{"meta_title": "Home", "meta_desc": "..."}'>{{ old('meta') }}</textarea>
                                        <small class="text-muted">Format: {"key": "value"}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i> Create Page Content
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
