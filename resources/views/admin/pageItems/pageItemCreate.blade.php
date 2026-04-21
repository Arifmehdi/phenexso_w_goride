@extends('admin.master')

@section('title')
    | PageItem Create
@endsection

@push('css')
{{-- Add custom CSS here if needed --}}
@endpush

@section('body')
<section class="content py-3">
    <div class="col-md-11 mx-auto">

        {{-- Page Info Card --}}
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted mb-0">
                    <i class="fas fa-file text-info"></i> Page Edit: Page_id#{{ $page->id }} 
                    <i class="w3-tiny">({{ $page->name_en }})</i>
                </h3>

                <div class="card-tools w3-small">
                    {{-- Copy URL Button and View Link --}}
                    @if ($page->link)
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{ $page->id }}" data-text="{{ $page->link }}">
                            Copy url
                        </button>
                        <a target="_blank" href="{{ $page->link }}" class="badge badge-primary">View</a>
                    @else
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{ $page->id }}"
                            data-text="{{ route('page', $page->slug) }}">
                            Copy url
                        </button>
                        <a target="_blank" href="{{ route('page', $page->slug) }}" class="badge badge-primary">View</a>
                    @endif

                    {{-- Navigation Buttons --}}
                    <a class="btn-outline-primary btn btn-xs py-1" href="{{ route('admin.pageEdit', $page) }}">Edit Page</a>
                    <a href="{{ route('admin.pagesAll') }}" class="btn btn-outline-secondary btn-xs mr-1 py-1">Pages</a>
                    <a href="{{ route('admin.menusAll') }}" class="btn btn-outline-secondary btn-xs mr-2 py-1">Menus</a>
                </div>
            </div>
        </div>

        {{-- Existing Page Items List --}}
        <div class="card w3-round shadow-lg">
            <div class="card-header">
                <h3 class="card-title w3-small text-bold text-muted">
                    <i class="fas fa-th text-primary"></i> All Page Items
                </h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body bg-light px-0 pb-0 pt-1 w3-light-gray">
                <div class="showMenu col-sm-12 connectedSortable" id="sortablePanel">
                        @foreach ($page->pageItems as $item)
                            <div class="card mb-1 shadow" id="{{ $item->id }}">
                                <div class="card-header w3-small px-2 py-1">
                                    <i class="fas fa-arrows-alt-v text-muted" style="cursor: move;"></i>

                                    @if ($item->active)
                                        <i class="fas fa-check-square text-success" style="cursor: move;"></i>
                                    @else
                                        <i class="far fa-square w3-light-gray" style="cursor: move;"></i>
                                    @endif
                                    <span class="text-muted w3-small">{{ $item->name_en ?$item->name_en : '' }}
                                    </span>
                                    <a title="Delete" class="btn btn-default btn-xs float-right ml-1" onclick="return confirm('Do you really want to delete?')" href="{{ route('admin.pageItemDelete',$item)}}"><i class="fas fa-times-circle text-danger"></i></a>
                                    <a title="Edit" class="btn btn-default btn-xs float-right" href="{{ route('admin.pageItemEdit',$item)}}"> <i class="fas fa-edit text-muted"></i></a>
                                </div>

                            </div>
                        @endforeach
                </div>
            </div>
        </div>

        {{-- Create Page Item Form --}}
        <div class="mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-file-alt text-info"></i> Create Page Item
                    </h3>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">
                    <div class="row">
                        {{-- Form Section --}}
                        <div class="col-sm-7">
                            <div class="card card-default">
                                <div class="card-body">
                                    <form method="post" action="{{ route('admin.pageItemStore') }}">
                                        @csrf
                                        <input type="hidden" name="page_id" value="{{ $page->id }}">

                                        {{-- Title --}}
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control" placeholder="Name">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Description --}}
                                        <div class="form-group">
                                            <label for="description_en">Description</label>
                                            <textarea name="description_en" class="summernote form-control" rows="5" placeholder="Description">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Active & Editor Checkboxes + Submit Button --}}
                                        <div class="form-row mt-n2 mb-n3">
                                            <div class="col-md-6"></div>

                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input" type="checkbox" name="active" id="active" {{ old('active', 1) ? 'checked' : '' }}>
                                                <label for="active" role="button">Active</label>
                                            </div>

                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input" type="checkbox" name="editor" id="editor" {{ old('editor', 1) ? 'checked' : '' }}>
                                                <label for="editor" role="button">Editor</label>
                                            </div>

                                            <div class="form-group input-group-xs col-md-2 w3-small">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-sm btn-block mt-n3">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Media Container --}}
                        <div class="col-sm-5">
                             @include('admin.media.mediaContainer')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Copy URL to clipboard functionality
        $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy url');
            $(this).text('Copied!');

            var copyText = $(this).attr('data-text');
            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        });
    });
</script>
@endpush
















