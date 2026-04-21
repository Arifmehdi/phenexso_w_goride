@extends('admin.master')

@section('title')
    | Pages Edit
@endsection

@push('css')
{{-- Add custom CSS here if needed --}}
@endpush

@section('body')
<section class="content py-3">
    <div class="col-md-11 mx-auto">
        {{-- Page Header --}}
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted pt-1">
                    <i class="fas fa-file text-info"></i> Page-ID#{{ $pageItem->page->id }} 
                    <i class="w3-tiny">({{ $pageItem->page->name_en }})</i>
                </h3>
                <div class="card-tools w3-small">

                    @if ($pageItem->page->link)
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{ $pageItem->page->id }}" data-text="{{ $pageItem->page->link }}">
                            Copy url
                        </button>
                        <a target="_blank" href="{{ $pageItem->page->link }}" class="badge badge-primary">View</a>
                    @else
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{ $pageItem->page->id }}" data-text="{{ route('page', $pageItem->page->slug) }}">
                            Copy url
                        </button>
                        <a target="_blank" href="{{ route('page', $pageItem->page->slug) }}" class="badge badge-primary">View</a>
                    @endif

                    <a class="btn-outline-primary btn btn-xs py-1" href="{{ route('admin.pageEdit', $pageItem->page->id) }}">Edit Page</a>

                    <a href="{{ route('admin.pagesAll') }}" class="btn btn-outline-secondary btn-xs mr-0 py-1">Pages</a>
                    <a href="{{ route('admin.menusAll') }}" class="btn btn-outline-secondary btn-xs mr-2 py-1">Menus</a>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        <div class="mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-edit text-info"></i> Edit Page Item
                    </h3>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card card-default">
                                <div class="card-body">
                                    <form method="post" action="{{ route('admin.pageItemUpdate', $pageItem->id) }}">
                                        @csrf
                                        <input type="hidden" name="page_id" value="{{ $pageItem->page->id }}">

                                        {{-- Title --}}
                                        <div class="form-group">
                                            <label for="name_en">Title</label>
                                            <input type="text" name="name_en" value="{{ old('name_en', $pageItem->name_en) }}" class="form-control" placeholder="Name">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Description --}}
                                        <div class="form-group">
                                            <label for="description_en">Description English</label>
                                            <textarea name="description_en" 
                                                class="{{ $pageItem->editor ? 'summernote form-control' : 'form-control' }}" rows="5">{{ old('description_en', $pageItem->description_en) }}</textarea>
                                            @error('description_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Checkboxes and Submit --}}
                                        <div class="form-row mt-n2 mb-n3">
                                            <div class="col-md-6"></div>
                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input" type="checkbox" name="active" id="active" {{ old('active', $pageItem->active) ? 'checked' : '' }}>
                                                <label for="active" role="button">Active</label>
                                            </div>

                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input" type="checkbox" name="editor" id="editor" {{ old('editor', $pageItem->editor) ? 'checked' : '' }}>
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
        // Copy URL to clipboard
        $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy url');
            $(this).text('Copied!');

            var copyText = $(this).attr('data-text');
            if(!copyText) {
                alert('No URL to copy!');
                return;
            }
            
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
