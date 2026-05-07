@extends('goride.layouts.master')

@section('title', 'Tours & Travels | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>Explore Beautiful Bangladesh</h1>
        <p>Curated travel packages with premium transport for your perfect getaway.</p>
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Tours &amp; Travels</span></div>
    </div>
</div>

<section style="background:white;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-map-marked-alt"></i> {{ $pageContents['tours']->title ?? 'Destinations' }}</div>
            <h2>{{ $pageContents['tours']->title ?? 'Handpicked Tour Packages' }}</h2>
            <p>{{ $pageContents['tours']->description ?? 'Every package includes premium transport, experienced local drivers, and a stress-free journey to Bangladesh\'s finest destinations.' }}</p>
        </div>
        <div class="tours-grid">
            @php
                $toursList = $pageContents['tours']->meta['tours_list'] ?? [];
            @endphp
            @if(!empty($toursList))
                @foreach($toursList as $tour)
                    <div class="tour-card">
                        <div class="tour-img">
                            <img src="{{ asset($tour['image'] ?? 'goride/assets/banner/banner_02.jpg') }}" alt="{{ $tour['title'] ?? '' }}">
                            <div class="tour-img-overlay"></div>
                            @if(!empty($tour['badge']))
                                <span class="tour-badge">{{ $tour['badge'] }}</span>
                            @endif
                            <div class="tour-price">৳ {{ $tour['price'] ?? '0' }}</div>
                        </div>
                        <div class="tour-info">
                            <div class="tour-meta">
                                <span><i class="fas fa-clock"></i> {{ $tour['meta'] ?? '' }}</span>
                                <span><i class="fas fa-star" style="color:#f59e0b;"></i> 4.9</span>
                            </div>
                            <h3>{{ $tour['title'] ?? '' }}</h3>
                            <p>{{ $tour['desc'] ?? '' }}</p>
                            <a href="{{ route('login') }}" class="login-btn" style="display:block;text-align:center;">Book Now</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="tour-card">
                    <div class="tour-img">
                        <img src="{{ asset('goride/assets/banner/banner_02.jpg') }}" alt="Cox's Bazar">
                        <div class="tour-img-overlay"></div>
                        <span class="tour-badge">Most Popular</span>
                        <div class="tour-price">৳ 12,000</div>
                    </div>
                    <div class="tour-info">
                        <div class="tour-meta">
                            <span><i class="fas fa-clock"></i> 3 Days 2 Nights</span>
                            <span><i class="fas fa-users"></i> Up to 7 People</span>
                            <span><i class="fas fa-star" style="color:#f59e0b;"></i> 4.9</span>
                        </div>
                        <h3>Cox's Bazar Beach Getaway</h3>
                        <p>Relax at the world's longest natural sea beach with our premium transport and experienced guide. Hotel pickup included.</p>
                        <a href="#" class="login-btn" style="display:block;text-align:center;">Book This Tour</a>
                    </div>
                </div>
                <div class="tour-card">
                    <div class="tour-img">
                        <img src="{{ asset('goride/assets/banner/banner_03.jpg') }}" alt="Sylhet">
                        <div class="tour-img-overlay"></div>
                        <span class="tour-badge">Best Value</span>
                        <div class="tour-price">৳ 8,500</div>
                    </div>
                    <div class="tour-info">
                        <div class="tour-meta">
                            <span><i class="fas fa-clock"></i> 2 Days 1 Night</span>
                            <span><i class="fas fa-users"></i> Up to 4 People</span>
                            <span><i class="fas fa-star" style="color:#f59e0b;"></i> 4.8</span>
                        </div>
                        <h3>Sylhet Tea Garden Adventure</h3>
                        <p>Visit lush green tea gardens, Jafflong waterfall, and the crystal-clear Lalakhal lake with our expert local drivers.</p>
                        <a href="#" class="login-btn" style="display:block;text-align:center;">Book This Tour</a>
                    </div>
                </div>
                <div class="tour-card">
                    <div class="tour-img">
                        <img src="{{ asset('goride/assets/banner/banner_01.jpg') }}" alt="Sajek Valley">
                        <div class="tour-img-overlay"></div>
                        <span class="tour-badge">Premium</span>
                        <div class="tour-price">৳ 15,000</div>
                    </div>
                    <div class="tour-info">
                        <div class="tour-meta">
                            <span><i class="fas fa-clock"></i> 3 Days 2 Nights</span>
                            <span><i class="fas fa-users"></i> Up to 6 People</span>
                            <span><i class="fas fa-star" style="color:#f59e0b;"></i> 4.9</span>
                        </div>
                        <h3>Sajek Valley Cloud Journey</h3>
                        <p>Experience the queen of hills. 4×4 vehicle support for hilly terrains, scenic stops, and spectacular sunrise views.</p>
                        <a href="#" class="login-btn" style="display:block;text-align:center;">Book This Tour</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- App CTA -->
<section style="background:var(--accent);padding:80px 0;">
    <div class="container" style="text-align:center;">
        <div class="section-label" style="display:inline-flex;margin-bottom:16px;"><i class="fas fa-mobile-screen-button"></i> Book on the Go</div>
        <h2 style="font-family:'Sora',sans-serif;font-size:2rem;font-weight:800;margin-bottom:14px;color:var(--text);">Book Tours From Your Phone</h2>
        <p style="color:var(--text-light);margin-bottom:32px;max-width:460px;margin-left:auto;margin-right:auto;">The GoRide app makes booking tour packages effortless. Browse, compare, and confirm in minutes.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="#" style="display:flex;align-items:center;gap:10px;background:var(--primary);color:white;padding:13px 24px;border-radius:12px;font-family:'Sora',sans-serif;font-weight:700;"><i class="fab fa-apple" style="font-size:22px;"></i> App Store</a>
            <a href="#" style="display:flex;align-items:center;gap:10px;background:var(--text);color:white;padding:13px 24px;border-radius:12px;font-family:'Sora',sans-serif;font-weight:700;"><i class="fab fa-google-play" style="font-size:20px;"></i> Google Play</a>
        </div>
    </div>
</section>
@endsection
