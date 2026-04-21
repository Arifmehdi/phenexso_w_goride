@extends('admin.master')

@section('title')
    | Page Edit
@endsection

@push('css')
{{-- Add custom CSS here if needed --}}
@endpush

@section('body')
<section class="content py-3">
  <div class="row">
    <div class="col-md-11 mx-auto">

        {{-- Card header with page info --}}
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                 <h3 class="card-title w3-small text-bold text-muted mb-0 pt-1" style="padding-top: 3px;">
                   <i class="fas fa-file text-info"></i> Page Edit: Page_id#{{ $page->id }} 
                   <i class="w3-tiny">({{ $page->name_en }})</i>
                 </h3>
                 <div class="card-tools px-3">
                    <a href="{{ route('admin.menusAll') }}" class="btn btn-outline-primary btn-xs py-1">
                   <i class="fas fa-plus-square"></i> Menus
                   </a>
                 </div>
            </div>
        </div>

        {{-- Edit form --}}
        <div class="card w3-round mb-2 shadow-lg">
            <div class="card-body px-3 pb-0 pt-1 w3-light-gray">
                <form action="{{ route('admin.pageUpdate', $page->id) }}" method="POST">
                    @csrf

                    <div class="form-row">
                        {{-- Name Input --}}
                        <div class="form-group input-group-sm w3-small col-md-6">
                          <label for="name_en">Name <span class="text-danger">*</span></label>
                          <input type="text" name="name_en" id="name_en" 
                                 value="{{ old('name_en', $page->name_en) }}" 
                                 class="form-control" placeholder="Name" onkeyup="makeSlug(this.value)">
                          @error('name_en')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                       

                        {{-- Excerpt --}}
                        <div class="form-group input-group-sm w3-small col-md-6">
                          <label for="excerpt_en">Excerpt</label>
                          <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="1" placeholder="Enter Excerpt">{{ old('excerpt_en', $page->excerpt_en) }}</textarea>
                        </div>

                        {{-- Link --}}
                         <div class="form-group col-md-12 mt-2">
                            <label for="slug" class="text-muted">Link (URL)</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="slugPrefix" style="min-width: 150px; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ url('/') }}/
                                </span>
                                </div>
                                <input type="text" value="{{ old('name_en', $page->slug) }}" class="form-control" id="slug" name="slug"  placeholder="Slug" required>
                            </div>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Menus Selection --}}
                    <div class="form-row mt-3">
                        <div class="card bg-transparent w-100">
                            <div class="card-header px-2 py-2">
                                <h3 class="card-title w3-small text-muted text-bold mb-0">Select Menu</h3>
                            </div>
                            <div class="card-body px-3 pb-0 pt-1">
                                <div class="form-group m-0 p-0">
                                    <div class="row">
                                        @foreach ($menus as $menu)
                                            <div class="checkbox mr-3 mb-2">
                                              <label class="w3-small">
                                                <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
                                                  {{ in_array($menu->id, $page->menus()->pluck('menu_id')->toArray()) ? 'checked' : '' }}>
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

                    {{-- Active Checkbox & Submit --}}
                    <div class="form-row mt-2 mb-3 align-items-center">
                        <div class="col-md-9"></div>
                        <div class="form-group input-group-sm col-md-1 w3-small pt-3">
                            <input class="form-check-input" type="checkbox" name="active" id="active" {{ $page->active ? 'checked' : '' }}>
                            <label for="active" role="button">Active</label>
                        </div>
                        <div class="form-group input-group-sm col-md-2 w3-small">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                        </div>
                    </div>

                </form>
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

    // Slug generation from name input
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endpush
