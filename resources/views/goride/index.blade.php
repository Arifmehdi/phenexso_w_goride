@extends('goride.layouts.master')

@section('title', 'GoRide Bangladesh | Car Rental & Transport Marketplace')

@section('content')
<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-dots"></div>
    <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-circle-check"></i> Trusted by 5,000+ Customers Nationwide</div>
        <h1>Reliable Car Rental<br><span>Across Bangladesh</span></h1>
        <p>The leading transport marketplace for individuals, corporates &amp; tour groups. Mobile-first, bilingual, and always on time.</p>
        <div class="hero-actions">
            <a href="#" class="btn-hero-primary"><i class="fas fa-car"></i> Book a Ride Now</a>
            <a href="#" class="btn-hero-secondary"><i class="fas fa-map-marked-alt"></i> Explore Tours</a>
        </div>
    </div>
    <div class="hero-stats-bar">
        <div class="hstat"><strong>5,000+</strong><span>Happy<br>Customers</span></div>
        <div class="hstat"><strong>1,200+</strong><span>Vehicles<br>in Fleet</span></div>
        <div class="hstat"><strong>64</strong><span>Districts<br>Covered</span></div>
        <div class="hstat"><strong>150+</strong><span>Corporate<br>Clients</span></div>
    </div>
    <div class="hero-scroll-hint"><span>Scroll</span><i class="fas fa-chevron-down"></i></div>
</section>

<!-- ── ENTRY CARDS ── -->
<div class="entry-section">
    <div class="entry-cards">
        <a href="#" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-car-side"></i></div>
            <h3>Owners &amp; Drivers</h3>
            <p>Register your vehicle and start earning with our growing nationwide network.</p>
            <span class="card-link">Join Now <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="#" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-building"></i></div>
            <h3>Corporate Clients</h3>
            <p>Manage company transport with dedicated tools and transparent billing.</p>
            <span class="card-link">Learn More <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="#" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-user-check"></i></div>
            <h3>Solo Clients</h3>
            <p>Travel anywhere, anytime. Fast, reliable booking in just a few taps.</p>
            <span class="card-link">Book Now <i class="fas fa-arrow-right"></i></span>
        </a>
        <a href="#" class="entry-card">
            <div class="icon-wrap"><i class="fas fa-map-marked-alt"></i></div>
            <h3>Tours &amp; Travels</h3>
            <p>Structured packages across Bangladesh's most beautiful destinations.</p>
            <span class="card-link">Explore <i class="fas fa-arrow-right"></i></span>
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
                <p>Customers</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-car stat-icon"></i>
                <h3 id="count-fleet">1200</h3>
                <p>Fleet Vehicles</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-map-pin stat-icon"></i>
                <h3 id="count-dest">64</h3>
                <p>Districts</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-briefcase stat-icon"></i>
                <h3 id="count-corp">150</h3>
                <p>Corporate Clients</p>
            </div>
        </div>
    </div>
</section>

<!-- ── WHY CHOOSE ── -->
<section style="background: white; padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <div class="section-label"><i class="fas fa-star"></i> Why GoRide</div>
            <h2>The Smarter Way to Travel<br>Across Bangladesh</h2>
            <p>We combine local expertise with modern technology to deliver a transport experience that's reliable, affordable, and friction-free.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-shield-halved"></i></div>
                <h4>Verified Drivers &amp; Vehicles</h4>
                <p>Every driver and vehicle on our platform is thoroughly verified for safety, licensing, and fitness before listing.</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-mobile-screen-button"></i></div>
                <h4>Mobile-First Booking</h4>
                <p>Book, track, and manage rides entirely from your phone — in English or Bangla. Available on iOS &amp; Android.</p>
            </div>
            <div class="why-card">
                <div class="wc-icon"><i class="fas fa-bangladeshi-taka-sign"></i></div>
                <h4>Transparent Pricing</h4>
                <p>No hidden fees. Know the full fare before you confirm. We display all charges upfront so you can plan with confidence.</p>
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
                <h4>Dedicated Support</h4>
                <p>A real support team available via phone, WhatsApp, and in-app chat to resolve any issue within minutes.</p>
            </div>
        </div>
    </div>
</section>

<!-- ── APP DOWNLOAD ── -->
<section class="app-section">
    <div class="container">
        <div class="app-inner">
            <div class="app-text">
                <span class="app-label"><i class="fas fa-mobile-screen-button"></i> Mobile App</span>
                <h2>GoRide Is In<br><span>Your Pocket</span></h2>
                <p>Download the GoRide Bangladesh app and book rides, track your driver, pay securely, and manage all your trips — all in one place. Available in both English and বাংলা.</p>
                <div class="app-features">
                    <div class="app-feat-item">
                        <i class="fas fa-location-dot"></i>
                        <span>Real-time GPS tracking of your driver</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-bell"></i>
                        <span>Instant booking confirmations &amp; ride alerts</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-wallet"></i>
                        <span>Pay via bKash, Nagad, card or cash</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-star"></i>
                        <span>Rate drivers and give feedback after trips</span>
                    </div>
                    <div class="app-feat-item">
                        <i class="fas fa-language"></i>
                        <span>Full bilingual support — English &amp; বাংলা</span>
                    </div>
                </div>
                <div class="app-download-btns">
                    <a href="#" class="app-store-btn">
                        <i class="fab fa-apple"></i>
                        <div class="store-text">
                            <small>Download on the</small>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a href="#" class="app-store-btn">
                        <i class="fab fa-google-play"></i>
                        <div class="store-text">
                            <small>Get it on</small>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>
            <div class="app-visual">
                <div class="app-float-badge left">
                    <div class="badge-icon green"><i class="fas fa-star"></i></div>
                    <div class="badge-text">
                        <strong>4.8 ★ Rating</strong>
                        <span>10k+ Reviews</span>
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
                        <strong>3 Min Pickup</strong>
                        <span>Average wait time</span>
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
            <div class="section-label"><i class="fas fa-heart"></i> Customer Stories</div>
            <h2>What Our Riders Say</h2>
            <p>Thousands of satisfied customers across Bangladesh trust GoRide for their daily transport needs.</p>
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
