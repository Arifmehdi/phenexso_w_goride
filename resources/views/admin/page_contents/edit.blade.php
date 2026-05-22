@extends('admin.master')
@section('title', 'Edit Content: ' . $pageContent->page_slug)

@push('css')
<style>
    /* Premium UI Overrides */
    .editor-card { border-radius: 24px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.04); overflow: hidden; background: #fff; }
    .card-header-tabs { background: #fdfdfd; border-bottom: 1px solid #f1f5f9; padding: 20px 30px; }
    
    .nav-tabs-custom { border: none; display: flex; gap: 10px; }
    .nav-tabs-custom .nav-link { 
        border: none !important; color: #94a3b8; font-weight: 700; font-size: 14px; 
        padding: 12px 24px; border-radius: 14px; transition: all 0.3s;
        display: flex; align-items: center; gap: 10px; background: #f8fafc;
    }
    .nav-tabs-custom .nav-link:hover { color: #64748b; background: #f1f5f9; }
    .nav-tabs-custom .nav-link.active { background: #1A7A3C !important; color: white !important; box-shadow: 0 10px 20px rgba(26,122,60,0.2); }
    
    .form-section { padding: 40px; }
    .section-label { font-size: 11px; font-weight: 900; color: #1A7A3C; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 25px; display: block; }
    
    .label-elegant { font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 10px; display: block; padding-left: 4px; }
    
    .input-elegant { 
        background: #f8fafc !important; 
        border: 1.5px solid #e2e8f0 !important; 
        border-radius: 14px !important; 
        padding: 16px 20px !important;
        height: auto !important; 
        font-size: 15px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .input-elegant:focus { 
        background: white !important; 
        border-color: #1A7A3C !important; 
        box-shadow: 0 0 0 4px rgba(26, 122, 60, 0.08) !important;
        outline: none !important;
    }

    /* Dynamic Item Styling */
    .dynamic-container { background: #f8fafc; border-radius: 20px; padding: 30px; margin-top: 30px; border: 1px solid #f1f5f9; }
    .dynamic-item { background: white; border-radius: 16px; padding: 25px; margin-bottom: 20px; border: 1px solid #e2e8f0; position: relative; transition: transform 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .dynamic-item:hover { transform: scale(1.005); border-color: #1A7A3C; }
    .remove-item { position: absolute; top: 15px; right: 15px; color: #ef4444; cursor: pointer; font-size: 18px; transition: 0.2s; }
    .remove-item:hover { color: #dc2626; transform: scale(1.1); }

    .note-editor.note-frame { border-radius: 14px; border: 1.5px solid #e2e8f0 !important; overflow: hidden; }
    .sticky-actions { position: sticky; bottom: 0; background: rgba(255,255,255,0.95); backdrop-filter: blur(15px); padding: 20px 40px; border-top: 1px solid #f1f5f9; z-index: 1000; }
    .btn-save { background: #1A7A3C; color: white; padding: 14px 40px; border-radius: 14px; font-weight: 800; border: none; box-shadow: 0 10px 20px rgba(26,122,60,0.15); transition: 0.3s; }
</style>
@endpush

@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="m-0 font-weight-bold" style="letter-spacing: -1px;"><i class="fas fa-magic mr-3 text-success"></i>Edit Page: {{ ucfirst($pageContent->page_slug) }}</h1>
            </div>
            <a href="{{ route('admin.page_contents.index') }}" class="btn btn-light px-4" style="border-radius: 12px; font-weight: 700; border: 1px solid #e2e8f0;">
                <i class="fas fa-chevron-left mr-2"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="content pb-5">
    <div class="container-fluid">
        <form action="{{ route('admin.page_contents.update', $pageContent->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="page_slug" value="{{ $pageContent->page_slug }}">

            <div class="card editor-card">
                <div class="card-header-tabs">
                    <ul class="nav nav-tabs nav-tabs-custom" id="langTabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#english-content">English Version</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bangla-content">Bangla Version</a></li>
                    </ul>
                </div>

                <div class="card-body p-0">
                    <div class="tab-content">
                        
                        {{-- ENGLISH CONTENT --}}
                        <div class="tab-pane fade show active" id="english-content">
                            <div class="form-section">
                                <span class="section-label">Primary Headings (EN)</span>
                                <div class="row">
                                    <div class="col-md-6 mb-4"><label class="label-elegant">Page Title</label><input type="text" name="title" class="form-control input-elegant" value="{{ $pageContent->getRawOriginal('title') }}"></div>
                                    <div class="col-md-6 mb-4"><label class="label-elegant">Subtitle</label><input type="text" name="subtitle" class="form-control input-elegant" value="{{ $pageContent->getRawOriginal('subtitle') }}"></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">Short Description</label><textarea name="description" class="form-control input-elegant" rows="2">{{ $pageContent->description }}</textarea></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">Detailed Content</label><textarea name="content" id="summernote_en" class="form-control">{{ $pageContent->content }}</textarea></div>
                                </div>

                                {{-- HOME PAGE STATS --}}
                                @if($pageContent->page_slug == 'home')
                                    <hr class="my-5">
                                    <span class="section-label">Homepage Stats (EN)</span>
                                    <div class="row">
                                        <div class="col-md-3 mb-3"><label class="label-elegant">Customers</label><input type="text" name="meta[stats_customers]" class="form-control input-elegant" value="{{ $pageContent->meta['stats_customers'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">Fleet</label><input type="text" name="meta[stats_fleet]" class="form-control input-elegant" value="{{ $pageContent->meta['stats_fleet'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">Districts</label><input type="text" name="meta[stats_districts]" class="form-control input-elegant" value="{{ $pageContent->meta['stats_districts'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">Corporate</label><input type="text" name="meta[stats_corporate]" class="form-control input-elegant" value="{{ $pageContent->meta['stats_corporate'] ?? '' }}"></div>
                                    </div>

                                    <div class="dynamic-container mt-5">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="m-0 font-weight-bold"><i class="fas fa-star mr-2 text-warning"></i>Why Choose Us / Features</h5>
                                            <button type="button" class="btn btn-primary btn-sm add-dynamic-item" data-type="feature-item"><i class="fas fa-plus mr-1"></i> Add Feature</button>
                                        </div>
                                        <div id="features-container">
                                            @php $why_items = $pageContent->meta['why_items'] ?? []; @endphp
                                            @foreach($why_items as $index => $item)
                                                <div class="dynamic-item">
                                                    <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                                                    <div class="row">
                                                        <div class="col-md-2"><label class="label-elegant">Icon</label><input type="text" name="meta[why_items][{{$index}}][icon]" class="form-control input-elegant" value="{{ $item['icon'] ?? '' }}"></div>
                                                        <div class="col-md-5">
                                                            <label class="label-elegant">EN Title</label><input type="text" name="meta[why_items][{{$index}}][title]" class="form-control input-elegant mb-3" value="{{ $item['title'] ?? '' }}">
                                                            <label class="label-elegant">EN Desc</label><textarea name="meta[why_items][{{$index}}][desc]" class="form-control input-elegant" rows="2">{{ $item['desc'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[why_items][{{$index}}][title_bn]" class="form-control input-elegant mb-3" value="{{ $item['title_bn'] ?? '' }}">
                                                            <label class="label-elegant text-success">BN Desc</label><textarea name="meta[why_items][{{$index}}][desc_bn]" class="form-control input-elegant" rows="2">{{ $item['desc_bn'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- BANGLA CONTENT --}}
                        <div class="tab-pane fade" id="bangla-content">
                            <div class="form-section">
                                <span class="section-label">Primary Headings (BN)</span>
                                <div class="row">
                                    <div class="col-md-6 mb-4"><label class="label-elegant">টাইটেল (Title BN)</label><input type="text" name="title_bn" class="form-control input-elegant" value="{{ $pageContent->title_bn }}"></div>
                                    <div class="col-md-6 mb-4"><label class="label-elegant">সাবটাইটেল (Subtitle BN)</label><input type="text" name="subtitle_bn" class="form-control input-elegant" value="{{ $pageContent->subtitle_bn }}"></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">সংক্ষিপ্ত বিবরণ (Description BN)</label><textarea name="description_bn" class="form-control input-elegant" rows="2">{{ $pageContent->description_bn }}</textarea></div>
                                    <div class="col-12 mb-4"><label class="label-elegant">বিস্তারিত কন্টেন্ট (Content BN)</label><textarea name="content_bn" id="summernote_bn" class="form-control">{{ $pageContent->content_bn }}</textarea></div>
                                </div>

                                {{-- HOME PAGE STATS BN --}}
                                @if($pageContent->page_slug == 'home')
                                    <hr class="my-5">
                                    <span class="section-label">Homepage Stats (BN)</span>
                                    <div class="row">
                                        <div class="col-md-3 mb-3"><label class="label-elegant">গ্রাহক সংখ্যা</label><input type="text" name="meta_bn[stats_customers]" class="form-control input-elegant" value="{{ $pageContent->meta_bn['stats_customers'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">যানবাহন</label><input type="text" name="meta_bn[stats_fleet]" class="form-control input-elegant" value="{{ $pageContent->meta_bn['stats_fleet'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">জেলা</label><input type="text" name="meta_bn[stats_districts]" class="form-control input-elegant" value="{{ $pageContent->meta_bn['stats_districts'] ?? '' }}"></div>
                                        <div class="col-md-3 mb-3"><label class="label-elegant">কর্পোরেট</label><input type="text" name="meta_bn[stats_corporate]" class="form-control input-elegant" value="{{ $pageContent->meta_bn['stats_corporate'] ?? '' }}"></div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- DYNAMIC CARD SECTIONS --}}
                <div class="form-section pt-0">
                    
                    {{-- ABOUT PAGE: VISION & MISSION CARDS --}}
                    @if($pageContent->page_slug == 'about')
                        <div class="dynamic-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="m-0 font-weight-bold"><i class="fas fa-eye mr-2 text-primary"></i>Vision & Mission Cards</h5>
                                <button type="button" class="btn btn-primary btn-sm px-3 add-dynamic-item" data-type="vm-card" style="border-radius: 8px;"><i class="fas fa-plus mr-1"></i> Add Card</button>
                            </div>
                            <div id="vm-cards-container">
                                @php $vm_cards = $pageContent->meta['vm_cards'] ?? []; @endphp
                                @foreach($vm_cards as $index => $vm)
                                    <div class="dynamic-item">
                                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-2"><label class="label-elegant">Icon</label><input type="text" name="meta[vm_cards][{{$index}}][icon]" class="form-control input-elegant" value="{{ $vm['icon'] ?? '' }}" placeholder="fas fa-eye"></div>
                                            <div class="col-md-5">
                                                <label class="label-elegant">EN Title</label><input type="text" name="meta[vm_cards][{{$index}}][title]" class="form-control input-elegant mb-3" value="{{ $vm['title'] ?? '' }}">
                                                <label class="label-elegant">EN Desc</label><textarea name="meta[vm_cards][{{$index}}][description]" class="form-control input-elegant" rows="2">{{ $vm['description'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[vm_cards][{{$index}}][title_bn]" class="form-control input-elegant mb-3" value="{{ $vm['title_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[vm_cards][{{$index}}][description_bn]" class="form-control input-elegant" rows="2">{{ $vm['description_bn'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- SERVICES PAGE: LIST --}}
                    @if($pageContent->page_slug == 'services')
                        <div class="dynamic-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="m-0 font-weight-bold"><i class="fas fa-concierge-bell mr-2 text-primary"></i>Service Offerings</h5>
                                <button type="button" class="btn btn-primary btn-sm px-3 add-dynamic-item" data-type="service-item" style="border-radius: 8px;"><i class="fas fa-plus mr-1"></i> Add Service</button>
                            </div>
                            <div id="services-container">
                                @php $services = $pageContent->meta['services_list'] ?? []; @endphp
                                @foreach($services as $index => $s)
                                    <div class="dynamic-item">
                                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="label-elegant">Icon</label><input type="text" name="meta[services_list][{{$index}}][icon]" class="form-control input-elegant mb-3" value="{{ $s['icon'] ?? '' }}">
                                                <label class="label-elegant">Link</label><input type="text" name="meta[services_list][{{$index}}][link]" class="form-control input-elegant" value="{{ $s['link'] ?? '' }}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="label-elegant">EN Title</label><input type="text" name="meta[services_list][{{$index}}][title]" class="form-control input-elegant mb-3" value="{{ $s['title'] ?? '' }}">
                                                <label class="label-elegant">EN Desc</label><textarea name="meta[services_list][{{$index}}][desc]" class="form-control input-elegant mb-3" rows="2">{{ $s['desc'] ?? '' }}</textarea>
                                                <label class="label-elegant">EN Btn Text</label><input type="text" name="meta[services_list][{{$index}}][btn_text]" class="form-control input-elegant" value="{{ $s['btn_text'] ?? '' }}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[services_list][{{$index}}][title_bn]" class="form-control input-elegant mb-3" value="{{ $s['title_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[services_list][{{$index}}][desc_bn]" class="form-control input-elegant mb-3" rows="2">{{ $s['desc_bn'] ?? '' }}</textarea>
                                                <label class="label-elegant text-success">BN Btn Text</label><input type="text" name="meta[services_list][{{$index}}][btn_text_bn]" class="form-control input-elegant" value="{{ $s['btn_text_bn'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- FLEET PAGE: VEHICLES --}}
                    @if($pageContent->page_slug == 'fleet')
                        <div class="dynamic-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="m-0 font-weight-bold"><i class="fas fa-car mr-2 text-primary"></i>Fleet Inventory</h5>
                                <button type="button" class="btn btn-primary btn-sm px-3 add-dynamic-item" data-type="fleet-item" style="border-radius: 8px;"><i class="fas fa-plus mr-1"></i> Add Vehicle</button>
                            </div>
                            <div id="fleet-container">
                                @php $fleet = $pageContent->meta['fleet_items'] ?? []; @endphp
                                @foreach($fleet as $index => $item)
                                    <div class="dynamic-item">
                                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <label class="label-elegant">Image</label>
                                                @if(isset($item['image']))
                                                    <img src="{{ asset($item['image']) }}" class="img-thumbnail mb-2" style="max-height: 80px; border-radius: 12px;">
                                                @endif
                                                <input type="file" name="fleet_item_images[{{$index}}]" class="form-control input-elegant" style="padding: 10px !important;">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label-elegant">EN Title</label><input type="text" name="meta[fleet_items][{{$index}}][title]" class="form-control input-elegant mb-3" value="{{ $item['title'] ?? '' }}">
                                                <label class="label-elegant">EN Specs (comma separated)</label><input type="text" name="meta[fleet_items][{{$index}}][specs_raw]" class="form-control input-elegant" value="{{ is_array($item['specs'] ?? '') ? implode(', ', $item['specs']) : ($item['specs_raw'] ?? '') }}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[fleet_items][{{$index}}][title_bn]" class="form-control input-elegant mb-3" value="{{ $item['title_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Specs</label><input type="text" name="meta[fleet_items][{{$index}}][specs_bn_raw]" class="form-control input-elegant" value="{{ is_array($item['specs_bn'] ?? '') ? implode(', ', $item['specs_bn']) : ($item['specs_bn_raw'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- TOURS PAGE: PACKAGES --}}
                    @if($pageContent->page_slug == 'tours')
                        <div class="dynamic-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="m-0 font-weight-bold"><i class="fas fa-map-marked-alt mr-2 text-primary"></i>Tour Packages</h5>
                                <button type="button" class="btn btn-primary btn-sm px-3 add-dynamic-item" data-type="tour-item" style="border-radius: 8px;"><i class="fas fa-plus mr-1"></i> Add Package</button>
                            </div>
                            <div id="tours-container">
                                @php $tours = $pageContent->meta['tour_items'] ?? []; @endphp
                                @foreach($tours as $index => $item)
                                    <div class="dynamic-item">
                                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <label class="label-elegant">Tour Image</label>
                                                @if(isset($item['image']))
                                                    <img src="{{ asset($item['image']) }}" class="img-thumbnail mb-2" style="max-height: 80px; border-radius: 12px;">
                                                @endif
                                                <input type="file" name="tour_item_images[{{$index}}]" class="form-control input-elegant" style="padding: 10px !important;">
                                                <label class="label-elegant mt-3">Price (৳)</label><input type="text" name="meta[tour_items][{{$index}}][price]" class="form-control input-elegant" value="{{ $item['price'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label-elegant">EN Title</label><input type="text" name="meta[tour_items][{{$index}}][title]" class="form-control input-elegant mb-3" value="{{ $item['title'] ?? '' }}">
                                                <label class="label-elegant">EN Badge</label><input type="text" name="meta[tour_items][{{$index}}][badge]" class="form-control input-elegant mb-3" value="{{ $item['badge'] ?? '' }}">
                                                <label class="label-elegant">EN Duration</label><input type="text" name="meta[tour_items][{{$index}}][meta]" class="form-control input-elegant mb-3" value="{{ $item['meta'] ?? '' }}">
                                                <label class="label-elegant">EN Desc</label><textarea name="meta[tour_items][{{$index}}][desc]" class="form-control input-elegant" rows="2">{{ $item['desc'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[tour_items][{{$index}}][title_bn]" class="form-control input-elegant mb-3" value="{{ $item['title_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Badge</label><input type="text" name="meta[tour_items][{{$index}}][badge_bn]" class="form-control input-elegant mb-3" value="{{ $item['badge_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Duration</label><input type="text" name="meta[tour_items][{{$index}}][meta_bn]" class="form-control input-elegant mb-3" value="{{ $item['meta_bn'] ?? '' }}">
                                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[tour_items][{{$index}}][desc_bn]" class="form-control input-elegant" rows="2">{{ $item['desc_bn'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <div class="sticky-actions d-flex justify-content-between align-items-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="activeStatus" name="active" value="1" {{ $pageContent->active ? 'checked' : '' }}>
                        <label class="custom-control-label font-weight-bold text-dark" for="activeStatus" style="cursor:pointer;">Publish Live</label>
                    </div>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-check-circle mr-2"></i> Save Bilingual Content
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#summernote_en, #summernote_bn').summernote({ height: 350 });

        // Add Dynamic Item
        $('.add-dynamic-item').click(function() {
            const type = $(this).data('type');
            const container = $(this).closest('.dynamic-container').find('> div:last-child');
            const index = container.children().length;
            let html = '';

            if(type === 'vm-card') {
                html = `
                    <div class="dynamic-item">
                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                        <div class="row">
                            <div class="col-md-2"><label class="label-elegant">Icon</label><input type="text" name="meta[vm_cards][${index}][icon]" class="form-control input-elegant" placeholder="fas fa-eye"></div>
                            <div class="col-md-5">
                                <label class="label-elegant">EN Title</label><input type="text" name="meta[vm_cards][${index}][title]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Desc</label><textarea name="meta[vm_cards][${index}][description]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[vm_cards][${index}][title_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[vm_cards][${index}][description_bn]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                        </div>
                    </div>`;
            } else if(type === 'service-item') {
                html = `
                    <div class="dynamic-item">
                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="label-elegant">Icon</label><input type="text" name="meta[services_list][${index}][icon]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">Link</label><input type="text" name="meta[services_list][${index}][link]" class="form-control input-elegant">
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant">EN Title</label><input type="text" name="meta[services_list][${index}][title]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Desc</label><textarea name="meta[services_list][${index}][desc]" class="form-control input-elegant mb-3" rows="2"></textarea>
                                <label class="label-elegant">EN Btn Text</label><input type="text" name="meta[services_list][${index}][btn_text]" class="form-control input-elegant">
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[services_list][${index}][title_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[services_list][${index}][desc_bn]" class="form-control input-elegant mb-3" rows="2"></textarea>
                                <label class="label-elegant text-success">BN Btn Text</label><input type="text" name="meta[services_list][${index}][btn_text_bn]" class="form-control input-elegant">
                            </div>
                        </div>
                    </div>`;
            } else if(type === 'fleet-item') {
                html = `
                    <div class="dynamic-item">
                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="label-elegant">Image</label>
                                <input type="file" name="fleet_item_images[${index}]" class="form-control input-elegant" style="padding: 10px !important;">
                            </div>
                            <div class="col-md-4">
                                <label class="label-elegant">EN Title</label><input type="text" name="meta[fleet_items][${index}][title]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Specs</label><input type="text" name="meta[fleet_items][${index}][specs_raw]" class="form-control input-elegant" placeholder="4 Seats, AC, WiFi">
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[fleet_items][${index}][title_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Specs</label><input type="text" name="meta[fleet_items][${index}][specs_bn_raw]" class="form-control input-elegant" placeholder="৪ সিট, এসি, ওয়াইফাই">
                            </div>
                        </div>
                    </div>`;
            } else if(type === 'tour-item') {
                html = `
                    <div class="dynamic-item">
                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <label class="label-elegant">Tour Image</label>
                                <input type="file" name="tour_item_images[${index}]" class="form-control input-elegant" style="padding: 10px !important;">
                                <label class="label-elegant mt-3">Price (৳)</label><input type="text" name="meta[tour_items][${index}][price]" class="form-control input-elegant">
                            </div>
                            <div class="col-md-4">
                                <label class="label-elegant">EN Title</label><input type="text" name="meta[tour_items][${index}][title]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Badge</label><input type="text" name="meta[tour_items][${index}][badge]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Duration</label><input type="text" name="meta[tour_items][${index}][meta]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Desc</label><textarea name="meta[tour_items][${index}][desc]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[tour_items][${index}][title_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Badge</label><input type="text" name="meta[tour_items][${index}][badge_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Duration</label><input type="text" name="meta[tour_items][${index}][meta_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[tour_items][${index}][desc_bn]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                        </div>
                    </div>`;
            } else if(type === 'feature-item') {
                html = `
                    <div class="dynamic-item">
                        <span class="remove-item"><i class="fas fa-times-circle"></i></span>
                        <div class="row">
                            <div class="col-md-2"><label class="label-elegant">Icon</label><input type="text" name="meta[why_items][${index}][icon]" class="form-control input-elegant" placeholder="fas fa-star"></div>
                            <div class="col-md-5">
                                <label class="label-elegant">EN Title</label><input type="text" name="meta[why_items][${index}][title]" class="form-control input-elegant mb-3">
                                <label class="label-elegant">EN Desc</label><textarea name="meta[why_items][${index}][desc]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label class="label-elegant text-success">BN Title</label><input type="text" name="meta[why_items][${index}][title_bn]" class="form-control input-elegant mb-3">
                                <label class="label-elegant text-success">BN Desc</label><textarea name="meta[why_items][${index}][desc_bn]" class="form-control input-elegant" rows="2"></textarea>
                            </div>
                        </div>
                    </div>`;
            }

            container.append(html);
        });

        // Remove Item
        $(document).on('click', '.remove-item', function() {
            if(confirm('Are you sure you want to remove this item?')) {
                $(this).closest('.dynamic-item').fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    });
</script>
@endpush
