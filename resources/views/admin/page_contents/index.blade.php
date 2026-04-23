@extends('admin.master')
@section('title', 'Page Contents | Admin Dashboard')
@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-file-alt mr-2"></i>Page Contents</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Page Contents</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list mr-2"></i>Manage Page Contents</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.page_contents.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus mr-1"></i>Add New Page Content
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($pageContents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 20%">Page Slug</th>
                                            <th style="width: 25%">Title</th>
                                            <th style="width: 15%">Description</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pageContents as $content)
                                        <tr>
                                            <td>{{ $content->id }}</td>
                                            <td>
                                                <span class="badge badge-info"><i class="fas fa-bookmark mr-1"></i>{{ ucfirst($content->page_slug) }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $content->title }}</strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ Str::limit($content->description, 50, '...') }}</small>
                                            </td>
                                            <td>
                                                @if($content->active)
                                                    <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i>Active</span>
                                                @else
                                                    <span class="badge badge-danger"><i class="fas fa-times-circle mr-1"></i>Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.page_contents.show', $content->id) }}" class="btn btn-primary" title="View Admin Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    @if($content->page_slug == 'home')
                                                        <a href="{{ route('home') }}" target="_blank" class="btn btn-info" title="View Frontend Page">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    @elseif($content->page_slug == 'about')
                                                        <a href="{{ route('about') }}" target="_blank" class="btn btn-info" title="View Frontend Page">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    @elseif($content->page_slug == 'services')
                                                        <a href="{{ route('service') }}" target="_blank" class="btn btn-info" title="View Frontend Page">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    @elseif($content->page_slug == 'fleet')
                                                        <a href="{{ route('fleet') }}" target="_blank" class="btn btn-info" title="View Frontend Page">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    @elseif($content->page_slug == 'tours')
                                                        <a href="{{ route('tours') }}" target="_blank" class="btn btn-info" title="View Frontend Page">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('admin.page_contents.edit', $content->id) }}" class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.page_contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this page content?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="text-muted"><small>Total Records: {{ $pageContents->total() }}</small></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        {{ $pageContents->links() }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>No page contents found!</strong> Create your first page content by clicking the "Add New Page Content" button.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection