@extends('admin.master')
@section('title', 'View Page Content | Admin Dashboard')
@section('body')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-file-alt mr-2"></i>Page Content Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page_contents.index') }}">Page Contents</a></li>
                    <li class="breadcrumb-item active">View Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Main Content</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.page_contents.edit', $pageContent->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $imagePath = null;
                            if (isset($pageContent->meta['image'])) {
                                $imagePath = asset('storage/page_contents/' . $pageContent->meta['image']);
                            }
                        @endphp

                        @if($imagePath)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted"><strong>Featured Image:</strong></h6>
                                <img src="{{ $imagePath }}" class="img-fluid rounded shadow-sm border" style="max-height: 300px; display: block; margin: 0 auto;" alt="Featured Image">
                            </div>
                        </div>
                        <hr>
                        @endif

                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Page Slug:</strong></div>
                            <div class="col-sm-9"><span class="badge badge-info">{{ $pageContent->page_slug }}</span></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Title:</strong></div>
                            <div class="col-sm-9"><h5>{{ $pageContent->title ?? 'N/A' }}</h5></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 text-muted"><strong>Subtitle:</strong></div>
                            <div class="col-sm-9 text-secondary">{{ $pageContent->subtitle ?? 'N/A' }}</div>
                        </div>
                        <hr>
                        <div class="mt-4">
                            <h6 class="text-muted"><strong>Description:</strong></h6>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($pageContent->description)) !!}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-muted"><strong>Full Content:</strong></h6>
                            <div class="p-3 border rounded">
                                {!! $pageContent->content ?? '<em class="text-muted">No content available</em>' !!}
                            </div>
                        </div>

                        @if($pageContent->page_slug == 'home')
                            <div class="mt-5">
                                <h6 class="text-muted mb-3 font-weight-bold">Home Hero Preview:</h6>
                                <div class="p-4 rounded border mb-4" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('goride/assets/banner/banner_01.jpg') }}') center/cover;">
                                    <div class="text-white">
                                        <span class="badge badge-success mb-2">{{ $pageContent->meta['hero_badge'] ?? 'N/A' }}</span>
                                        <h2 class="font-weight-bold">{{ $pageContent->meta['hero_title'] ?? 'N/A' }} <span class="text-success">{{ $pageContent->meta['hero_span'] ?? '' }}</span></h2>
                                        <p class="mb-3">{{ $pageContent->meta['hero_subtitle'] ?? 'N/A' }}</p>
                                        <button class="btn btn-success">{{ $pageContent->meta['hero_cta_text'] ?? 'Book Now' }}</button>
                                    </div>
                                </div>

                                <h6 class="text-muted mb-3 font-weight-bold">Live Stats:</h6>
                                <div class="row mb-4 text-center">
                                    <div class="col-md-3"><div class="p-3 bg-light border rounded"><h4 class="mb-0 font-weight-bold text-primary">{{ $pageContent->meta['stats_customers'] ?? '0' }}</h4><small>Customers</small></div></div>
                                    <div class="col-md-3"><div class="p-3 bg-light border rounded"><h4 class="mb-0 font-weight-bold text-success">{{ $pageContent->meta['stats_fleet'] ?? '0' }}</h4><small>Fleet</small></div></div>
                                    <div class="col-md-3"><div class="p-3 bg-light border rounded"><h4 class="mb-0 font-weight-bold text-info">{{ $pageContent->meta['stats_districts'] ?? '0' }}</h4><small>Districts</small></div></div>
                                    <div class="col-md-3"><div class="p-3 bg-light border rounded"><h4 class="mb-0 font-weight-bold text-warning">{{ $pageContent->meta['stats_corporate'] ?? '0' }}</h4><small>Corporate</small></div></div>
                                </div>

                                <h6 class="text-muted mb-3 font-weight-bold">Entry Cards Preview:</h6>
                                <div class="row mb-4">
                                    @php
                                        $entry_cards = $pageContent->meta['entry_cards'] ?? [];
                                        if (is_string($entry_cards)) { $entry_cards = json_decode($entry_cards, true) ?: []; }
                                    @endphp
                                    @foreach($entry_cards as $card)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100 border-0 shadow-sm text-center">
                                                <div class="card-body p-2">
                                                    <div class="text-primary mb-2" style="font-size: 1.2rem;"><i class="{{ $card['icon'] ?? 'fas fa-car' }}"></i></div>
                                                    <h6 class="font-weight-bold small mb-1">{{ $card['title'] ?? 'N/A' }}</h6>
                                                    <p class="text-xs text-muted mb-2">{{ Str::limit($card['description'] ?? '', 50) }}</p>
                                                    <span class="badge badge-light border text-xs">{{ $card['btn_text'] ?? 'Link' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <h6 class="text-muted mb-3 font-weight-bold mt-4">Why Choose Us Preview:</h6>
                                <div class="row mb-4">
                                    @php
                                        $why_cards = $pageContent->meta['why_cards'] ?? [];
                                        if (is_string($why_cards)) { $why_cards = json_decode($why_cards, true) ?: []; }
                                    @endphp
                                    @foreach($why_cards as $card)
                                        <div class="col-md-4 mb-3">
                                            <div class="card h-100 border-0 shadow-sm text-center">
                                                <div class="card-body">
                                                    <div class="text-success mb-2" style="font-size: 1.5rem;"><i class="{{ $card['icon'] ?? 'fas fa-star' }}"></i></div>
                                                    <h6 class="font-weight-bold">{{ $card['title'] ?? 'N/A' }}</h6>
                                                    <p class="small text-muted mb-0">{{ $card['description'] ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <h6 class="text-muted mb-3 font-weight-bold mt-4">Mobile App Section Preview:</h6>
                                <div class="p-3 bg-light border rounded">
                                    <span class="badge badge-info mb-2">{{ $pageContent->meta['app_label'] ?? 'N/A' }}</span>
                                    <h5 class="font-weight-bold">{{ $pageContent->meta['app_title'] ?? 'N/A' }} <span class="text-primary">{{ $pageContent->meta['app_span'] ?? '' }}</span></h5>
                                    <p class="text-muted small mb-3">{{ $pageContent->meta['app_description'] ?? 'N/A' }}</p>
                                    <ul class="list-unstyled mb-3">
                                        @php
                                            $app_features = $pageContent->meta['app_features'] ?? [];
                                            if (is_string($app_features)) { $app_features = json_decode($app_features, true) ?: []; }
                                        @endphp
                                        @foreach($app_features as $feature)
                                            <li class="text-xs mb-1"><i class="fas fa-check-circle text-success mr-1"></i> {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex gap-2">
                                        <span class="badge badge-dark mr-2"><i class="fab fa-apple mr-1"></i> App Store</span>
                                        <span class="badge badge-dark"><i class="fab fa-google-play mr-1"></i> Play Store</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($pageContent->page_slug == 'about')
                            <div class="mt-5">
                                <h6 class="text-muted mb-3"><strong>Vision, Mission & Values Cards:</strong></h6>
                                <div class="row">
                                    @php
                                        $vm_cards = $pageContent->meta['vm_cards'] ?? [];
                                        if (is_string($vm_cards)) {
                                            $vm_cards = json_decode($vm_cards, true) ?: [];
                                        }
                                    @endphp
                                    @forelse($vm_cards as $card)
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box bg-light border shadow-sm">
                                                <span class="info-box-icon bg-primary"><i class="{{ $card['icon'] ?? 'fas fa-check' }}"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text font-weight-bold">{{ $card['title'] ?? 'N/A' }}</span>
                                                    <span class="info-box-number small text-muted font-weight-normal" style="white-space: normal;">{{ $card['description'] ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No Vision/Mission cards defined.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        @if($pageContent->page_slug == 'services')
                            <div class="mt-5">
                                <h6 class="text-muted mb-3"><strong>Intro Text:</strong></h6>
                                <p class="p-3 bg-light rounded">{{ $pageContent->meta['intro_text'] ?? 'N/A' }}</p>

                                <h6 class="text-muted mb-3 mt-4"><strong>Service Items Manager Preview:</strong></h6>
                                <div class="row">
                                    @php
                                        $service_items = $pageContent->meta['service_items'] ?? [];
                                        if (is_string($service_items)) {
                                            $service_items = json_decode($service_items, true) ?: [];
                                        }
                                    @endphp
                                    @forelse($service_items as $item)
                                        <div class="col-md-6 mb-3">
                                            <div class="card h-100 border shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="bg-success p-2 rounded mr-3">
                                                            <i class="{{ $item['icon'] ?? 'fas fa-car' }} text-white"></i>
                                                        </div>
                                                        <h6 class="mb-0 font-weight-bold">{{ $item['title'] ?? 'N/A' }}</h6>
                                                    </div>
                                                    <p class="small text-muted">{{ $item['description'] ?? 'N/A' }}</p>
                                                    <div class="mt-2 text-right">
                                                        <span class="badge badge-primary">{{ $item['btn_text'] ?? 'Book Now' }}</span>
                                                        <small class="text-muted ml-1">{{ $item['link'] ?? '#' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No service items defined.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        @if($pageContent->page_slug == 'fleet')
                            <div class="mt-5">
                                <h6 class="text-muted mb-3"><strong>Intro Text:</strong></h6>
                                <p class="p-3 bg-light rounded">{{ $pageContent->meta['intro_text'] ?? 'N/A' }}</p>

                                <h6 class="text-muted mb-3 mt-4"><strong>Fleet Items Manager Preview:</strong></h6>
                                <div class="row">
                                    @php
                                        $fleet_items = $pageContent->meta['fleet_items'] ?? [];
                                        if (is_string($fleet_items)) {
                                            $fleet_items = json_decode($fleet_items, true) ?: [];
                                        }
                                    @endphp
                                    @forelse($fleet_items as $item)
                                        <div class="col-md-6 mb-3">
                                            <div class="card h-100 border shadow-sm">
                                                <div class="card-body">
                                                    <div class="text-center mb-3">
                                                        @if(isset($item['image']) && (strpos($item['image'], 'http') === 0 || strpos($item['image'], 'goride/') === 0))
                                                            <img src="{{ asset($item['image']) }}" style="max-height: 80px;" alt="Vehicle">
                                                        @elseif(isset($item['image']))
                                                            <img src="{{ asset('storage/page_contents/' . $item['image']) }}" style="max-height: 80px;" alt="Vehicle">
                                                        @endif
                                                    </div>
                                                    <h6 class="font-weight-bold text-center">{{ $item['title'] ?? 'N/A' }}</h6>
                                                    <p class="small text-muted text-center">{{ $item['description'] ?? 'N/A' }}</p>
                                                    
                                                    @if(isset($item['specs']) && is_array($item['specs']))
                                                    <div class="d-flex flex-wrap justify-content-center mt-2 mb-3">
                                                        @foreach($item['specs'] as $spec)
                                                            <span class="badge badge-light border mr-1 mb-1">
                                                                <i class="{{ $spec['icon'] ?? 'fas fa-check' }} mr-1"></i> {{ $spec['text'] ?? '' }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                    @endif

                                                    <div class="mt-2 text-center">
                                                        <span class="badge badge-warning">{{ $item['btn_text'] ?? 'Book Now' }}</span>
                                                        <div class="text-xs text-muted mt-1">{{ $item['link'] ?? '#' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No fleet items defined.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        @if($pageContent->page_slug == 'tours')
                            <div class="mt-5">
                                <h6 class="text-muted mb-3"><strong>Intro Text:</strong></h6>
                                <p class="p-3 bg-light rounded">{{ $pageContent->meta['intro_text'] ?? 'N/A' }}</p>

                                <h6 class="text-muted mb-3 mt-4"><strong>Tour Packages Preview:</strong></h6>
                                <div class="row">
                                    @php
                                        $tour_items = $pageContent->meta['tour_items'] ?? [];
                                        if (is_string($tour_items)) {
                                            $tour_items = json_decode($tour_items, true) ?: [];
                                        }
                                    @endphp
                                    @forelse($tour_items as $item)
                                        <div class="col-md-6 mb-3">
                                            <div class="card h-100 border shadow-sm overflow-hidden">
                                                <div style="height: 150px; overflow: hidden; background: #eee; position: relative;">
                                                    @if(isset($item['image']) && (strpos($item['image'], 'http') === 0 || strpos($item['image'], 'goride/') === 0))
                                                        <img src="{{ asset($item['image']) }}" class="w-100 h-100" style="object-fit: cover;" alt="Tour">
                                                    @elseif(isset($item['image']))
                                                        <img src="{{ asset('storage/page_contents/' . $item['image']) }}" class="w-100 h-100" style="object-fit: cover;" alt="Tour">
                                                    @endif
                                                    @if(isset($item['badge']) && $item['badge'])
                                                        <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">{{ $item['badge'] }}</span>
                                                    @endif
                                                    <div class="position-absolute bg-primary text-white p-1" style="bottom: 0; left: 0; font-weight: bold; font-size: 0.9rem;">
                                                        ৳ {{ $item['price'] ?? '0' }}
                                                    </div>
                                                </div>
                                                <div class="card-body p-3">
                                                    <h6 class="font-weight-bold mb-1">{{ $item['title'] ?? 'N/A' }}</h6>
                                                    <div class="text-xs text-warning mb-2">
                                                        <i class="fas fa-star"></i> {{ $item['rating'] ?? '5.0' }}
                                                        <span class="text-muted ml-2"><i class="fas fa-clock text-secondary"></i> {{ $item['duration'] ?? 'N/A' }}</span>
                                                    </div>
                                                    <p class="small text-muted mb-2">{{ Str::limit($item['description'] ?? '', 80) }}</p>
                                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                                        <span class="text-xs text-muted"><i class="fas fa-users mr-1"></i>{{ $item['people'] ?? 'N/A' }}</span>
                                                        <span class="badge badge-primary">{{ $item['btn_text'] ?? 'Book Now' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No tour packages defined.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Technical Data</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="text-muted"><strong>Highlights:</strong></h6>
                            @if($pageContent->highlights)
                                <pre class="bg-dark text-white p-2 rounded small"><code>{{ json_encode($pageContent->highlights, JSON_PRETTY_PRINT) }}</code></pre>
                            @else
                                <p class="text-muted small">No highlights defined.</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h6 class="text-muted"><strong>Raw Meta Data:</strong></h6>
                            @if($pageContent->meta)
                                <pre class="bg-dark text-white p-2 rounded small"><code>{{ json_encode($pageContent->meta, JSON_PRETTY_PRINT) }}</code></pre>
                            @else
                                <p class="text-muted small">No meta data defined.</p>
                            @endif
                        </div>
                        <hr>
                        <div class="mt-3">
                            <p class="mb-1 text-sm"><small class="text-muted">Created At: {{ $pageContent->created_at->format('M d, Y H:i') }}</small></p>
                            <p class="mb-0 text-sm"><small class="text-muted">Updated At: {{ $pageContent->updated_at->format('M d, Y H:i') }}</small></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.page_contents.index') }}" class="btn btn-default btn-block">
                            <i class="fas fa-arrow-left mr-1"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
