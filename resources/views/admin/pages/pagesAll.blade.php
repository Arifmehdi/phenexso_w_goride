@extends('admin.master')

@section('title')
    | Pages All
@endsection

@push('css')
{{-- Add custom CSS here if needed --}}
@endpush

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            {{-- Card header with title and link to menus --}}
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-file-alt text-info"></i> Pages
                    </h3>
                    <div class="card-tools px-3">
                        <a href="{{ route('admin.menusAll') }}"
                        class="btn btn-outline-secondary btn-xs py-1">
                        <i class="fas fa-plus-square"></i> Menus
                       </a>
                    </div>
                </div>
            </div>

            {{-- Page creation form --}}
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 pb-0 pt-1 w3-light-gray">
                    <form action="{{ route('admin.pageStore') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            {{-- Page Name --}}
                            <div class="form-group input-group-sm w3-small col-md-6">
                                <label for="name_en" class="text-muted">
                                    Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name_en" id="name_en" class="form-control" 
                                    placeholder="Name" value="{{ old('name_en') }}" onkeyup="makeSlug(this.value)">
                                @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           

                            {{-- Excerpt --}}
                            <div class="form-group input-group-sm w3-small col-md-6">
                                <label for="excerpt_en" class="text-muted">Excerpt</label>
                                <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="1" 
                                    placeholder="Enter Excerpt">{{ old('excerpt_en') }}</textarea>
                            </div>

                        
                              
                           <div class="form-group col-md-12 mt-2">
                                <label for="slug" class="text-muted">Link (URL)</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="slugPrefix" style="min-width: 150px; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ url('/') }}/
                                    </span>
                                    </div>
                                    <input type="text" value="{{old('slug')}}" class="form-control" id="slug" name="slug"  placeholder="Slug" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                        </div>

                        {{-- Select Menus --}}
                        <div class="form-row mt-3">
                            <div class="card bg-transparent w-100">
                                <div class="card-header px-2 py-2">
                                    <h3 class="card-title w3-small text-muted text-bold mb-0">Select Menu</h3>
                                </div>
                                <div class="card-body px-3 pt-1 pb-0">
                                    <div class="form-group m-0 p-0">
                                        <div class="row">
                                            @foreach ($menus as $menu)
                                                <div class="checkbox mr-3 mb-2">
                                                    <label class="w3-small">
                                                        <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                                                        {{ $menu->name_en }}
                                                        <span class="w3-tiny">({{ $menu->type }})</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Active checkbox and submit button --}}
                        <div class="form-row mt-3 mb-2 align-items-center">
                            <div class="col-md-9"></div>
                            <div class="form-group input-group-sm col-md-1 w3-small">
                                <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                                <label for="active" role="button" class="mb-0">Active</label>
                            </div>
                            <div class="form-group input-group-sm col-md-2 w3-small">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Pages list --}}
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted">
                        <i class="fas fa-th text-info"></i> All Pages
                    </h3>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-1">
                    <div class="showEvent col-sm-12 connectedSortable data-container" id="sortablePanel"
                        data-url="{{ route('admin.pageSort') }}">
                        @include('admin.pages.searchData')
                        <div class="w3-small float-right mt-1">
                            {!! $pages->links() !!}
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
        // Setup CSRF for AJAX
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // Copy to clipboard button
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

        // Live search menus/pages
        $(document).on('keyup', ".menupage-search", function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            var q = that.val();
            $.ajax({
                url: url,
                data: { q: q },
                method: "GET",
                success: function(res) {
                    if(res.success) {
                        $(".data-container").empty().append(res.page);
                    }
                }
            });
        });
    });

    // Initialize sortable for pages with AJAX update
    $("#sortablePanel").sortable({
        connectWith: ".connectedSortable",
        distance: 5,
        delay: 300,
        opacity: 0.6,
        cursor: 'move',
        update: function() {
            var order = $('#sortablePanel').sortable('toArray'),
                url = $("#sortablePanel").attr('data-url');
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: { sorted_data: order },
                success: function(response) {
                    if (!response.success) {
                        alert('Sorting update failed!');
                    }
                },
                error: function() {
                    alert('Server error!');
                }
            });
        }
    }).disableSelection();

    // Function to generate slug from name input
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
