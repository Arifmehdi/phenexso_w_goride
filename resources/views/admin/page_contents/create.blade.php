@extends('admin.master')
@section('title', 'Create Page Content | Admin Dashboard')
@section('body')

<div class="container-fluid pt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Page Content</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.page_contents.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="page_slug">Page Slug</label>
                    <input type="text" name="page_slug" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea name="subtitle" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="highlights">Highlights (JSON)</label>
                    <textarea name="highlights" class="form-control" rows="3" placeholder='["Highlight 1", "Highlight 2"]'></textarea>
                </div>
                <div class="form-group">
                    <label for="meta">Meta (JSON)</label>
                    <textarea name="meta" class="form-control" rows="3" placeholder='{"key": "value"}'></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection