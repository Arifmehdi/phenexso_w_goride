@extends('goride.layouts.master')

@section('title', 'Our Diverse Fleet | GoRide Bangladesh')

@section('content')
<div class="page-hero">
    <div class="page-hero-content">
        <h1>Our Diverse Fleet</h1>
        <p>From economical city sedans to luxury SUVs — the perfect ride for every journey.</p>
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Car Fleet</span></div>
    </div>
</div>

<section style="background:white;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-car"></i> {{ $pageContents['fleet']->title ?? 'Choose Your Ride' }}</div>
            <h2>{{ $pageContents['fleet']->title ?? 'Vehicles for Every Need &amp; Budget' }}</h2>
            <p>{{ $pageContents['fleet']->description ?? 'All vehicles are regularly serviced, verified, and driven by licensed professionals. Pick the one that suits your trip.' }}</p>
        </div>
        <div class="fleet-grid">
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
            <div class="fleet-card">
                <div class="fleet-img"><img src="{{ asset('goride/assets/rent_car.png') }}" alt="Family MPV Noah"></div>
                <div class="fleet-info">
                    <h3>Family MPV (Noah)</h3>
                    <p>Toyota Noah or Voxy. Ideal for families, group outings, and airport transfers for multiple passengers.</p>
                    <div class="fleet-specs">
                        <div class="spec-item"><i class="fas fa-users"></i> 7 Seats</div>
                        <div class="spec-item"><i class="fas fa-suitcase"></i> 4 Bags</div>
                        <div class="spec-item"><i class="fas fa-snowflake"></i> AC</div>
                    </div>
                    <a href="#" class="login-btn" style="display:block;text-align:center;">Book Noah</a>
                </div>
            </div>
            <div class="fleet-card">
                <div class="fleet-img"><img src="{{ asset('goride/assets/motor.png') }}" alt="Microbus Hiace"></div>
                <div class="fleet-info">
                    <h3>Microbus (Hiace)</h3>
                    <p>Toyota Hiace Grand Cabin. Best for large groups, office tours, and extended-family travel with comfort.</p>
                    <div class="fleet-specs">
                        <div class="spec-item"><i class="fas fa-users"></i> 12 Seats</div>
                        <div class="spec-item"><i class="fas fa-suitcase"></i> 6 Bags</div>
                        <div class="spec-item"><i class="fas fa-snowflake"></i> Dual AC</div>
                    </div>
                    <a href="#" class="login-btn" style="display:block;text-align:center;">Book Hiace</a>
                </div>
            </div>
            <div class="fleet-card">
                <div class="fleet-img"><img src="{{ asset('goride/assets/car.png') }}" alt="Premium SUV"></div>
                <div class="fleet-info">
                    <h3>Premium SUV</h3>
                    <p>Toyota Prado or Harrier. Experience luxury and commanding comfort on your special days and executive trips.</p>
                    <div class="fleet-specs">
                        <div class="spec-item"><i class="fas fa-users"></i> 5 Seats</div>
                        <div class="spec-item"><i class="fas fa-suitcase"></i> 4 Bags</div>
                        <div class="spec-item"><i class="fas fa-star"></i> Luxury</div>
                    </div>
                    <a href="#" class="login-btn" style="display:block;text-align:center;">Book Premium</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
