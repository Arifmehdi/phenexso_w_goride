@extends('goride.layouts.master')

@section('title', 'About Us | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>{{ $pageContents['about']->title ?? 'About GoRide Bangladesh' }}</h1>
        <p>{{ $pageContents['about']->subtitle ?? 'Our story, mission, and the values that drive us forward every day.' }}</p>
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
                <div class="section-label"><i class="fas fa-flag"></i> {{ $pageContents['about']->title ?? 'Our Story' }}</div>
                <h2>{{ $pageContents['about']->title ?? 'Transforming Transport in Bangladesh Since 2026' }}</h2>
                <p>{{ $pageContents['about']->content ?? 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh — from corporate executives to everyday commuters.' }}</p>
                <p>{{ $pageContents['about']->meta['paragraph_2'] ?? 'As a bilingual marketplace serving both English and Bangla speakers, we have eliminated communication barriers and brought together vehicle owners, professional drivers, and customers on one seamless platform.' }}</p>
                <p>{{ $pageContents['about']->meta['paragraph_3'] ?? 'Our mobile-first approach means GoRide is always right in your pocket — ready when you need to book a quick city trip or a week-long inter-district journey.' }}</p>
                <div class="about-highlights">
                    @php
                        $highlights = $pageContents['about']->highlights;
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
                    <img src="{{ asset('goride/assets/banner/banner_01.jpg') }}" alt="GoRide journey">
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
                        <h3>{{ $card['title'] ?? '' }}</h3>
                        <p>{{ $card['description'] ?? '' }}</p>
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
            <span class="app-label" style="margin-bottom:20px;display:inline-flex;"><i class="fas fa-mobile-screen-button"></i> Mobile App</span>
            <h2 style="font-family:'Sora',sans-serif;font-size:clamp(1.9rem,3.5vw,2.8rem);font-weight:800;margin-bottom:18px;">Carry GoRide<br><span style="color:#7defa0;">Everywhere You Go</span></h2>
            <p style="opacity:0.8;margin-bottom:36px;">Book rides, track journeys, and explore Bangladesh — all from our mobile app. Available on iOS and Android.</p>
            <div class="app-download-btns" style="justify-content:center;">
                <a href="#" class="app-store-btn">
                    <i class="fab fa-apple"></i>
                    <div class="store-text"><small>Download on the</small><strong>App Store</strong></div>
                </a>
                <a href="#" class="app-store-btn">
                    <i class="fab fa-google-play"></i>
                    <div class="store-text"><small>Get it on</small><strong>Google Play</strong></div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
