@extends('website.layouts.master')

@section('title', 'About Us - Hubli')

@section('meta')
<meta name="description" content="Learn about Hubli’s mission to transform Bangladesh’s food supply chain and eliminate food wastage with a smart, efficient national network.">
<meta name="keywords" content="Hubli, food hub, supply chain, food wastage, Bangladesh, agriculture">
<meta property="og:title" content="About Us - Hubli">
<meta property="og:description" content="Transforming Bangladesh’s food supply chain with smart logistics and technology.">
<meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/contact_banner.png') }}">
<meta property="og:type" content="website">
@endsection

@push('styles')
<style>

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .animate-fade-up {
        animation: fadeInUp 0.8s ease-out;
    }

    .animate-slide {
        animation: slideIn 0.8s ease-out;
    }

    .animate-scale {
        animation: scaleIn 0.6s ease-out;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #14b8a6 100%);
        position: relative;
        overflow: hidden;
        padding: 120px 0 80px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* Cards */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        border-color: var(--primary-color);
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        background: linear-gradient(135deg, var(--icon-from), var(--icon-to));
    }

    /* Statistics */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        height: 100%;
    }

    .stat-number {
        font-size: 4rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: #6b7280;
    }

    /* Progress Bars */
    .progress-item {
        margin-bottom: 25px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .progress {
        height: 14px;
        border-radius: 10px;
        background-color: #e5e7eb;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 1.5s ease-out;
        border-radius: 10px;
    }

    /* Circular Stats */
    .circular-stat {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
    }

    .circular-stat svg {
        transform: rotate(-90deg);
    }

    .circular-stat .stat-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.8rem;
        font-weight: 700;
    }

    /* Issue Cards */
    .issue-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 2px solid #f3f4f6;
        height: 100%;
    }

    .issue-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    /* Supply Chain Comparison */
    .comparison-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        border: 4px solid;
        height: 100%;
    }

    .comparison-card.old-system {
        border-color: #fecaca;
        background: linear-gradient(to bottom, white, #fef2f2);
    }

    .comparison-card.new-system {
        border-color: #a7f3d0;
        background: linear-gradient(to bottom, white, #ecfdf5);
    }

    .chain-step {
        padding: 18px;
        border-radius: 12px;
        text-align: center;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.05rem;
    }

    .chain-arrow {
        text-align: center;
        font-size: 2rem;
        color: currentColor;
        margin: 10px 0;
        animation: bounce 2s infinite;
    }

    /* Feature Boxes */
    .feature-box {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        text-align: center;
        transition: all 0.4s ease;
    }

    .feature-box:hover {
        transform: scale(1.05);
    }

    .feature-box.primary {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
    }

    .feature-box.success {
        background: linear-gradient(135deg, #10b981, #14b8a6);
        color: white;
    }

    .feature-box.purple {
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        color: white;
    }

    /* Section Styles */
    .section-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .section-subtitle {
        font-size: 1.5rem;
        color: #6b7280;
        margin-bottom: 50px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            padding: 80px 0 60px;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 3rem;
        }
    }
</style>
@endpush

@section('content')

<!-- BREADCRUMB AREA START -->
<x-breadcrumb title="About Us" pageName="About Us" bgImage="frontend/img/bg/9.jpg" />
<!-- BREADCRUMB AREA END -->

{{-- INTRO SECTION --}}
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Revamping Food Supply Chain</h2>
            <p class="section-subtitle text-success fw-semibold">A New Era of Smart Food Distribution</p>
        </div>

        <div class="row g-4 mb-5">
            {{-- Problem Card --}}
            <div class="col-md-4">
                <div class="feature-card animate-slide" style="animation-delay: 0.1s;">
                    <div class="icon-box" style="--icon-from: #ef4444; --icon-to: #f97316;">
                        <i class="bi bi-exclamation-triangle-fill text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">The Problem</h3>
                    <p class="text-muted">Bangladesh faces massive food loss due to poor storage, mismanagement, unregulated middlemen, and inefficient transport systems.</p>
                </div>
            </div>

            {{-- Vision Card --}}
            <div class="col-md-4">
                <div class="feature-card animate-slide" style="animation-delay: 0.2s;">
                    <div class="icon-box" style="--icon-from: #10b981; --icon-to: #14b8a6;">
                        <i class="bi bi-graph-up-arrow text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Our Vision</h3>
                    <p class="text-muted">Build a nationwide supply chain where products move directly from producers to consumers — reducing waste and ensuring fair pricing.</p>
                </div>
            </div>

            {{-- Solution Card --}}
            <div class="col-md-4">
                <div class="feature-card animate-slide" style="animation-delay: 0.3s;">
                    <div class="icon-box" style="--icon-from: #3b82f6; --icon-to: #6366f1;">
                        <i class="bi bi-lightning-charge-fill text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Our Solution</h3>
                    <p class="text-muted">Advanced storage, refrigerated transport, and digital platforms eliminate illegal stockpiling and middlemen exploitation.</p>
                </div>
            </div>
        </div>

        {{-- Team Badge --}}
        <div class="text-center">
            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Submit Quote</button>
        </div>
    </div>
</section>

{{-- FOOD WASTE SECTION --}}
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="section-title">How Much Food Is Wasted?</h2>
            <p class="text-muted">Every year in Bangladesh</p>
        </div>

        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h3 class="fw-bold">Food Waste Statistics</h3>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2">🍚 <strong>82 kg</strong> food wasted per person</li>
                    <li class="mb-2">🗑️ <strong>21.10 million tons</strong> wasted annually</li>
                </ul>
                <p class="text-muted">Equivalent to the weight of 5 million elephants.</p>
            </div>

            <div class="col-lg-6 text-center">
                <img src="{{ asset('frontend/img/about_us/food_waste_general.webp') }}" 
                     class="img-fluid rounded shadow animate-scale" alt="Food Waste">
            </div>
        </div>

    </div>
</section>


{{-- CHARTS SECTION --}}
<section class="py-5 bg-light">
    <div class="container">

        <div class="row g-4 justify-content-center">

            <div class="col-md-6 d-flex flex-column align-items-center text-center">
                <h4 class="fw-bold mb-3">Annual Per Person Food Waste in South Asia</h4>
                <img src="{{ asset('frontend/img/about_us/bar_chart_south_asia.webp') }}"
                     class="chart-img img-fluid rounded shadow animate-fade-up">
            </div>

            <div class="col-md-6 d-flex flex-column align-items-center text-center">
                <h4 class="fw-bold mb-3">Breakdown of Annual Food Wastage</h4>
                <img src="{{ asset('frontend/img/about_us/pie_chart_wastage_stage.webp') }}"
                     class="chart-img img-fluid rounded shadow animate-fade-up">
            </div>

        </div>

    </div>
</section>


{{-- SUPPLY CHAIN ISSUES --}}
<section class="py-5">
    <div class="container">

        <h2 class="section-title text-center mb-5">Major Issues in Today’s Supply Chain</h2>

        <div class="row g-4">
            {{-- Storage --}}
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">Lack of Usable Storage</h4>
                <img src="{{ asset('frontend/img/about_us/storage_images.webp') }}" 
                     class="img-fluid rounded shadow">
            </div>

            {{-- Management --}}
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">Poor Management System</h4>
                <img src="{{ asset('frontend/img/about_us/management_images_01.webp') }}" 
                     class="img-fluid rounded shadow">
            </div>
        </div>

        <div class="row g-4 mt-4">
            {{-- Inflation --}}
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">Inflation Due to Illegal Stockpiling</h4>
                <img src="{{ asset('frontend/img/about_us/inflation_images.webp') }}" 
                     class="img-fluid rounded shadow">
            </div>

            {{-- Farmers --}}
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">Farmers Go Unattended</h4>
                <img src="{{ asset('frontend/img/about_us/farmers_unattended_images.webp') }}" 
                     class="img-fluid rounded shadow">
            </div>
        </div>

    </div>
</section>

{{-- SUPPLY CHAIN COMPARISON --}}
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Solution: The Food Hub</h2>
            <p class="section-subtitle">A nationwide one-step supply chain to eliminate food wastage</p>
        </div>

        <div class="row g-4">
            {{-- Old System --}}
            <div class="col-lg-6">
                <div class="comparison-card old-system">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box" style="--icon-from: #ef4444; --icon-to: #dc2626;">
                            <i class="bi bi-x-lg text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-0">Current System</h3>
                    </div>

                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Producer</div>
                    <div class="chain-arrow text-danger">↓</div>
                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Small Local Buyers</div>
                    <div class="chain-arrow text-danger">↓</div>
                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Major Local Buyers</div>
                    <div class="chain-arrow text-danger">↓</div>
                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Urban Wholesale Market</div>
                    <div class="chain-arrow text-danger">↓</div>
                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Retail Seller</div>
                    <div class="chain-arrow text-danger">↓</div>
                    <div class="chain-step bg-danger bg-opacity-10 text-dark">Consumer</div>

                    <div class="alert alert-danger mt-4 mb-0">
                        <strong>❌ 6+ Manual Steps</strong> • High Waste • Unfair Pricing
                    </div>
                </div>
            </div>

            {{-- New System --}}
            <div class="col-lg-6">
                <div class="comparison-card new-system">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box" style="--icon-from: #10b981; --icon-to: #059669;">
                            <i class="bi bi-check-lg text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-0">Hubli System</h3>
                    </div>

                    <div class="chain-step bg-success bg-opacity-10 text-dark">Producer</div>
                    <div class="chain-arrow text-success">↓</div>
                    <div class="chain-step bg-success bg-opacity-10 text-dark">Local Food Hub (Hubli)</div>
                    <div class="chain-arrow text-success">↓</div>
                    <div class="chain-step bg-success bg-opacity-10 text-dark">Consumer</div>

                    <div class="alert alert-success mt-5 mb-0">
                        <strong>✅ Only 3 Manual Steps:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Collection</li>
                            <li>Storing</li>
                            <li>Delivering</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- DIGITAL PLATFORM --}}
<section class="py-5">
    <div class="container text-center">

        <h2 class="section-title mb-4">Digital Platform Execution</h2>
        <p>Website + Mobile App to track prices, delivery time, booking transport, and tracking in real time.</p>

        <img src="{{ asset('frontend/img/about_us/website_app_image.webp') }}" 
             class="img-fluid rounded shadow mt-4">
    </div>
</section>


{{-- REMOVE MIDDLEMEN --}}
<section class="py-5 bg-light">
    <div class="container text-center">

        <h2 class="section-title mb-4">Eliminating Middlemen</h2>

        <p>Only one intermediary — Hubli — ensuring transparency and fair pricing.</p>

        <img src="{{ asset('frontend/img/about_us/graph_image.webp') }}" 
             class="img-fluid rounded shadow mt-4">

    </div>
</section>


{{-- TRANSPORT SECTION --}}
<section class="py-5">
    <div class="container">

        <h2 class="section-title text-center mb-5">Modern & Advanced Transport</h2>

        <div class="row g-4">
            <div class="col-md-6 text-center">
                <h4 class="fw-bold">Refrigerated Trucks</h4>
                <img src="{{ asset('frontend/img/about_us/refrigerated_trucks.webp') }}" 
                     class="img-fluid rounded shadow my-3">
            </div>

            <div class="col-md-6 text-center">
                <h4 class="fw-bold">Smart Apps</h4>
                <img src="{{ asset('frontend/img/about_us/smart_apps.webp') }}" 
                     class="img-fluid rounded shadow my-3">
            </div>
        </div>

    </div>
</section>


{{-- FEATURES SECTION --}}
<!-- <section class="py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box primary shadow-lg">
                    <i class="bi bi-bar-chart-fill mb-4" style="font-size: 4rem;"></i>
                    <h3 class="h4 fw-bold mb-3">Digital Platform</h3>
                    <p class="mb-0 opacity-90">Website + Mobile App to track prices, delivery time, book transport, and real-time tracking.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box success shadow-lg">
                    <i class="bi bi-people-fill mb-4" style="font-size: 4rem;"></i>
                    <h3 class="h4 fw-bold mb-3">Eliminating Middlemen</h3>
                    <p class="mb-0 opacity-90">Only one intermediary — Hubli — ensuring transparency, fair pricing & national efficiency.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box purple shadow-lg">
                    <i class="bi bi-truck mb-4" style="font-size: 4rem;"></i>
                    <h3 class="h4 fw-bold mb-3">Modern Transport</h3>
                    <p class="mb-0 opacity-90">Refrigerated trucks prevent spoilage. Smart apps let farmers book transport and track in real-time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-5 text-white" style="background: linear-gradient(135deg, #059669, #14b8a6);">
    <div class="container py-5">
        <div class="text-center">
            <h2 class="display-4 fw-bold mb-4">Join the Food Revolution</h2>
            <p class="lead mb-5">Together, we can eliminate food waste and build a sustainable future for Bangladesh.</p>
            <a href="#" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                Get Started Today
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section> -->

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Animate progress bars on scroll
    const animateProgressBars = () => {
        const progressBars = document.querySelectorAll('.progress-bar[data-width]');
        
        progressBars.forEach(bar => {
            const rect = bar.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
            
            if (isVisible && !bar.classList.contains('animated')) {
                const width = bar.getAttribute('data-width');
                setTimeout(() => {
                    bar.style.width = width + '%';
                }, 200);
                bar.classList.add('animated');
            }
        });
    };

    // Animate circular stats
    const animateCircularStats = () => {
        const circles = document.querySelectorAll('.stage-circle[data-percent]');
        
        circles.forEach(circle => {
            const rect = circle.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
            
            if (isVisible && !circle.classList.contains('animated')) {
                const percent = circle.getAttribute('data-percent');
                const circumference = 2 * Math.PI * 60; // r = 60
                const dashArray = (percent / 100) * circumference;
                
                setTimeout(() => {
                    circle.setAttribute('stroke-dasharray', dashArray + ' ' + circumference);
                }, 200);
                circle.classList.add('animated');
            }
        });
    };

    // Scroll reveal animation
    const revealOnScroll = () => {
        const elements = document.querySelectorAll('.feature-card, .issue-card, .stat-card, .comparison-card');
        
        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight - 100;
            
            if (isVisible) {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }
        });
    };

    // Initialize animations
    animateProgressBars();
    animateCircularStats();
    revealOnScroll();

    // Listen to scroll events
    window.addEventListener('scroll', () => {
        animateProgressBars();
        animateCircularStats();
        revealOnScroll();
    });

    // Smooth scroll for links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush