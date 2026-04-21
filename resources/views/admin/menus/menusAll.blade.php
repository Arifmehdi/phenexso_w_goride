@extends('admin.master')

@push('css')
{{-- Add custom CSS here if needed --}}
@endpush

@section('body')


<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            {{-- Card Header --}}
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-sitemap text-primary"></i> Menus
                    </h3>
                </div>
            </div>

            {{-- Create Menu Form --}}
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form action="{{ route('admin.menuStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            {{-- Name Input --}}
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label for="name_en" class="text-muted">
                                    Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name_en" id="name_en" placeholder="Name..."
                                    class="form-control" value="{{ old('name_en') }}" onkeyup="makeSlug(this.value)" required>
                                @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Slug Input --}}
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label for="slug" class="text-muted">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" placeholder="URL"
                                    class="form-control" value="{{ old('slug') }}" required>
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Menu Type Select --}}
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label for="type" class="text-muted">Menu Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">Select menu type</option>
                                    @foreach (config('parameter.menu_type') as $item)
                                        <option value="{{ $item }}" {{ old('type') == $item ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Link Input --}}
                            <div class="form-group input-group-sm w3-small col-md-6 mt-3">
                                <label for="link" class="text-muted">Link</label>
                                <input type="text" name="link" id="link" placeholder="https://example.com/go"
                                    class="form-control" value="{{ old('link') }}">
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group input-group-sm w3-small col-md-2 mt-4">
                                <label for="" class="text-muted"></label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Menus List --}}
            <div class="card shadow-lg w3-round">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1">
                        <i class="fas fa-th text-primary"></i> All Menus
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" class="form-control border-right-0 border text-muted menupage-search"
                                placeholder="Search name, id..." data-url="{{ route('admin.menupageSearch', ['type' => 'menu']) }}">
                            <span class="input-group-append">
                                <div class="input-group-text bg-transparent">
                                    <i class="fa fa-search w3-text-orange"></i>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Menus sortable container --}}
                <div class="card-body bg-light px-0 pt-1 pb-0">
                    <div class="showMenu col-sm-12 connectedSortable data-container" id="sortablePanel" data-url="{{ route('admin.menuSort') }}">
                        @include('admin.menus.searchData')

                        {{-- Pagination Links --}}
                        <div class="w3-small">
                            {!! $menus->links() !!}
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
        // Initialize sortable on the menus container
        $("#sortablePanel").sortable({
            connectWith: ".connectedSortable",
            distance: 5,
            delay: 300,
            opacity: 0.6,
            cursor: 'move',

            // Update the order via AJAX after sorting
            update: function() {
                var order = $('#sortablePanel').sortable('toArray'),
                    url = $("#sortablePanel").attr('data-url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    cache: false,
                    data: { sorted_data: order },
                    success: function(response) {
                        if (!response.success) {
                            alert('Order update failed!');
                        }
                    },
                    error: function() {
                        alert('Server error occurred!');
                    }
                });
            }
        }).disableSelection();

        // Copy URL to clipboard button handler
        $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            // Reset all buttons text
            $(".copyboard").text('Copy url');
            // Change clicked button text
            $(this).text('Copied!');

            var copyText = $(this).attr('data-text');
            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";  // Prevent scroll jump
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        });

        // Search input keyup event for live searching menus
        $(document).on('keyup', ".menupage-search", function(e) {
            e.preventDefault();

            var that = $(this);
            var url = that.attr('data-url');
            var q = that.val();

            $.ajax({
                url: url,
                method: "GET",
                data: { q: q },
                success: function(res) {
                    if (res.success) {
                        $(".data-container").empty().append(res.page);
                    }
                }
            });
        });
    });

    // Auto-generate slug from name input
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
