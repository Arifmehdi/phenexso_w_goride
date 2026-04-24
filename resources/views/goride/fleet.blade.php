@extends('goride.layouts.master')

@section('title', 'Our Diverse Fleet | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>{{ $pageContents['fleet']->title ?? 'Our Diverse Fleet' }}</h1>
        <p>{{ $pageContents['fleet']->subtitle ?? 'From economical city sedans to luxury SUVs — the perfect ride for every journey.' }}</p>
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Car Fleet</span></div>
    </div>
</div>

<section style="background:white;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-car"></i> {{ $pageContents['fleet']->description ?? 'Choose Your Ride' }}</div>
            <h2>{{ $pageContents['fleet']->content ?? 'Vehicles for Every Need &amp; Budget' }}</h2>
            <p>{{ $pageContents['fleet']->meta['intro_text'] ?? 'All vehicles are regularly serviced, verified, and driven by licensed professionals. Pick the one that suits your trip.' }}</p>
        </div>
        <div class="fleet-grid">
            @php
                $fleet_items = $pageContents['fleet']->meta['fleet_items'] ?? null;
                if (is_string($fleet_items)) {
                    $fleet_items = json_decode($fleet_items, true);
                }
            @endphp

            @if($fleet_items && count($fleet_items) > 0)
                @foreach($fleet_items as $item)
                    <div class="fleet-card">
                        <div class="fleet-img">
                            @if(isset($item['image']) && (strpos($item['image'], 'http') === 0 || strpos($item['image'], 'goride/') === 0))
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] ?? 'Vehicle' }}">
                            @elseif(isset($item['image']))
                                <img src="{{ asset('storage/page_contents/' . $item['image']) }}" alt="{{ $item['title'] ?? 'Vehicle' }}">
                            @else
                                <img src="{{ asset('goride/assets/car.png') }}" alt="{{ $item['title'] ?? 'Vehicle' }}">
                            @endif
                        </div>
                        <div class="fleet-info">
                            <h3>{{ $item['title'] ?? '' }}</h3>
                            <p>{{ $item['description'] ?? '' }}</p>
                            <div class="fleet-specs">
                                @if(isset($item['specs']) && is_array($item['specs']))
                                    @foreach($item['specs'] as $spec)
                                        <div class="spec-item"><i class="{{ $spec['icon'] ?? 'fas fa-check' }}"></i> {{ $spec['text'] ?? '' }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="{{ $item['link'] ?? '#' }}" class="login-btn" style="display:block;text-align:center;">{{ $item['btn_text'] ?? 'Book Now' }}</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="fleet-card">
                    <div class="fleet-img"><img src="{{ asset('goride/assets/car.png') }}" alt="Standard Sedan"></div>
                    <div class="fleet-info">
                        <h3>Standard Sedan</h3>
                        <p>Toyota Allion, Premier, or Axio. Perfect for 4 passengers and everyday city travel.</p>
                        <div class="fleet-specs">
                            <div class="spec-item"><i class="fas fa-users"></i> 4 Seats</div>
                            <div class="spec-item"><i class="fas fa-suitcase"></i> 2 Bags</div>
                            <div class="spec-item"><i class="fas fa-snowflake"></i> AC</div>
                            <div class="spec-item"><i class="fas fa-wifi"></i> WiFi</div>
                        </div>
                        <a href="#" class="login-btn" style="display:block;text-align:center;">Book Sedan</a>
                    </div>
                </div>
                <!-- ... other fallback cards could go here but let's keep it clean ... -->
            @endif
        </div>
    </div>
</section>
@endsection
