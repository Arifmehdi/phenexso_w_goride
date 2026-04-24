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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ old('page_slug', $pageContent->page_slug) }}" required>
                                        <small class="text-muted">Used for identifying the page (e.g., 'home', 'about')</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Page Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $pageContent->title) }}">
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
                                        <small class="text-muted">Recommended size: 800x600px. Max size: 2MB.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $imagePath = null;
                                        if (isset($pageContent->meta['image'])) {
                                            $imagePath = asset('storage/page_contents/' . $pageContent->meta['image']);
                                        }
                                    @endphp
                                    @if($imagePath)
                                        <div class="mt-2 text-center text-sm">
                                            <label class="mb-0">Current Image:</label><br>
                                            <img src="{{ $imagePath }}" alt="Current Image" class="img-thumbnail" style="max-height: 80px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="2">{{ old('subtitle', $pageContent->subtitle) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $pageContent->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Full Content (Hidden from some views)</label>
                                <textarea name="content" id="summernote" class="form-control">{{ old('content', $pageContent->content) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Highlights (JSON Array)</label>
                                        <textarea name="highlights" id="highlights" class="form-control" rows="4" placeholder='["Fast Delivery", "Secure Payment"]'>{{ old('highlights', is_array($pageContent->highlights) ? json_encode($pageContent->highlights, JSON_PRETTY_PRINT) : $pageContent->highlights) }}</textarea>
                                        <small class="text-muted">Provide a valid JSON array.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta">Meta Data (JSON Object)</label>
                                        <textarea name="meta" id="meta_json" class="form-control" rows="4" placeholder='{"meta_title": "Home Page", "meta_desc": "..."}'>{{ old('meta', is_array($pageContent->meta) ? json_encode($pageContent->meta, JSON_PRETTY_PRINT) : $pageContent->meta) }}</textarea>
                                        <small class="text-muted">Provide a valid JSON object.</small>
                                    </div>
                                </div>
                            </div>

                            @if($pageContent->page_slug == 'home')
                            <div class="card card-outline card-primary mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-home mr-1"></i> Home Page Hero Section</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hero Badge Text</label>
                                                <input type="text" id="hero_badge" class="form-control" value="{{ $pageContent->meta['hero_badge'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>CTA Button Text</label>
                                                <input type="text" id="hero_cta_text" class="form-control" value="{{ $pageContent->meta['hero_cta_text'] ?? 'Book Now' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>CTA Button Link</label>
                                                <input type="text" id="hero_cta_link" class="form-control" value="{{ $pageContent->meta['hero_cta_link'] ?? '#' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hero Title (Main)</label>
                                                <input type="text" id="hero_title" class="form-control" value="{{ $pageContent->meta['hero_title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hero Title (Span/Accent)</label>
                                                <input type="text" id="hero_span" class="form-control" value="{{ $pageContent->meta['hero_span'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Hero Subtitle</label>
                                                <textarea id="hero_subtitle" class="form-control" rows="2">{{ $pageContent->meta['hero_subtitle'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Hero Background Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="hero_bg_image" class="custom-file-input" id="hero_bg_image">
                                                    <label class="custom-file-label" for="hero_bg_image">Choose file</label>
                                                </div>
                                                <small class="text-muted">Recommended size: 1920x800px. High quality JPEG/WebP.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @if(isset($pageContent->meta['hero_bg_image']) && $pageContent->meta['hero_bg_image'])
                                                <div class="text-center">
                                                    <img src="{{ asset('storage/page_contents/' . $pageContent->meta['hero_bg_image']) }}" style="max-height: 80px;" class="img-thumbnail">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-info mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-th-large mr-1"></i> Entry Cards (Drivers, Corporate, etc.)</h3></div>
                                <div class="card-body">
                                    <div id="entry-cards-container">
                                        @php
                                            $entry_cards = $pageContent->meta['entry_cards'] ?? [];
                                            if (is_string($entry_cards)) { $entry_cards = json_decode($entry_cards, true) ?: []; }
                                        @endphp
                                        @foreach($entry_cards as $index => $card)
                                        <div class="entry-card-item border p-3 mb-3 position-relative bg-light">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-entry-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control entry-card-title" value="{{ $card['title'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Icon Class</label>
                                                        <input type="text" class="form-control entry-card-icon" value="{{ $card['icon'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Button Text</label>
                                                        <input type="text" class="form-control entry-card-btn-text" value="{{ $card['btn_text'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control entry-card-description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Link</label>
                                                        <input type="text" class="form-control entry-card-link" value="{{ $card['link'] ?? '#' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-entry-card" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Entry Card</button>
                                </div>
                            </div>

                            <div class="card card-outline card-success mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Home Page Stats</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Happy Customers</label>
                                                <input type="text" id="stats_customers" class="form-control" value="{{ $pageContent->meta['stats_customers'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Fleet Vehicles</label>
                                                <input type="text" id="stats_fleet" class="form-control" value="{{ $pageContent->meta['stats_fleet'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Districts</label>
                                                <input type="text" id="stats_districts" class="form-control" value="{{ $pageContent->meta['stats_districts'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Corporate Clients</label>
                                                <input type="text" id="stats_corporate" class="form-control" value="{{ $pageContent->meta['stats_corporate'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-warning mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-star mr-1"></i> Why Choose Us Section</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Section Title</label>
                                                <input type="text" id="why_title" class="form-control" value="{{ $pageContent->meta['why_title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Section Subtitle</label>
                                                <input type="text" id="why_subtitle" class="form-control" value="{{ $pageContent->meta['why_subtitle'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="why-cards-container">
                                        @php
                                            $why_cards = $pageContent->meta['why_cards'] ?? [];
                                            if (is_string($why_cards)) { $why_cards = json_decode($why_cards, true) ?: []; }
                                        @endphp
                                        @foreach($why_cards as $index => $card)
                                        <div class="why-card-item border p-3 mb-3 position-relative bg-light">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-why-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Icon Class</label>
                                                        <input type="text" class="form-control why-card-icon" value="{{ $card['icon'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control why-card-title" value="{{ $card['title'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control why-card-description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-why-card" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Why Card</button>
                                </div>
                            </div>

                            <div class="card card-outline card-info mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-mobile-screen-button mr-1"></i> Mobile App Section</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>App Label</label>
                                                <input type="text" id="app_label" class="form-control" value="{{ $pageContent->meta['app_label'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>App Title</label>
                                                <input type="text" id="app_title" class="form-control" value="{{ $pageContent->meta['app_title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>App Span (Accent)</label>
                                                <input type="text" id="app_span" class="form-control" value="{{ $pageContent->meta['app_span'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>App Description</label>
                                                <textarea id="app_description" class="form-control" rows="2">{{ $pageContent->meta['app_description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>App Mockup Image (Floating Phone)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="app_mockup_image" class="custom-file-input" id="app_mockup_image">
                                                    <label class="custom-file-label" for="app_mockup_image">Choose file</label>
                                                </div>
                                                <small class="text-muted">Upload a transparent PNG of a mobile phone for the best effect.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @if(isset($pageContent->meta['app_mockup_image']) && $pageContent->meta['app_mockup_image'])
                                                <div class="text-center">
                                                    <img src="{{ asset('storage/page_contents/' . $pageContent->meta['app_mockup_image']) }}" style="max-height: 100px;" class="img-thumbnail">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>App Store Link (Apple)</label>
                                                <input type="text" id="app_store_apple" class="form-control" value="{{ $pageContent->meta['app_store_apple'] ?? '#' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Play Store Link (Google)</label>
                                                <input type="text" id="app_store_google" class="form-control" value="{{ $pageContent->meta['app_store_google'] ?? '#' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <label>App Features</label>
                                    <div id="app-features-container">
                                        @php
                                            $app_features = $pageContent->meta['app_features'] ?? [];
                                            if (is_string($app_features)) { $app_features = json_decode($app_features, true) ?: []; }
                                        @endphp
                                        @foreach($app_features as $index => $feature)
                                        <div class="app-feature-item input-group mb-2">
                                            <input type="text" class="form-control app-feature-text" value="{{ $feature }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger remove-app-feature" type="button"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-app-feature" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Feature</button>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'about')
                            <div class="card card-outline card-info mt-4">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-list mr-1"></i> Vision, Mission & Values Cards</h3>
                                </div>
                                <div class="card-body">
                                    <div id="vm-cards-container">
                                        @php
                                            $vm_cards = $pageContent->meta['vm_cards'] ?? [];
                                            if (is_string($vm_cards)) { $vm_cards = json_decode($vm_cards, true) ?: []; }
                                        @endphp
                                        @foreach($vm_cards as $index => $card)
                                        <div class="vm-card-item border p-3 mb-3 position-relative">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-vm-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group"><label>Title</label><input type="text" class="form-control vm-card-title" value="{{ $card['title'] ?? '' }}"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group"><label>Icon</label><input type="text" class="form-control vm-card-icon" value="{{ $card['icon'] ?? '' }}"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group"><label>Description</label><textarea class="form-control vm-card-description" rows="2">{{ $card['description'] ?? '' }}</textarea></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-vm-card" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Card</button>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'services')
                            <div class="card card-outline card-success mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-concierge-bell mr-1"></i> Service Items Manager</h3></div>
                                <div class="card-body">
                                    <div class="form-group"><label>Intro Text</label><textarea id="intro_text" class="form-control" rows="2">{{ $pageContent->meta['intro_text'] ?? '' }}</textarea></div>
                                    <hr>
                                    <div id="service-items-container">
                                        @php
                                            $service_items = $pageContent->meta['service_items'] ?? [];
                                            if (is_string($service_items)) { $service_items = json_decode($service_items, true) ?: []; }
                                        @endphp
                                        @foreach($service_items as $index => $item)
                                        <div class="service-item border p-3 mb-3 position-relative bg-light">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-service-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-6"><div class="form-group"><label>Title</label><input type="text" class="form-control service-item-title" value="{{ $item['title'] ?? '' }}"></div></div>
                                                <div class="col-md-6"><div class="form-group"><label>Icon</label><input type="text" class="form-control service-item-icon" value="{{ $item['icon'] ?? '' }}"></div></div>
                                                <div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control service-item-description" rows="2">{{ $item['description'] ?? '' }}</textarea></div></div>
                                                <div class="col-md-6"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control service-item-btn-text" value="{{ $item['btn_text'] ?? '' }}"></div></div>
                                                <div class="col-md-6"><div class="form-group"><label>Btn Link</label><input type="text" class="form-control service-item-link" value="{{ $item['link'] ?? '' }}"></div></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-service-item" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Service Item</button>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'fleet')
                            <div class="card card-outline card-warning mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-car mr-1"></i> Fleet Item Manager</h3></div>
                                <div class="card-body">
                                    <div class="form-group"><label>Intro Text</label><textarea id="fleet_intro_text" class="form-control" rows="2">{{ $pageContent->meta['intro_text'] ?? '' }}</textarea></div>
                                    <hr>
                                    <div id="fleet-items-container">
                                        @php
                                            $fleet_items = $pageContent->meta['fleet_items'] ?? [];
                                            if (is_string($fleet_items)) { $fleet_items = json_decode($fleet_items, true) ?: []; }
                                        @endphp
                                        @foreach($fleet_items as $index => $item)
                                        <div class="fleet-item border p-3 mb-3 position-relative bg-light" data-index="{{ $index }}">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-fleet-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-6"><div class="form-group"><label>Vehicle Name</label><input type="text" class="form-control fleet-item-title" value="{{ $item['title'] ?? '' }}"></div></div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label>Image</label>
                                                        <div class="custom-file"><input type="file" name="fleet_item_images[{{ $index }}]" class="custom-file-input fleet-item-image-file"><label class="custom-file-label">Choose</label></div>
                                                        <input type="hidden" class="fleet-item-image-path" value="{{ $item['image'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control fleet-item-description" rows="2">{{ $item['description'] ?? '' }}</textarea></div></div>
                                                <div class="col-md-12"><div class="form-group"><label>Specs (JSON)</label><textarea class="form-control fleet-item-specs" rows="2">{{ isset($item['specs']) ? json_encode($item['specs']) : '[]' }}</textarea></div></div>
                                                <div class="col-md-6"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control fleet-item-btn-text" value="{{ $item['btn_text'] ?? '' }}"></div></div>
                                                <div class="col-md-6"><div class="form-group"><label>Link</label><input type="text" class="form-control fleet-item-link" value="{{ $item['link'] ?? '' }}"></div></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-fleet-item" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Vehicle</button>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'tours')
                            <div class="card card-outline card-info mt-4">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-map-marked-alt mr-1"></i> Tour Packages Manager</h3></div>
                                <div class="card-body">
                                    <div class="form-group"><label>Intro Text</label><textarea id="tour_intro_text" class="form-control" rows="2">{{ $pageContent->meta['intro_text'] ?? '' }}</textarea></div>
                                    <hr>
                                    <div id="tour-items-container">
                                        @php
                                            $tour_items = $pageContent->meta['tour_items'] ?? [];
                                            if (is_string($tour_items)) { $tour_items = json_decode($tour_items, true) ?: []; }
                                        @endphp
                                        @foreach($tour_items as $index => $item)
                                        <div class="tour-item border p-3 mb-3 position-relative bg-light" data-index="{{ $index }}">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute remove-tour-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-6"><div class="form-group"><label>Title</label><input type="text" class="form-control tour-item-title" value="{{ $item['title'] ?? '' }}"></div></div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label>Image</label>
                                                        <div class="custom-file"><input type="file" name="tour_item_images[{{ $index }}]" class="custom-file-input tour-item-image-file"><label class="custom-file-label">Choose</label></div>
                                                        <input type="hidden" class="tour-item-image-path" value="{{ $item['image'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3"><div class="form-group"><label>Badge</label><input type="text" class="form-control tour-item-badge" value="{{ $item['badge'] ?? '' }}"></div></div>
                                                <div class="col-md-3"><div class="form-group"><label>Price</label><input type="text" class="form-control tour-item-price" value="{{ $item['price'] ?? '' }}"></div></div>
                                                <div class="col-md-3"><div class="form-group"><label>Duration</label><input type="text" class="form-control tour-item-duration" value="{{ $item['duration'] ?? '' }}"></div></div>
                                                <div class="col-md-3"><div class="form-group"><label>People</label><input type="text" class="form-control tour-item-people" value="{{ $item['people'] ?? '' }}"></div></div>
                                                <div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control tour-item-description" rows="2">{{ $item['description'] ?? '' }}</textarea></div></div>
                                                <div class="col-md-3"><div class="form-group"><label>Rating</label><input type="text" class="form-control tour-item-rating" value="{{ $item['rating'] ?? '' }}"></div></div>
                                                <div class="col-md-4"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control tour-item-btn-text" value="{{ $item['btn_text'] ?? '' }}"></div></div>
                                                <div class="col-md-5"><div class="form-group"><label>Link</label><input type="text" class="form-control tour-item-link" value="{{ $item['link'] ?? '' }}"></div></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-tour-item" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Add Tour Package</button>
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
        function updateMetaJson() {
            let meta = {};
            try { meta = JSON.parse($('#meta_json').val() || '{}'); } catch (e) { console.error("Invalid JSON", e); }
            
            if ($('#vm-cards-container').length > 0) {
                let items = []; $('.vm-card-item').each(function() { items.push({ title: $(this).find('.vm-card-title').val(), icon: $(this).find('.vm-card-icon').val(), description: $(this).find('.vm-card-description').val() }); });
                meta.vm_cards = items;
            }
            if ($('#service-items-container').length > 0) {
                meta.intro_text = $('#intro_text').val();
                let items = []; $('.service-item').each(function() { items.push({ title: $(this).find('.service-item-title').val(), icon: $(this).find('.service-item-icon').val(), description: $(this).find('.service-item-description').val(), btn_text: $(this).find('.service-item-btn-text').val(), link: $(this).find('.service-item-link').val() }); });
                meta.service_items = items;
            }
            if ($('#fleet-items-container').length > 0) {
                meta.intro_text = $('#fleet_intro_text').val();
                let items = []; $('.fleet-item').each(function(i) { $(this).find('.fleet-item-image-file').attr('name', 'fleet_item_images['+i+']'); let specs = []; try { specs = JSON.parse($(this).find('.fleet-item-specs').val() || '[]'); } catch(e){} items.push({ title: $(this).find('.fleet-item-title').val(), image: $(this).find('.fleet-item-image-path').val(), description: $(this).find('.fleet-item-description').val(), specs: specs, btn_text: $(this).find('.fleet-item-btn-text').val(), link: $(this).find('.fleet-item-link').val() }); });
                meta.fleet_items = items;
            }
            if ($('#tour-items-container').length > 0) {
                meta.intro_text = $('#tour_intro_text').val();
                let items = []; $('.tour-item').each(function(i) { $(this).find('.tour-item-image-file').attr('name', 'tour_item_images['+i+']'); items.push({ title: $(this).find('.tour-item-title').val(), image: $(this).find('.tour-item-image-path').val(), badge: $(this).find('.tour-item-badge').val(), price: $(this).find('.tour-item-price').val(), duration: $(this).find('.tour-item-duration').val(), people: $(this).find('.tour-item-people').val(), rating: $(this).find('.tour-item-rating').val(), description: $(this).find('.tour-item-description').val(), btn_text: $(this).find('.tour-item-btn-text').val(), link: $(this).find('.tour-item-link').val() }); });
                meta.tour_items = items;
            }
            if ($('#hero_title').length > 0) {
                meta.hero_badge = $('#hero_badge').val(); meta.hero_title = $('#hero_title').val(); meta.hero_span = $('#hero_span').val(); meta.hero_subtitle = $('#hero_subtitle').val(); meta.hero_cta_text = $('#hero_cta_text').val(); meta.hero_cta_link = $('#hero_cta_link').val();
                meta.stats_customers = $('#stats_customers').val(); meta.stats_fleet = $('#stats_fleet').val(); meta.stats_districts = $('#stats_districts').val(); meta.stats_corporate = $('#stats_corporate').val();
                meta.why_title = $('#why_title').val(); meta.why_subtitle = $('#why_subtitle').val();
                let why = []; $('.why-card-item').each(function() { why.push({ icon: $(this).find('.why-card-icon').val(), title: $(this).find('.why-card-title').val(), description: $(this).find('.why-card-description').val() }); });
                meta.why_cards = why;
                let entry = []; $('.entry-card-item').each(function() { entry.push({ title: $(this).find('.entry-card-title').val(), icon: $(this).find('.entry-card-icon').val(), btn_text: $(this).find('.entry-card-btn-text').val(), description: $(this).find('.entry-card-description').val(), link: $(this).find('.entry-card-link').val() }); });
                meta.entry_cards = entry;
                
                meta.app_label = $('#app_label').val(); meta.app_title = $('#app_title').val(); meta.app_span = $('#app_span').val(); meta.app_description = $('#app_description').val(); meta.app_store_apple = $('#app_store_apple').val(); meta.app_store_google = $('#app_store_google').val();
                let feats = []; $('.app-feature-text').each(function() { if($(this).val()) feats.push($(this).val()); });
                meta.app_features = feats;
            }
            $('#meta_json').val(JSON.stringify(meta, null, 4));
        }

        $('#add-vm-card').click(function() { $('#vm-cards-container').append('<div class="vm-card-item border p-3 mb-3 position-relative"><button type="button" class="btn btn-danger btn-sm position-absolute remove-vm-card" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-4"><div class="form-group"><label>Title</label><input type="text" class="form-control vm-card-title"></div></div><div class="col-md-4"><div class="form-group"><label>Icon</label><input type="text" class="form-control vm-card-icon"></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control vm-card-description" rows="2"></textarea></div></div></div></div>'); });
        $('#add-service-item').click(function() { $('#service-items-container').append('<div class="service-item border p-3 mb-3 position-relative bg-light"><button type="button" class="btn btn-danger btn-sm position-absolute remove-service-item" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-6"><div class="form-group"><label>Title</label><input type="text" class="form-control service-item-title"></div></div><div class="col-md-6"><div class="form-group"><label>Icon</label><input type="text" class="form-control service-item-icon"></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control service-item-description" rows="2"></textarea></div></div><div class="col-md-6"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control service-item-btn-text"></div></div><div class="col-md-6"><div class="form-group"><label>Btn Link</label><input type="text" class="form-control service-item-link"></div></div></div></div>'); });
        $('#add-fleet-item').click(function() { let i = $('.fleet-item').length; $('#fleet-items-container').append('<div class="fleet-item border p-3 mb-3 position-relative bg-light" data-index="'+i+'"><button type="button" class="btn btn-danger btn-sm position-absolute remove-fleet-item" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-6"><div class="form-group"><label>Vehicle Name</label><input type="text" class="form-control fleet-item-title"></div></div><div class="col-md-6"><div class="form-group"><label>Image</label><div class="custom-file"><input type="file" name="fleet_item_images['+i+']" class="custom-file-input fleet-item-image-file"><label class="custom-file-label">Choose</label></div><input type="hidden" class="fleet-item-image-path" value=""></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control fleet-item-description" rows="2"></textarea></div></div><div class="col-md-12"><div class="form-group"><label>Specs (JSON)</label><textarea class="form-control fleet-item-specs" rows="2">[]</textarea></div></div><div class="col-md-6"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control fleet-item-btn-text"></div></div><div class="col-md-6"><div class="form-group"><label>Link</label><input type="text" class="form-control fleet-item-link"></div></div></div></div>'); bsCustomFileInput.init(); });
        $('#add-tour-item').click(function() { let i = $('.tour-item').length; $('#tour-items-container').append('<div class="tour-item border p-3 mb-3 position-relative bg-light" data-index="'+i+'"><button type="button" class="btn btn-danger btn-sm position-absolute remove-tour-item" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-6"><div class="form-group"><label>Title</label><input type="text" class="form-control tour-item-title"></div></div><div class="col-md-6"><div class="form-group"><label>Image</label><div class="custom-file"><input type="file" name="tour_item_images['+i+']" class="custom-file-input tour-item-image-file"><label class="custom-file-label">Choose</label></div><input type="hidden" class="tour-item-image-path" value=""></div></div><div class="col-md-3"><div class="form-group"><label>Badge</label><input type="text" class="form-control tour-item-badge"></div></div><div class="col-md-3"><div class="form-group"><label>Price</label><input type="text" class="form-control tour-item-price"></div></div><div class="col-md-3"><div class="form-group"><label>Duration</label><input type="text" class="form-control tour-item-duration"></div></div><div class="col-md-3"><div class="form-group"><label>People</label><input type="text" class="form-control tour-item-people"></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control tour-item-description" rows="2"></textarea></div></div><div class="col-md-3"><div class="form-group"><label>Rating</label><input type="text" class="form-control tour-item-rating" value="5.0"></div></div><div class="col-md-4"><div class="form-group"><label>Btn Text</label><input type="text" class="form-control tour-item-btn-text" value="Book Now"></div></div><div class="col-md-5"><div class="form-group"><label>Link</label><input type="text" class="form-control tour-item-link" value="#"></div></div></div></div>'); bsCustomFileInput.init(); });
        $('#add-why-card').click(function() { $('#why-cards-container').append('<div class="why-card-item border p-3 mb-3 position-relative bg-light"><button type="button" class="btn btn-danger btn-sm position-absolute remove-why-card" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-4"><div class="form-group"><label>Icon Class</label><input type="text" class="form-control why-card-icon"></div></div><div class="col-md-8"><div class="form-group"><label>Title</label><input type="text" class="form-control why-card-title"></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control why-card-description" rows="2"></textarea></div></div></div></div>'); });
        $('#add-entry-card').click(function() { $('#entry-cards-container').append('<div class="entry-card-item border p-3 mb-3 position-relative bg-light"><button type="button" class="btn btn-danger btn-sm position-absolute remove-entry-card" style="top:10px;right:10px;"><i class="fas fa-times"></i></button><div class="row"><div class="col-md-4"><div class="form-group"><label>Title</label><input type="text" class="form-control entry-card-title"></div></div><div class="col-md-4"><div class="form-group"><label>Icon Class</label><input type="text" class="form-control entry-card-icon"></div></div><div class="col-md-4"><div class="form-group"><label>Button Text</label><input type="text" class="form-control entry-card-btn-text"></div></div><div class="col-md-12"><div class="form-group"><label>Description</label><textarea class="form-control entry-card-description" rows="2"></textarea></div></div><div class="col-md-12"><div class="form-group"><label>Link</label><input type="text" class="form-control entry-card-link" value="#"></div></div></div></div>'); });
        $('#add-app-feature').click(function() { $('#app-features-container').append('<div class="app-feature-item input-group mb-2"><input type="text" class="form-control app-feature-text"><div class="input-group-append"><button class="btn btn-danger remove-app-feature" type="button"><i class="fas fa-times"></i></button></div></div>'); });

        $(document).on('click', '.remove-vm-card, .remove-service-item, .remove-fleet-item, .remove-tour-item, .remove-why-card, .remove-entry-card, .remove-app-feature', function() { $(this).closest('.vm-card-item, .service-item, .fleet-item, .tour-item, .why-card-item, .entry-card-item, .app-feature-item').remove(); updateMetaJson(); });
        $('#submit-btn').click(function() { updateMetaJson(); });
        $(document).on('change', 'input, textarea', function() { updateMetaJson(); });
        if (typeof bsCustomFileInput !== 'undefined') { bsCustomFileInput.init(); }
    });
</script>
@endpush
