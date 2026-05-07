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
                    <form action="{{ route('admin.page_contents.update', $pageContent->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ old('page_slug', $pageContent->page_slug) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Page Title (EN)</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $pageContent->title) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title_bn">Page Title (BN)</label>
                                        <input type="text" name="title_bn" id="title_bn" class="form-control" value="{{ old('title_bn', $pageContent->title_bn) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="image">Featured Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    @php
                                        $imagePath = isset($pageContent->meta['image']) ? asset('storage/page_contents/' . $pageContent->meta['image']) : null;
                                    @endphp
                                    @if($imagePath)
                                        <img src="{{ $imagePath }}" class="img-thumbnail" style="max-height: 80px;">
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subtitle">Subtitle (EN)</label>
                                        <textarea name="subtitle" id="subtitle" class="form-control" rows="2">{{ old('subtitle', $pageContent->subtitle) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subtitle_bn">Subtitle (BN)</label>
                                        <textarea name="subtitle_bn" id="subtitle_bn" class="form-control" rows="2">{{ old('subtitle_bn', $pageContent->subtitle_bn) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description (EN)</label>
                                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $pageContent->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description_bn">Description (BN)</label>
                                        <textarea name="description_bn" id="description_bn" class="form-control" rows="3">{{ old('description_bn', $pageContent->description_bn) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="content">Full Content (EN)</label>
                                        <textarea name="content" id="summernote" class="form-control">{{ old('content', $pageContent->content) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="content_bn">Full Content (BN)</label>
                                        <textarea name="content_bn" id="summernote_bn" class="form-control">{{ old('content_bn', $pageContent->content_bn) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Highlights (EN JSON)</label>
                                        <textarea name="highlights" id="highlights" class="form-control" rows="4">{{ old('highlights', is_array($pageContent->highlights) ? json_encode($pageContent->highlights, JSON_PRETTY_PRINT) : $pageContent->highlights) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Highlights (BN JSON)</label>
                                        <textarea name="highlights_bn" id="highlights_bn" class="form-control" rows="4">{{ old('highlights_bn', is_array($pageContent->highlights_bn) ? json_encode($pageContent->highlights_bn, JSON_PRETTY_PRINT) : $pageContent->highlights_bn) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Meta (EN JSON)</label>
                                        <textarea name="meta" id="meta_json" class="form-control" rows="4">{{ old('meta', is_array($pageContent->meta) ? json_encode($pageContent->meta, JSON_PRETTY_PRINT) : $pageContent->meta) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Meta (BN JSON)</label>
                                        <textarea name="meta_bn" id="meta_bn_json" class="form-control" rows="4">{{ old('meta_bn', is_array($pageContent->meta_bn) ? json_encode($pageContent->meta_bn, JSON_PRETTY_PRINT) : $pageContent->meta_bn) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            @if($pageContent->page_slug == 'home')
                            <div class="card card-outline card-primary mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-home mr-1"></i> Home Hero (Bilingual)</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4"><label>Hero Badge (EN)</label><input type="text" id="hero_badge" class="form-control" value="{{ $pageContent->meta['hero_badge'] ?? '' }}"></div>
                                        <div class="col-md-4"><label>Hero Badge (BN)</label><input type="text" id="hero_badge_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_badge'] ?? '' }}"></div>
                                        <div class="col-md-2"><label>CTA Text (EN)</label><input type="text" id="hero_cta_text" class="form-control" value="{{ $pageContent->meta['hero_cta_text'] ?? '' }}"></div>
                                        <div class="col-md-2"><label>CTA Text (BN)</label><input type="text" id="hero_cta_text_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_cta_text'] ?? '' }}"></div>
                                        
                                        <div class="col-md-6 mt-2"><label>Hero Title (EN)</label><input type="text" id="hero_title" class="form-control" value="{{ $pageContent->meta['hero_title'] ?? '' }}"></div>
                                        <div class="col-md-6 mt-2"><label>Hero Title (BN)</label><input type="text" id="hero_title_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_title'] ?? '' }}"></div>
                                        
                                        <div class="col-md-6 mt-2"><label>Hero Subtitle (EN)</label><textarea id="hero_subtitle" class="form-control" rows="2">{{ $pageContent->meta['hero_subtitle'] ?? '' }}</textarea></div>
                                        <div class="col-md-6 mt-2"><label>Hero Subtitle (BN)</label><textarea id="hero_subtitle_bn" class="form-control" rows="2">{{ $pageContent->meta_bn['hero_subtitle'] ?? '' }}</textarea></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-info mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-th-large mr-1"></i> Entry Cards</h3></div>
                                <div class="card-body">
                                    <div id="entry-cards-container">
                                        @php $entry_cards = $pageContent->meta['entry_cards'] ?? []; if(is_string($entry_cards)) $entry_cards = json_decode($entry_cards, true) ?: []; @endphp
                                        @foreach($entry_cards as $index => $card)
                                        <div class="entry-card-item border p-3 mb-3 position-relative bg-light">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-entry-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-4"><label>Title (EN)</label><input type="text" class="form-control entry-card-title" value="{{ $card['title'] ?? '' }}"></div>
                                                <div class="col-md-4"><label>Icon</label><input type="text" class="form-control entry-card-icon" value="{{ $card['icon'] ?? '' }}"></div>
                                                <div class="col-md-4"><label>Btn Text (EN)</label><input type="text" class="form-control entry-card-btn-text" value="{{ $card['btn_text'] ?? '' }}"></div>
                                                <div class="col-md-12 mt-2"><label>Description (EN)</label><textarea class="form-control entry-card-description" rows="2">{{ $card['description'] ?? '' }}</textarea></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-entry-card" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Entry Card</button>
                                </div>
                            </div>

                            <div class="card card-outline card-success mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Stats</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3"><label>Customers</label><input type="text" id="stats_customers" class="form-control" value="{{ $pageContent->meta['stats_customers'] ?? '' }}"></div>
                                        <div class="col-md-3"><label>Fleet</label><input type="text" id="stats_fleet" class="form-control" value="{{ $pageContent->meta['stats_fleet'] ?? '' }}"></div>
                                        <div class="col-md-3"><label>Districts</label><input type="text" id="stats_districts" class="form-control" value="{{ $pageContent->meta['stats_districts'] ?? '' }}"></div>
                                        <div class="col-md-3"><label>Corporate</label><input type="text" id="stats_corporate" class="form-control" value="{{ $pageContent->meta['stats_corporate'] ?? '' }}"></div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submit-btn"><i class="fas fa-save mr-1"></i> Update Page Content</button>
                            <a href="{{ route('admin.page_contents.index') }}" class="btn btn-default float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        if (typeof $('#summernote').summernote !== 'undefined') {
            $('#summernote, #summernote_bn').summernote({ height: 200 });
        }

        function updateMetaJson() {
            let meta = {}; try { meta = JSON.parse($('#meta_json').val() || '{}'); } catch (e) {}
            let meta_bn = {}; try { meta_bn = JSON.parse($('#meta_bn_json').val() || '{}'); } catch (e) {}

            if ($('#hero_title').length > 0) {
                meta.hero_badge = $('#hero_badge').val();
                meta.hero_title = $('#hero_title').val();
                meta.hero_subtitle = $('#hero_subtitle').val();
                meta.hero_cta_text = $('#hero_cta_text').val();
                
                meta_bn.hero_badge = $('#hero_badge_bn').val();
                meta_bn.hero_title = $('#hero_title_bn').val();
                meta_bn.hero_subtitle = $('#hero_subtitle_bn').val();
                meta_bn.hero_cta_text = $('#hero_cta_text_bn').val();

                meta.stats_customers = $('#stats_customers').val();
                meta.stats_fleet = $('#stats_fleet').val();
                meta.stats_districts = $('#stats_districts').val();
                meta.stats_corporate = $('#stats_corporate').val();

                let entry = []; $('.entry-card-item').each(function() {
                    entry.push({
                        title: $(this).find('.entry-card-title').val(),
                        icon: $(this).find('.entry-card-icon').val(),
                        btn_text: $(this).find('.entry-card-btn-text').val(),
                        description: $(this).find('.entry-card-description').val()
                    });
                });
                meta.entry_cards = entry;
            }

            $('#meta_json').val(JSON.stringify(meta, null, 4));
            $('#meta_bn_json').val(JSON.stringify(meta_bn, null, 4));
        }

        $('#add-entry-card').click(function() {
            $('#entry-cards-container').append('<div class="entry-card-item border p-3 mb-3 position-relative bg-light"><button type="button" class="btn btn-danger btn-sm position-absolute remove-entry-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-4"><label>Title (EN)</label><input type="text" class="form-control entry-card-title"></div><div class="col-md-4"><label>Icon</label><input type="text" class="form-control entry-card-icon"></div><div class="col-md-4"><label>Btn Text (EN)</label><input type="text" class="form-control entry-card-btn-text"></div><div class="col-md-12 mt-2"><label>Description (EN)</label><textarea class="form-control entry-card-description" rows="2"></textarea></div></div></div>');
        });

        $(document).on('click', '.remove-entry-card', function() { $(this).closest('.entry-card-item').remove(); updateMetaJson(); });
        $('#submit-btn').click(function() { updateMetaJson(); });
        $(document).on('change', 'input, textarea', function() { updateMetaJson(); });
    });
</script>
@endpush
