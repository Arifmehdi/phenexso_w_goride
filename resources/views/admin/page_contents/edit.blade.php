@extends('admin.master')
@section('title', 'Edit Page Content | Admin Dashboard')
@section('body')

<div class="container-fluid pt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Page Content</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.page_contents.update', $pageContent->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="page_slug">Page Slug</label>
                    <input type="text" name="page_slug" class="form-control" value="{{ $pageContent->page_slug }}" required>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $pageContent->title }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea name="subtitle" class="form-control" rows="3">{{ $pageContent->subtitle }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $pageContent->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" rows="5">{{ $pageContent->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="highlights">Highlights (JSON)</label>
                    <textarea name="highlights" class="form-control" rows="3">{{ json_encode($pageContent->highlights) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="meta">Meta (JSON)</label>
                    <textarea name="meta" class="form-control" rows="3">{{ json_encode($pageContent->meta) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection