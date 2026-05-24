@extends('goride.layouts.master')

@section('title', 'About Us | GoRide Bangladesh')

@php
    $locale = app()->getLocale();
@endphp

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>{{ $locale == 'bn' ? ($pageContents['about']->title_bn ?? $pageContents['about']->title) : ($pageContents['about']->title ?? 'About GoRide Bangladesh') }}</h1>
        <p>{{ $locale == 'bn' ? ($pageContents['about']->subtitle_bn ?? $pageContents['about']->subtitle) : ($pageContents['about']->subtitle ?? 'Our story, mission, and the values that drive us forward every day.') }}</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>About Us</span>
        </div>
    </div>
</div>

<section style="background: white;">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <div class="section-label"><i class="fas fa-flag"></i> {{ $locale == 'bn' ? 'আমাদের গল্প' : 'Our Story' }}</div>
                <h2>{{ $locale == 'bn' ? ($pageContents['about']->title_bn ?? $pageContents['about']->title) : ($pageContents['about']->title ?? 'Transforming Transport in Bangladesh Since 2026') }}</h2>
                <p>{{ $locale == 'bn' ? ($pageContents['about']->content_bn ?? $pageContents['about']->content) : ($pageContents['about']->content ?? '') }}</p>
                
                @php
                    $p2 = $locale == 'bn' ? ($pageContents['about']->meta_bn['paragraph_2'] ?? $pageContents['about']->meta['paragraph_2'] ?? '') : ($pageContents['about']->meta['paragraph_2'] ?? '');
                    $p3 = $locale == 'bn' ? ($pageContents['about']->meta_bn['paragraph_3'] ?? $pageContents['about']->meta['paragraph_3'] ?? '') : ($pageContents['about']->meta['paragraph_3'] ?? '');
                @endphp
                
                @if($p2) <p>{{ $p2 }}</p> @endif
                @if($p3) <p>{{ $p3 }}</p> @endif

                <div class="about-highlights">
                    @php
                        $highlights = $locale == 'bn' ? ($pageContents['about']->highlights_bn ?? $pageContents['about']->highlights) : ($pageContents['about']->highlights ?? []);
                        if (is_string($highlights)) {
                            $highlights = json_decode($highlights, true);
                        }
                    @endphp
                    @if($highlights && count($highlights) > 0)
                        @foreach($highlights as $highlight)
                            <span class="about-highlight-item"><i class="fas fa-check"></i> {{ $highlight }}</span>
                        @endforeach
                    @else
                        <span class="about-highlight-item"><i class="fas fa-check"></i> Founded 2026</span>
                        <span class="about-highlight-item"><i class="fas fa-check"></i> All 64 Districts</span>
                        <span class="about-highlight-item"><i class="fas fa-check"></i> Bilingual Platform</span>
                        <span class="about-highlight-item"><i class="fas fa-check"></i> Mobile-First</span>
                        <span class="about-highlight-item"><i class="fas fa-check"></i> Verified Drivers</span>
                    @endif
                </div>
            </div>
            <div class="about-img-wrap">
                @if(isset($pageContents['about']->meta['image']) && $pageContents['about']->meta['image'])
                    <img src="{{ asset('storage/page_contents/' . $pageContents['about']->meta['image']) }}" alt="{{ $pageContents['about']->title ?? 'GoRide journey' }}">
                @else
                    <img src="{{ asset('goride/assets/banner_01.jpg') }}" alt="GoRide journey">
                @endif
            </div>
        </div>

        <div class="vm-grid">
            @php
                $vm_cards = $pageContents['about']->meta['vm_cards'] ?? null;
                if (is_string($vm_cards)) {
                    $vm_cards = json_decode($vm_cards, true);
                }
            @endphp

            @if($vm_cards && count($vm_cards) > 0)
                @foreach($vm_cards as $card)
                    <div class="vm-card">
                        <div class="vm-icon"><i class="{{ $card['icon'] ?? 'fas fa-check' }}"></i></div>
                        <h3>{{ $locale == 'bn' ? ($card['title_bn'] ?? $card['title']) : ($card['title'] ?? '') }}</h3>
                        <p>{{ $locale == 'bn' ? ($card['description_bn'] ?? $card['description']) : ($card['description'] ?? '') }}</p>
                    </div>
                @endforeach
            @else
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-eye"></i></div>
                    <h3>Our Vision</h3>
                    <p>To become the backbone of Bangladesh's transport industry — providing seamless connectivity between every city, village, and airport through technology, trust, and an unwavering commitment to quality.</p>
                </div>
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>To empower vehicle owners and drivers with sustainable earning opportunities while giving corporate and individual clients safe, professional, and transparent car rental services nationwide.</p>
                </div>
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-heart"></i></div>
                    <h3>Our Values</h3>
                    <p>Safety first. Transparency always. Customer satisfaction guaranteed. We operate with honesty, respect for every rider and driver, and a relentless drive to improve Bangladesh's mobility.</p>
                </div>
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-mobile-screen-button"></i></div>
                    <h3>Technology Focus</h3>
                    <p>From real-time GPS tracking to OTP-verified bookings and digital receipts — our tech stack is built to make every journey smoother, safer, and more transparent for all parties involved.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- App Section teaser -->
<section class="app-section">
    <div class="container">
        <div style="text-align:center; max-width:600px; margin:0 auto;">
            <span class="app-label" style="margin-bottom:20px;display:inline-flex;"><i class="fas fa-mobile-screen-button"></i> {{ __('goride.app.label') }}</span>
            <h2 style="font-family:'Sora',sans-serif;font-size:clamp(1.9rem,3.5vw,2.8rem);font-weight:800;margin-bottom:18px;">{{ __('goride.app.title') }}<br><span style="color:#7defa0;">{{ __('goride.app.span') }}</span></h2>
            <p style="opacity:0.8;margin-bottom:36px;">{{ __('goride.app.desc') }}</p>
            <div class="app-download-btns" style="justify-content:center;">
                <a href="#" class="app-store-btn">
                    <i class="fab fa-apple"></i>
                    <div class="store-text"><small>{{ __('goride.app.download_apple') }}</small><strong>App Store</strong></div>
                </a>
                <a href="#" class="app-store-btn">
                    <i class="fab fa-google-play"></i>
                    <div class="store-text"><small>{{ __('goride.app.download_google') }}</small><strong>Google Play</strong></div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
