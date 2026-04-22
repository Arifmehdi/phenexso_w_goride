@extends('goride.layouts.master')

@section('title', 'Our Services | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>Our Premium Services</h1>
        <p>A full range of transport solutions built for every need across Bangladesh.</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Services</span>
        </div>
    </div>
</div>

<section style="background: white;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-car"></i> What We Offer</div>
            <h2>Transport Solutions for<br>Every Occasion</h2>
            <p>From airport pickups to corporate fleets and curated tours — GoRide has a service that fits your journey.</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-plane-arrival"></i></div>
                <h3>Airport Pickup &amp; Drop</h3>
                <p>Hassle-free transfers to and from Hazrat Shahjalal International Airport. We track your flight for guaranteed punctuality — no matter when you land.</p>
                <a href="#" class="login-btn" style="display:inline-block;">Book Now</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-briefcase"></i></div>
                <h3>Corporate Fleet</h3>
                <p>Customised transport for businesses — monthly rentals, executive vehicles, and seamless employee commute management with dedicated invoicing.</p>
                <a href="{{ route('contact') }}" class="login-btn" style="display:inline-block;background:var(--text);">Inquire Now</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-heart"></i></div>
                <h3>Event &amp; Wedding</h3>
                <p>Make your special occasions unforgettable with our luxury fleet. Dedicated, well-dressed drivers for weddings, parties, and corporate events.</p>
                <a href="#" class="login-btn" style="display:inline-block;">Book Now</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-route"></i></div>
                <h3>Inter-City Travel</h3>
                <p>Safe, comfortable long-distance travel across all 64 districts. Experienced drivers who know the highways, rest stops, and best routes.</p>
                <a href="#" class="login-btn" style="display:inline-block;">Book Now</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-clock"></i></div>
                <h3>Hourly Rentals</h3>
                <p>Flexible hourly booking for city running. Perfect for multiple meetings, shopping trips, or errands where you need a car on standby all day.</p>
                <a href="#" class="login-btn" style="display:inline-block;">Book Now</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-umbrella-beach"></i></div>
                <h3>Tours &amp; Travels</h3>
                <p>Explore Bangladesh's most beautiful destinations with our curated tour packages. We handle all transport so you can fully enjoy the journey.</p>
                <a href="{{ route('tours') }}" class="login-btn" style="display:inline-block;">View Packages</a>
            </div>
        </div>
    </div>
</section>

<!-- App CTA -->
<section style="background:var(--accent);padding:80px 0;">
    <div class="container" style="text-align:center;">
        <div class="section-label" style="display:inline-flex;margin-bottom:16px;"><i class="fas fa-mobile-screen-button"></i> Book via App</div>
        <h2 style="font-family:'Sora',sans-serif;font-size:2rem;font-weight:800;margin-bottom:14px;color:var(--text);">All Services in One App</h2>
        <p style="color:var(--text-light);margin-bottom:32px;max-width:480px;margin-left:auto;margin-right:auto;">Download GoRide Bangladesh and access all our services with just a few taps. Available on iOS &amp; Android.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="#" style="display:flex;align-items:center;gap:10px;background:var(--primary);color:white;padding:13px 24px;border-radius:12px;font-family:'Sora',sans-serif;font-weight:700;">
                <i class="fab fa-apple" style="font-size:22px;"></i> App Store
            </a>
            <a href="#" style="display:flex;align-items:center;gap:10px;background:var(--text);color:white;padding:13px 24px;border-radius:12px;font-family:'Sora',sans-serif;font-weight:700;">
                <i class="fab fa-google-play" style="font-size:20px;"></i> Google Play
            </a>
        </div>
    </div>
</section>
@endsection
