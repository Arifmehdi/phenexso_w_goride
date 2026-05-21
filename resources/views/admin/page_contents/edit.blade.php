@extends('admin.master')
@section('title', 'Edit Page Content | Admin Dashboard')

@push('css')
<style>
    .section-title {
        border-bottom: 2px solid #007bff;
        padding-bottom: 8px;
        margin-bottom: 20px;
        color: #007bff;
        font-weight: 700;
        display: flex;
        align-items: center;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .section-title i { margin-right: 10px; font-size: 1.1rem; }
    .entry-card-item {
        transition: all 0.3s ease;
        border-radius: 12px;
        border: 1px solid #e0e0e0 !important;
        background: #fff !important;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .entry-card-item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-color: #007bff !important;
    }
    .entry-card-header {
        padding: 10px 15px;
        background: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .lang-badge {
        font-size: 9px;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 700;
        text-transform: uppercase;
        margin-left: 5px;
        vertical-align: middle;
    }
    .badge-en { background-color: #007bff; color: white; }
    .badge-bn { background-color: #28a745; color: white; }
    .info-box {
        min-height: 80px;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #e0e0e0;
    }
    .info-box .info-box-icon {
        border-radius: 10px 0 0 10px;
        width: 60px;
        font-size: 1.5rem;
    }
    .info-box-content { padding: 10px; }
    .info-box-text { font-size: 0.8rem; font-weight: 600; color: #666; margin-bottom: 5px; display: block; }
</style>
@endpush

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
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#english" data-toggle="tab">English Content</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bangla" data-toggle="tab">Bangla Content</a></li>
                        </ul>
                    </div>
                    <form action="{{ route('admin.page_contents.update', $pageContent->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                                <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ old('page_slug', $pageContent->page_slug) }}" required>
                                <small class="text-muted">Used for identifying the page (e.g., 'home', 'about')</small>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Page Title (EN)</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $pageContent->getRawOriginal('title')) }}">
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
                                        <textarea name="subtitle" id="subtitle" class="form-control" rows="2">{{ old('subtitle', $pageContent->getRawOriginal('subtitle')) }}</textarea>
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

                            @if($pageContent->page_slug == 'about')
                            <div class="card card-outline card-info mt-4 custom-card-outline">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> About Page Sections</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Paragraph 2 (EN)</label>
                                                <textarea id="about_p2" class="form-control" rows="3">{{ $pageContent->meta['paragraph_2'] ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Paragraph 3 (EN)</label>
                                                <textarea id="about_p3" class="form-control" rows="3">{{ $pageContent->meta['paragraph_3'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Paragraph 2 (BN)</label>
                                                <textarea id="about_p2_bn" class="form-control" rows="3">{{ $pageContent->meta_bn['paragraph_2'] ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Paragraph 3 (BN)</label>
                                                <textarea id="about_p3_bn" class="form-control" rows="3">{{ $pageContent->meta_bn['paragraph_3'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-outline card-primary mt-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h3 class="card-title mb-0">Vision & Mission Cards (Bilingual)</h3>
                                            <button type="button" id="add-vm-card" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add Card</button>
                                        </div>
                                        <div class="card-body">
                                            <div id="vm-cards-container">
                                                @php $vm_cards = $pageContent->meta['vm_cards'] ?? []; if(is_string($vm_cards)) $vm_cards = json_decode($vm_cards, true) ?: []; @endphp
                                                @foreach($vm_cards as $index => $vm)
                                                <div class="vm-card-item border p-3 mb-3 bg-light rounded position-relative">
                                                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-vm-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Icon Class</label>
                                                                <input type="text" class="form-control vm-card-icon" value="{{ $vm['icon'] ?? '' }}" placeholder="fas fa-eye">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 border-right">
                                                            <div class="form-group">
                                                                <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                                <input type="text" class="form-control vm-card-title" value="{{ $vm['title'] ?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                                <textarea class="form-control vm-card-description" rows="2">{{ $vm['description'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                                <input type="text" class="form-control vm-card-title-bn" value="{{ $vm['title_bn'] ?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                                <textarea class="form-control vm-card-description-bn" rows="2">{{ $vm['description_bn'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'services')
                            <div class="card card-outline card-info mt-4 custom-card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0"><i class="fas fa-concierge-bell mr-1"></i> Services List (Bilingual)</h3>
                                    <button type="button" id="add-service-card" class="btn btn-info btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add Service</button>
                                </div>
                                <div class="card-body">
                                    <div id="services-list-container">
                                        @php $services_list = $pageContent->meta['services_list'] ?? []; if(is_string($services_list)) $services_list = json_decode($services_list, true) ?: []; @endphp
                                        @foreach($services_list as $index => $service)
                                        <div class="service-list-item border p-3 mb-3 bg-light rounded position-relative">
                                            <button type="button" class="btn btn-danger btn-xs position-absolute remove-service-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Icon Class</label>
                                                        <input type="text" class="form-control service-card-icon" value="{{ $service['icon'] ?? '' }}" placeholder="fas fa-car">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 border-right">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" class="form-control service-card-title" value="{{ $service['title'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                        <textarea class="form-control service-card-description" rows="2">{{ $service['desc'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Btn Text <span class="lang-badge badge-en">EN</span></label>
                                                                <input type="text" class="form-control service-card-btn-text" value="{{ $service['btn_text'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Link (URL)</label>
                                                                <input type="text" class="form-control service-card-link" value="{{ $service['link'] ?? '' }}" placeholder="/login">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" class="form-control service-card-title-bn" value="{{ $service['title_bn'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                        <textarea class="form-control service-card-description-bn" rows="2">{{ $service['desc_bn'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Btn Text <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" class="form-control service-card-btn-text-bn" value="{{ $service['btn_text_bn'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'fleet')
                            <div class="card card-outline card-info mt-4 custom-card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0"><i class="fas fa-car mr-1"></i> Fleet Items (Bilingual)</h3>
                                    <button type="button" id="add-fleet-item" class="btn btn-info btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add Vehicle</button>
                                </div>
                                <div class="card-body">
                                    <div id="fleet-items-container">
                                        @php $fleet_items = $pageContent->meta['fleet_items'] ?? []; if(is_string($fleet_items)) $fleet_items = json_decode($fleet_items, true) ?: []; @endphp
                                        @foreach($fleet_items as $index => $item)
                                        <div class="fleet-item border p-3 mb-3 bg-light rounded position-relative">
                                            <button type="button" class="btn btn-danger btn-xs position-absolute remove-fleet-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vehicle Image</label>
                                                        <input type="file" name="fleet_item_images[{{ $index }}]" class="form-control-file mb-2">
                                                        @if(isset($item['image']))
                                                            <img src="{{ strpos($item['image'], 'goride/') === false ? asset('storage/page_contents/' . $item['image']) : asset($item['image']) }}" class="img-thumbnail" style="max-height: 80px;">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Specs (EN, comma separated)</label>
                                                        <input type="text" class="form-control fleet-item-specs" value="{{ is_array($item['specs'] ?? '') ? implode(', ', $item['specs']) : ($item['specs'] ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 border-right">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" class="form-control fleet-item-title" value="{{ $item['title'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                        <textarea class="form-control fleet-item-description" rows="2">{{ $item['desc'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" class="form-control fleet-item-title-bn" value="{{ $item['title_bn'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                        <textarea class="form-control fleet-item-description-bn" rows="2">{{ $item['desc_bn'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'tours')
                            <div class="card card-outline card-info mt-4 custom-card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0"><i class="fas fa-map-marked-alt mr-1"></i> Tour Packages (Bilingual)</h3>
                                    <button type="button" id="add-tour-item" class="btn btn-info btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add Package</button>
                                </div>
                                <div class="card-body">
                                    <div id="tour-items-container">
                                        @php $tour_items = $pageContent->meta['tour_items'] ?? []; if(is_string($tour_items)) $tour_items = json_decode($tour_items, true) ?: []; @endphp
                                        @foreach($tour_items as $index => $item)
                                        <div class="tour-item border p-3 mb-3 bg-light rounded position-relative">
                                            <button type="button" class="btn btn-danger btn-xs position-absolute remove-tour-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tour Image</label>
                                                        <input type="file" name="tour_item_images[{{ $index }}]" class="form-control-file mb-2">
                                                        @if(isset($item['image']))
                                                            <img src="{{ strpos($item['image'], 'goride/') === false ? asset('storage/page_contents/' . $item['image']) : asset($item['image']) }}" class="img-thumbnail" style="max-height: 80px;">
                                                        @endif
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Price (৳)</label>
                                                                <input type="text" class="form-control tour-item-price" value="{{ $item['price'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Badge <span class="lang-badge badge-en">EN</span></label>
                                                                <input type="text" class="form-control tour-item-badge" value="{{ $item['badge'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Duration/Meta <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" class="form-control tour-item-meta" value="{{ $item['meta'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 border-right">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" class="form-control tour-item-title" value="{{ $item['title'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                        <textarea class="form-control tour-item-description" rows="3">{{ $item['desc'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" class="form-control tour-item-title-bn" value="{{ $item['title_bn'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                        <textarea class="form-control tour-item-description-bn" rows="3">{{ $item['desc_bn'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Badge <span class="lang-badge badge-bn">BN</span></label>
                                                                <input type="text" class="form-control tour-item-badge-bn" value="{{ $item['badge_bn'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Duration/Meta <span class="lang-badge badge-bn">BN</span></label>
                                                                <input type="text" class="form-control tour-item-meta-bn" value="{{ $item['meta_bn'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($pageContent->page_slug == 'home')
                            <div class="card card-outline card-primary mt-4 custom-card-outline">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-home mr-1"></i> Home Hero (Bilingual)</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 border-right">
                                            <div class="section-title"><i class="fas fa-language"></i> English Content</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Hero Badge <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="hero_badge" class="form-control" value="{{ $pageContent->meta['hero_badge'] ?? '' }}" placeholder="e.g. #1 Ride Sharing">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CTA Button Text <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="hero_cta_text" class="form-control" value="{{ $pageContent->meta['hero_cta_text'] ?? '' }}" placeholder="e.g. Book Now">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Hero Title <span class="lang-badge badge-en">EN</span></label>
                                                <input type="text" id="hero_title" class="form-control" value="{{ $pageContent->meta['hero_title'] ?? '' }}" placeholder="Main headline">
                                            </div>
                                            <div class="form-group">
                                                <label>Hero Subtitle <span class="lang-badge badge-en">EN</span></label>
                                                <textarea id="hero_subtitle" class="form-control" rows="2" placeholder="Brief description">{{ $pageContent->meta['hero_subtitle'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="section-title text-success"><i class="fas fa-language"></i> Bangla Content</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Hero Badge <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="hero_badge_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_badge'] ?? '' }}" placeholder="বজ টেক্সট">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CTA Button Text <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="hero_cta_text_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_cta_text'] ?? '' }}" placeholder="বাটনের লিখা">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Hero Title <span class="lang-badge badge-bn">BN</span></label>
                                                <input type="text" id="hero_title_bn" class="form-control" value="{{ $pageContent->meta_bn['hero_title'] ?? '' }}" placeholder="প্রধান শিরোনাম">
                                            </div>
                                            <div class="form-group">
                                                <label>Hero Subtitle <span class="lang-badge badge-bn">BN</span></label>
                                                <textarea id="hero_subtitle_bn" class="form-control" rows="2" placeholder="সংক্ষিপ্ত বর্ণনা">{{ $pageContent->meta_bn['hero_subtitle'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3 border-top pt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hero CTA Link (Optional)</label>
                                                <input type="text" id="hero_cta_link" class="form-control" value="{{ $pageContent->meta['hero_cta_link'] ?? '' }}" placeholder="e.g. /registration">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hero Background Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="hero_bg_image" class="custom-file-input" id="hero_bg_image_input">
                                                    <label class="custom-file-label" for="hero_bg_image_input">Choose background</label>
                                                </div>
                                                @if(isset($pageContent->meta['hero_bg_image']))
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/page_contents/' . $pageContent->meta['hero_bg_image']) }}" class="img-thumbnail" style="max-height: 100px;">
                                                        <small class="d-block text-muted">Current Background</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>App Mockup Image (Optional)</label>
                                                <div class="custom-file">
                                                    <input type="file" name="app_mockup_image" class="custom-file-input" id="app_mockup_image_input">
                                                    <label class="custom-file-label" for="app_mockup_image_input">Choose mockup</label>
                                                </div>
                                                @if(isset($pageContent->meta['app_mockup_image']))
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/page_contents/' . $pageContent->meta['app_mockup_image']) }}" class="img-thumbnail" style="max-height: 100px;">
                                                        <small class="d-block text-muted">Current Mockup</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-info mt-4 custom-card-outline" style="border-top-color: #17a2b8;">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0"><i class="fas fa-th-large mr-1"></i> Entry Cards (Bilingual)</h3>
                                    <button type="button" id="add-entry-card" class="btn btn-info btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add New Card</button>
                                </div>
                                <div class="card-body">
                                    <div id="entry-cards-container">
                                        @php $entry_cards = $pageContent->meta['entry_cards'] ?? []; if(is_string($entry_cards)) $entry_cards = json_decode($entry_cards, true) ?: []; @endphp
                                        @foreach($entry_cards as $index => $card)
                                        <div class="entry-card-item">
                                            <div class="entry-card-header">
                                                <span class="font-weight-bold text-info"><i class="fas fa-layer-group mr-1"></i> Card #{{ $loop->iteration }}</span>
                                                <button type="button" class="btn btn-danger btn-xs remove-entry-card"><i class="fas fa-trash-alt"></i> Remove</button>
                                            </div>
                                            <div class="p-3">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Icon Class</label>
                                                            <input type="text" class="form-control entry-card-icon" value="{{ $card['icon'] ?? '' }}" placeholder="fas fa-car">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 border-right">
                                                        <div class="form-group">
                                                            <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                            <input type="text" class="form-control entry-card-title" value="{{ $card['title'] ?? '' }}" placeholder="English title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                            <textarea class="form-control entry-card-description" rows="2" placeholder="English description">{{ $card['description'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Btn Text <span class="lang-badge badge-en">EN</span></label>
                                                                    <input type="text" class="form-control entry-card-btn-text" value="{{ $card['btn_text'] ?? '' }}" placeholder="Button text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Link (URL)</label>
                                                                    <input type="text" class="form-control entry-card-link" value="{{ $card['link'] ?? '' }}" placeholder="/registration">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                            <input type="text" class="form-control entry-card-title-bn" value="{{ $card['title_bn'] ?? '' }}" placeholder="বাংলায় টাইটেল">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                            <textarea class="form-control entry-card-description-bn" rows="2" placeholder="বাংলায় বর্ণনা">{{ $card['description_bn'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Btn Text <span class="lang-badge badge-bn">BN</span></label>
                                                            <input type="text" class="form-control entry-card-btn-text-bn" value="{{ $card['btn_text_bn'] ?? '' }}" placeholder="বাটনের লিখা">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if(empty($entry_cards))
                                    <div class="text-center p-4 border rounded bg-light mb-3">
                                        <i class="fas fa-folder-open fa-3x text-muted mb-2"></i>
                                        <p class="text-muted">No entry cards added yet. Click "Add New Card" to begin.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card card-outline card-success mt-4 custom-card-outline" style="border-top-color: #28a745;">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Key Statistics (Bilingual)</h3></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 border-right">
                                            <div class="section-title"><i class="fas fa-language"></i> English Stats</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Happy Customers <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="stats_customers" class="form-control" value="{{ $pageContent->meta['stats_customers'] ?? '' }}" placeholder="e.g. 50K+">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Total Fleet <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="stats_fleet" class="form-control" value="{{ $pageContent->meta['stats_fleet'] ?? '' }}" placeholder="e.g. 1000+">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Districts Covered <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="stats_districts" class="form-control" value="{{ $pageContent->meta['stats_districts'] ?? '' }}" placeholder="e.g. 64">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Corporate Partners <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" id="stats_corporate" class="form-control" value="{{ $pageContent->meta['stats_corporate'] ?? '' }}" placeholder="e.g. 200+">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="section-title text-success"><i class="fas fa-language"></i> Bangla Stats</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Happy Customers <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="stats_customers_bn" class="form-control" value="{{ $pageContent->meta_bn['stats_customers'] ?? '' }}" placeholder="উদাঃ ৫০হাজার+">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Total Fleet <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="stats_fleet_bn" class="form-control" value="{{ $pageContent->meta_bn['stats_fleet'] ?? '' }}" placeholder="উদাঃ ১০০০+">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Districts Covered <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="stats_districts_bn" class="form-control" value="{{ $pageContent->meta_bn['stats_districts'] ?? '' }}" placeholder="উদাঃ ৬৪">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Corporate Partners <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" id="stats_corporate_bn" class="form-control" value="{{ $pageContent->meta_bn['stats_corporate'] ?? '' }}" placeholder="উদাঃ ২০০+">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-warning mt-4 custom-card-outline" style="border-top-color: #ffc107;">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0"><i class="fas fa-question-circle mr-1"></i> Why Choose Us (Bilingual)</h3>
                                    <button type="button" id="add-why-item" class="btn btn-warning btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Add Why Item</button>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section Title <span class="lang-badge badge-en">EN</span></label>
                                                <input type="text" id="why_title" class="form-control" value="{{ $pageContent->meta['why_title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section Subtitle <span class="lang-badge badge-en">EN</span></label>
                                                <input type="text" id="why_subtitle" class="form-control" value="{{ $pageContent->meta['why_subtitle'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section Title <span class="lang-badge badge-bn">BN</span></label>
                                                <input type="text" id="why_title_bn" class="form-control" value="{{ $pageContent->meta_bn['why_title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section Subtitle <span class="lang-badge badge-bn">BN</span></label>
                                                <input type="text" id="why_subtitle_bn" class="form-control" value="{{ $pageContent->meta_bn['why_subtitle'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="why-items-container">
                                        @php $why_items = $pageContent->meta['why_items'] ?? []; if(is_string($why_items)) $why_items = json_decode($why_items, true) ?: []; @endphp
                                        @foreach($why_items as $index => $item)
                                        <div class="why-item border p-3 mb-3 bg-light rounded position-relative">
                                            <button type="button" class="btn btn-danger btn-xs position-absolute remove-why-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Icon Class</label>
                                                        <input type="text" class="form-control why-item-icon" value="{{ $item['icon'] ?? '' }}" placeholder="fas fa-star">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 border-right">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-en">EN</span></label>
                                                        <input type="text" class="form-control why-item-title" value="{{ $item['title'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-en">EN</span></label>
                                                        <textarea class="form-control why-item-desc" rows="1">{{ $item['desc'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Title <span class="lang-badge badge-bn">BN</span></label>
                                                        <input type="text" class="form-control why-item-title-bn" value="{{ $item['title_bn'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description <span class="lang-badge badge-bn">BN</span></label>
                                                        <textarea class="form-control why-item-desc-bn" rows="1">{{ $item['desc_bn'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update Page Content
                            </button>
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
            $('#summernote, #summernote_bn').summernote({ 
                height: 200,
                tabsize: 2,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });
        }

        function updateMetaJson() {
            let meta = {}; try { meta = JSON.parse($('#meta_json').val() || '{}'); } catch (e) {}
            let meta_bn = {}; try { meta_bn = JSON.parse($('#meta_bn_json').val() || '{}'); } catch (e) {}

            // About Page Specific
            if ($('#about_p2').length > 0) {
                meta.paragraph_2 = $('#about_p2').val();
                meta.paragraph_3 = $('#about_p3').val();
                meta_bn.paragraph_2 = $('#about_p2_bn').val();
                meta_bn.paragraph_3 = $('#about_p3_bn').val();

                let vm = [];
                $('.vm-card-item').each(function() {
                    vm.push({
                        icon: $(this).find('.vm-card-icon').val(),
                        title: $(this).find('.vm-card-title').val(),
                        title_bn: $(this).find('.vm-card-title-bn').val(),
                        description: $(this).find('.vm-card-description').val(),
                        description_bn: $(this).find('.vm-card-description-bn').val()
                    });
                });
                meta.vm_cards = vm;
            }

            // Services Page Specific
            if ($('#add-service-card').length > 0) {
                let services = [];
                $('.service-list-item').each(function() {
                    services.push({
                        icon: $(this).find('.service-card-icon').val(),
                        title: $(this).find('.service-card-title').val(),
                        title_bn: $(this).find('.service-card-title-bn').val(),
                        desc: $(this).find('.service-card-description').val(),
                        desc_bn: $(this).find('.service-card-description-bn').val(),
                        btn_text: $(this).find('.service-card-btn-text').val(),
                        btn_text_bn: $(this).find('.service-card-btn-text-bn').val(),
                        link: $(this).find('.service-card-link').val()
                    });
                });
                meta.services_list = services;
            }

            // Fleet Page Specific
            if ($('#add-fleet-item').length > 0) {
                let fleet = [];
                $('.fleet-item').each(function() {
                    let specs = $(this).find('.fleet-item-specs').val().split(',').map(s => s.trim()).filter(s => s !== '');
                    fleet.push({
                        image: $(this).find('img').attr('src')?.split('/').pop() || '',
                        title: $(this).find('.fleet-item-title').val(),
                        title_bn: $(this).find('.fleet-item-title-bn').val(),
                        desc: $(this).find('.fleet-item-description').val(),
                        desc_bn: $(this).find('.fleet-item-description-bn').val(),
                        specs: specs
                    });
                });
                meta.fleet_items = fleet;
            }

            // Tours Page Specific
            if ($('#add-tour-item').length > 0) {
                let tours = [];
                $('.tour-item').each(function() {
                    tours.push({
                        image: $(this).find('img').attr('src')?.split('/').pop() || '',
                        price: $(this).find('.tour-item-price').val(),
                        badge: $(this).find('.tour-item-badge').val(),
                        badge_bn: $(this).find('.tour-item-badge-bn').val(),
                        meta: $(this).find('.tour-item-meta').val(),
                        meta_bn: $(this).find('.tour-item-meta-bn').val(),
                        title: $(this).find('.tour-item-title').val(),
                        title_bn: $(this).find('.tour-item-title-bn').val(),
                        desc: $(this).find('.tour-item-description').val(),
                        desc_bn: $(this).find('.tour-item-description-bn').val()
                    });
                });
                meta.tour_items = tours;
            }

            // Home Page Specific
            if ($('#hero_title').length > 0) {
                meta.hero_badge = $('#hero_badge').val();
                meta.hero_title = $('#hero_title').val();
                meta.hero_subtitle = $('#hero_subtitle').val();
                meta.hero_cta_text = $('#hero_cta_text').val();
                meta.hero_cta_link = $('#hero_cta_link').val();
                
                meta_bn.hero_badge = $('#hero_badge_bn').val();
                meta_bn.hero_title = $('#hero_title_bn').val();
                meta_bn.hero_subtitle = $('#hero_subtitle_bn').val();
                meta_bn.hero_cta_text = $('#hero_cta_text_bn').val();

                meta.stats_customers = $('#stats_customers').val();
                meta.stats_fleet = $('#stats_fleet').val();
                meta.stats_districts = $('#stats_districts').val();
                meta.stats_corporate = $('#stats_corporate').val();

                meta_bn.stats_customers = $('#stats_customers_bn').val();
                meta_bn.stats_fleet = $('#stats_fleet_bn').val();
                meta_bn.stats_districts = $('#stats_districts_bn').val();
                meta_bn.stats_corporate = $('#stats_corporate_bn').val();

                let entry = []; 
                $('.entry-card-item').each(function() {
                    entry.push({
                        title: $(this).find('.entry-card-title').val(),
                        title_bn: $(this).find('.entry-card-title-bn').val(),
                        icon: $(this).find('.entry-card-icon').val(),
                        btn_text: $(this).find('.entry-card-btn-text').val(),
                        btn_text_bn: $(this).find('.entry-card-btn-text-bn').val(),
                        description: $(this).find('.entry-card-description').val(),
                        description_bn: $(this).find('.entry-card-description-bn').val(),
                        link: $(this).find('.entry-card-link').val()
                    });
                });
                meta.entry_cards = entry;

                meta.why_title = $('#why_title').val();
                meta.why_subtitle = $('#why_subtitle').val();
                meta_bn.why_title = $('#why_title_bn').val();
                meta_bn.why_subtitle = $('#why_subtitle_bn').val();

                let why = []; $('.why-item').each(function() {
                    why.push({
                        icon: $(this).find('.why-item-icon').val(),
                        title: $(this).find('.why-item-title').val(),
                        title_bn: $(this).find('.why-item-title-bn').val(),
                        desc: $(this).find('.why-item-desc').val(),
                        desc_bn: $(this).find('.why-item-desc-bn').val()
                    });
                });
                meta.why_items = why;
            }

            $('#meta_json').val(JSON.stringify(meta, null, 4));
            $('#meta_bn_json').val(JSON.stringify(meta_bn, null, 4));
        }

        // Event Listeners
        $(document).on('click', '.remove-vm-card', function() { $(this).closest('.vm-card-item').remove(); updateMetaJson(); });
        $('#add-vm-card').click(function() {
            $('#vm-cards-container').append(`
                <div class="vm-card-item border p-3 mb-3 bg-light rounded position-relative">
                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-vm-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group"><label>Icon Class</label><input type="text" class="form-control vm-card-icon" placeholder="fas fa-eye"></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control vm-card-title"></div>
                            <div class="form-group"><label>Description (EN)</label><textarea class="form-control vm-card-description" rows="2"></textarea></div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control vm-card-title-bn"></div>
                            <div class="form-group"><label>Description (BN)</label><textarea class="form-control vm-card-description-bn" rows="2"></textarea></div>
                        </div>
                    </div>
                </div>`);
        });

        $(document).on('click', '.remove-service-card', function() { $(this).closest('.service-list-item').remove(); updateMetaJson(); });
        $('#add-service-card').click(function() {
            $('#services-list-container').append(`
                <div class="service-list-item border p-3 mb-3 bg-light rounded position-relative">
                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-service-card" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group"><label>Icon Class</label><input type="text" class="form-control service-card-icon" placeholder="fas fa-car"></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control service-card-title"></div>
                            <div class="form-group"><label>Description (EN)</label><textarea class="form-control service-card-description" rows="2"></textarea></div>
                            <div class="row">
                                <div class="col-md-6"><div class="form-group"><label>Btn Text (EN)</label><input type="text" class="form-control service-card-btn-text"></div></div>
                                <div class="col-md-6"><div class="form-group"><label>Link</label><input type="text" class="form-control service-card-link" placeholder="/login"></div></div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control service-card-title-bn"></div>
                            <div class="form-group"><label>Description (BN)</label><textarea class="form-control service-card-description-bn" rows="2"></textarea></div>
                            <div class="form-group"><label>Btn Text (BN)</label><input type="text" class="form-control service-card-btn-text-bn"></div>
                        </div>
                    </div>
                </div>`);
        });

        $(document).on('click', '.remove-fleet-item', function() { $(this).closest('.fleet-item').remove(); updateMetaJson(); });
        $('#add-fleet-item').click(function() {
            let index = $('.fleet-item').length;
            $('#fleet-items-container').append(`
                <div class="fleet-item border p-3 mb-3 bg-light rounded position-relative">
                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-fleet-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group"><label>Vehicle Image</label><input type="file" name="fleet_item_images[${index}]" class="form-control-file mb-2"></div>
                            <div class="form-group"><label>Specs (EN, comma)</label><input type="text" class="form-control fleet-item-specs" placeholder="4 Seats, AC"></div>
                        </div>
                        <div class="col-md-4 border-right">
                            <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control fleet-item-title"></div>
                            <div class="form-group"><label>Desc (EN)</label><textarea class="form-control fleet-item-description" rows="2"></textarea></div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control fleet-item-title-bn"></div>
                            <div class="form-group"><label>Desc (BN)</label><textarea class="form-control fleet-item-description-bn" rows="2"></textarea></div>
                        </div>
                    </div>
                </div>`);
        });

        $(document).on('click', '.remove-tour-item', function() { $(this).closest('.tour-item').remove(); updateMetaJson(); });
        $('#add-tour-item').click(function() {
            let index = $('.tour-item').length;
            $('#tour-items-container').append(`
                <div class="tour-item border p-3 mb-3 bg-light rounded position-relative">
                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-tour-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group"><label>Tour Image</label><input type="file" name="tour_item_images[${index}]" class="form-control-file mb-2"></div>
                            <div class="row">
                                <div class="col-md-6"><div class="form-group"><label>Price</label><input type="text" class="form-control tour-item-price"></div></div>
                                <div class="col-md-6"><div class="form-group"><label>Badge (EN)</label><input type="text" class="form-control tour-item-badge"></div></div>
                            </div>
                            <div class="form-group"><label>Duration (EN)</label><input type="text" class="form-control tour-item-meta" placeholder="3 Days"></div>
                        </div>
                        <div class="col-md-4 border-right">
                            <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control tour-item-title"></div>
                            <div class="form-group"><label>Desc (EN)</label><textarea class="form-control tour-item-description" rows="3"></textarea></div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control tour-item-title-bn"></div>
                            <div class="form-group"><label>Desc (BN)</label><textarea class="form-control tour-item-description-bn" rows="3"></textarea></div>
                            <div class="row">
                                <div class="col-md-6"><div class="form-group"><label>Badge (BN)</label><input type="text" class="form-control tour-item-badge-bn"></div></div>
                                <div class="col-md-6"><div class="form-group"><label>Duration (BN)</label><input type="text" class="form-control tour-item-meta-bn"></div></div>
                            </div>
                        </div>
                    </div>
                </div>`);
        });

        $(document).on('click', '.remove-entry-card', function() { $(this).closest('.entry-card-item').remove(); updateMetaJson(); });
        $('#add-entry-card').click(function() {
            let count = $('.entry-card-item').length + 1;
            $('#entry-cards-container').append(`
                <div class="entry-card-item">
                    <div class="entry-card-header"><span class="font-weight-bold text-info">Card #${count}</span><button type="button" class="btn btn-danger btn-xs remove-entry-card">Remove</button></div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2"><div class="form-group"><label>Icon</label><input type="text" class="form-control entry-card-icon" placeholder="fas fa-car"></div></div>
                            <div class="col-md-5 border-right">
                                <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control entry-card-title"></div>
                                <div class="form-group"><label>Desc (EN)</label><textarea class="form-control entry-card-description" rows="2"></textarea></div>
                                <div class="row">
                                    <div class="col-md-6"><div class="form-group"><label>Btn Text (EN)</label><input type="text" class="form-control entry-card-btn-text"></div></div>
                                    <div class="col-md-6"><div class="form-group"><label>Link</label><input type="text" class="form-control entry-card-link"></div></div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control entry-card-title-bn"></div>
                                <div class="form-group"><label>Desc (BN)</label><textarea class="form-control entry-card-description-bn" rows="2"></textarea></div>
                                <div class="form-group"><label>Btn Text (BN)</label><input type="text" class="form-control entry-card-btn-text-bn"></div>
                            </div>
                        </div>
                    </div>
                </div>`);
            $('.text-center.p-4.border.rounded.bg-light').hide();
        });

        $(document).on('click', '.remove-why-item', function() { $(this).closest('.why-item').remove(); updateMetaJson(); });
        $('#add-why-item').click(function() {
            $('#why-items-container').append(`
                <div class="why-item border p-3 mb-3 bg-light rounded position-relative">
                    <button type="button" class="btn btn-danger btn-xs position-absolute remove-why-item" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group"><label>Icon</label><input type="text" class="form-control why-item-icon" placeholder="fas fa-star"></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="form-group"><label>Title (EN)</label><input type="text" class="form-control why-item-title"></div>
                            <div class="form-group"><label>Desc (EN)</label><textarea class="form-control why-item-desc" rows="1"></textarea></div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group"><label>Title (BN)</label><input type="text" class="form-control why-item-title-bn"></div>
                            <div class="form-group"><label>Desc (BN)</label><textarea class="form-control why-item-desc-bn" rows="1"></textarea></div>
                        </div>
                    </div>
                </div>`);
        });

        $('form').on('submit', function() { updateMetaJson(); });
        $(document).on('change', 'input, textarea', function() { updateMetaJson(); });
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush
