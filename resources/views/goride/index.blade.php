@extends('goride.layouts.master')

@section('title', 'GoRide Bangladesh | Car Rental & Transport Marketplace')

@section('content')
<style>
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        background: linear-gradient(160deg, rgba(10,40,22,0.90) 0%, rgba(20,94,46,0.78) 60%, rgba(26,122,60,0.65) 100%),
                    url("{{ asset('goride/css/assets/banner_01.jpg') }}") center/cover no-repeat;
        /* background: linear-gradient(160deg, rgba(10,40,22,0.90) 0%, rgba(20,94,46,0.78) 60%, rgba(26,122,60,0.65) 100%),
                    url("{{ asset('goride/assets/banner_01.jpg') }}") center/cover no-repeat; */
        background-attachment: fixed;
    }
</style>
<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-dots"></div>
    <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-circle-check"></i> {{ __('goride.hero.badge') }}</div>
        <h1>{{ __('goride.hero.title') }}<br><span>{{ __('goride.hero.span') }}</span></h1>
        <p>{{ __('goride.hero.subtitle') }}</p>
        <div class="hero-actions">
            <a href="#" class="btn-hero-primary"><i class="fas fa-car"></i> {{ __('goride.hero.book_now') }}</a>
            <a href="{{ route('tours') }}" class="btn-hero-secondary"><i class="fas fa-map-marked-alt"></i> {{ __('goride.hero.explore_tours') }}</a>
        </div>
    </div>
    <div class="hero-stats-bar">
        <div class="hstat"><strong>5,000+</strong><span>{{ __('goride.stats.happy_customers') }}</span></div>
        <div class="hstat"><strong>1,200+</strong><span>{{ __('goride.stats.fleet_vehicles') }}</span></div>
        <div class="hstat"><strong>64</strong><span>{{ __('goride.stats.districts_simple') }}</span></div>
        <div class="hstat"><strong>150+</strong><span>{{ __('goride.stats.corporate') }}</span></div>
    </div>
    <div class="hero-scroll-hint"><span>Scroll</span><i class="fas fa-chevron-down"></i></div>
</section>

<!-- ── ENTRY CARDS ── -->
<div class="entry-section">
    <div class="entry-cards">
        <a href="{{ route('registration.driver') }}" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-car-side"></i></div>
            <h3>{{ __('goride.entry.owners') }}</h3>
            <p>{{ __('goride.entry.owners_desc') }}</p>
            <span class="card-link">{{ __('goride.entry.join_now') }} <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('registration.corporate') }}" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-building"></i></div>
            <h3>{{ __('goride.entry.corporate') }}</h3>
            <p>{{ __('goride.entry.corporate_desc') }}</p>
            <span class="card-link">{{ __('goride.entry.learn_more') }} <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('registration') }}" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-user-check"></i></div>
            <h3>{{ __('goride.entry.solo') }}</h3>
            <p>{{ __('goride.entry.solo_desc') }}</p>
            <span class="card-link">{{ __('goride.entry.book_now') }} <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="{{ route('tours') }}" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-map-marked-alt"></i></div>
            <h3>{{ __('goride.entry.tours') }}</h3>
            <p>{{ __('goride.entry.tours_desc') }}</p>
            <span class="card-link">{{ __('goride.entry.explore') }} <i class="fas fa-arrow-right"></i></span>
        </a>
    </div>
</div>

<!-- ── STATS ── -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <i class="fas fa-users stat-icon"></i>
                <h3 id="count-customers">5000</h3>
                <p>{{ __('goride.stats.customers') }}</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-car stat-icon"></i>
                <h3 id="count-fleet">1200</h3>
                <p>{{ __('goride.stats.fleet_vehicles') }}</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-map-pin stat-icon"></i>
                <h3 id="count-dest">64</h3>
                <p>{{ __('goride.stats.districts_simple') }}</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-briefcase stat-icon"></i>
                <h3 id="count-corp">150</h3>
                <p>{{ __('goride.stats.corporate') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- ── WHY CHOOSE ── -->
<section style="background: white; padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-star"></i> {{ __('goride.why.label') }}</div>
            <h2>{{ __('goride.why.title') }}</h2>
            <p>{{ __('goride.why.subtitle') }}</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-shield-halved"></i></div>
                <h4>{{ __('goride.why.verified') }}</h4>
                <p>{{ __('goride.why.verified_desc') }}</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-mobile-screen-button"></i></div>
                <h4>{{ __('goride.why.mobile') }}</h4>
                <p>{{ __('goride.why.mobile_desc') }}</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-bangladeshi-taka-sign"></i></div>
                <h4>{{ __('goride.why.pricing') }}</h4>
                <p>{{ __('goride.why.pricing_desc') }}</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-clock"></i></div>
                <h4>24/7 Availability</h4>
                <p>Early morning flights, late night events — our drivers are available round the clock, every single day of the year.</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-route"></i></div>
                <h4>All 64 Districts</h4>
                <p>From Dhaka to Teknaf, Cox's Bazar to Sylhet — our network spans every district of Bangladesh without exception.</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-headset"></i></div>
                <h4>{{ __('goride.why.support') }}</h4>
                <p>{{ __('goride.why.support_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- ── APP DOWNLOAD ── -->
<section class="app-section">
    <div class="container">
        <div class="app-inner">
            <div class="app-text">
                <span class="app-label"><i class="fas fa-mobile-screen-button"></i> {{ __('goride.app.label') }}</span>
                <h2>{{ __('goride.app.title') }}<br><span>{{ __('goride.app.span') }}</span></h2>
                <p>{{ __('goride.app.desc') }}</p>
                <div class="app-features">
                    <div class="app-feat-item">
                        <i class="fas fa-location-dot"></i>
                        <span>{{ __('goride.app.feature1') }}</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-bell"></i>
                        <span>{{ __('goride.app.feature2') }}</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-wallet"></i>
                        <span>{{ __('goride.app.feature3') }}</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-star"></i>
                        <span>{{ __('goride.app.feature4') }}</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-language"></i>
                        <span>{{ __('goride.app.feature5') }}</span>
                    </div>
                </div>
                <div class="app-download-btns">
                    <a href="#" class="app-store-btn">
                        <i class="fab fa-apple"></i>
                        <div class="store-text">
                            <small>{{ __('goride.app.download_apple') }}</small>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a href="#" class="app-store-btn">
                        <i class="fab fa-google-play"></i>
                        <div class="store-text">
                            <small>{{ __('goride.app.download_google') }}</small>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>
            <div class="app-visual">
                <div class="app-float-badge left">
                    <div class="badge-icon green"><i class="fas fa-star"></i></div>
                    <div class="badge-text">
                        <strong>{{ __('goride.app.rating') }}</strong>
                        <span>{{ __('goride.app.reviews') }}</span>
                    </div>
                </div>
                <div class="phone-mockup-wrap">
                    <div class="phone-mockup">
                        <div class="phone-screen">
                            <div class="phone-notch"></div>
                            <div class="phone-ui-top">
                                <span class="app-name">GoRide</span>
                                <span class="app-tagline">Bangladesh's #1 Ride App</span>
                            </div>
                            <div class="phone-ride-card">
                                <div class="ride-row">
                                    <div class="ride-dot green"></div>
                                    <span>Gulshan 1, Dhaka</span>
                                </div>
                                <div class="ride-line"></div>
                                <div class="ride-row">
                                    <div class="ride-dot red"></div>
                                    <span>Hazrat Shahjalal Airport</span>
                                </div>
                            </div>
                            <div class="phone-book-btn">Book Now — ৳ 650</div>
                            <div class="phone-bottom-nav">
                                <i class="fas fa-house active"></i>
                                <i class="fas fa-magnifying-glass"></i>
                                <i class="fas fa-calendar"></i>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-float-badge right">
                    <div class="badge-icon yellow"><i class="fas fa-bolt"></i></div>
                    <div class="badge-text">
                        <strong>{{ __('goride.app.pickup') }}</strong>
                        <span>{{ __('goride.app.wait_time') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── TESTIMONIALS ── -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-heart"></i> {{ __('goride.testimonials.label') }}</div>
            <h2>{{ __('goride.testimonials.title') }}</h2>
            <p>{{ __('goride.testimonials.desc') }}</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Booked a ride to the airport at 4 AM and the driver was there 5 minutes early. The app made it so easy — I'll never go back to calling random numbers."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">RS</div>
                    <div class="author-info">
                        <strong>Rahim Sarkar</strong>
                        <span>Dhaka</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Our company has been using GoRide for all executive transport needs. The corporate dashboard and monthly invoicing have saved us so much admin time."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">FH</div>
                    <div class="author-info">
                        <strong>Farida Hossain</strong>
                        <span>HR Manager, Chittagong</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p>"The Cox's Bazar tour package was incredible. Comfortable car, experienced driver who knew all the best spots. Will definitely book again for our family trip."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">KA</div>
                    <div class="author-info">
                        <strong>Karim Ahmed</strong>
                        <span>Sylhet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
