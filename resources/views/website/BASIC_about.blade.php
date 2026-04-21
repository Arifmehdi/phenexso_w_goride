@extends('frontend.layouts.master')

@section('title', 'About Us - Hubli')

@section('meta')
<meta name="description" content="Learn about Hubli’s mission to transform Bangladesh’s food supply chain and eliminate food wastage with a smart, efficient national network.">
<meta name="keywords" content="Hubli, food hub, supply chain, food wastage, Bangladesh, agriculture">
<meta property="og:title" content="About Us - Hubli">
<meta property="og:description" content="Transforming Bangladesh’s food supply chain with smart logistics and technology.">
<meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/contact_banner.png') }}">
<meta property="og:type" content="website">
@endsection

@section('content')

{{-- BANNER / BREADCRUMB --}}
<div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner justify-content-between">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle">//  Welcome to Hubli</h6>
                        <h1 class="section-title white-color">About Us</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>About Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INTRO SECTION --}}
<section class="ltn__about-us-area pt-90 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-40">
                <img src="{{ asset('frontend/img/others/6.png') }}" class="img-fluid rounded shadow-sm" alt="About Hubli">
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="section-title-area mb-20">
                    <h6 class="section-subtitle ltn__secondary-color">Revamping Food Supply Chain</h6>
                    <h1 class="section-title">A New Era of Smart Food Distribution</h1>
                    <p>
                        Every year, Bangladesh faces massive food loss due to poor storage, mismanagement,
                        unregulated middlemen, and inefficient transport systems. Hubli was built to solve these
                        nationwide problems and create a modern food ecosystem.
                    </p>

                    <p>
                        We aim to build a nationwide supply chain where products move directly from 
                        <strong>producers to consumers</strong> with minimal steps — reducing waste,
                        increasing efficiency, and ensuring fair pricing.
                    </p>

                    <p>
                        With advanced storage, refrigerated transport, and digital platforms, Hubli eliminates
                        illegal stockpiling and middlemen exploitation — increasing farmers’ profit and reducing food loss.
                    </p>

                    <div class="d-flex align-items-center mt-20">
                        <div>
                            <h4 class="mb-0">Hubli Team</h4>
                            <small>/ Supply Chain Innovators</small>
                        </div>
                        <div class="ms-3">
                            <img src="{{ asset('frontend/img/icons/icon-img/author-sign.png') }}" alt="signature">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN PRESENTATION CONTENT --}}
<section class="pt-90 pb-90 bg-light">
    <div class="container">
        <div class="section-title-area text-center mb-50">
            <h1 class="section-title">Why We Exist</h1>
            <p class="mt-2">Understanding the food crisis and supply chain challenges.</p>
        </div>

        {{-- FOOD WASTE SECTION --}}
        <div class="row mb-50">
            <div class="col-lg-6">
                <h3>How much food is wasted in our country every year?</h3>
                <ul class="ltn__list-item-half ltn__list-item-half-2">
                    <li>Average 82 kg per person</li>
                    <li>Over <strong>21.10 million tons</strong> wasted annually</li>
                </ul>
                <p class="text-muted">Equivalent to the weight of 5 million elephants.</p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('frontend/img/about_us/food_waste_general.webp') }}" class="img-fluid" alt="Food Waste">
            </div>
        </div>

        <div class="row mb-40">
            <div class="col-lg-6 mb-20">
                <h4>Annual Per Person Food Waste in South Asia</h4>
                <img src="{{ asset('frontend/img/about_us/bar_chart_south_asia.webp') }}" class="img-fluid rounded" alt="Bar Chart">
            </div>
            <div class="col-lg-6 mb-20">
                <h4>Breakdown of Annual Food Wastage by Stage</h4>
                <img src="{{ asset('frontend/img/about_us/pie_chart_wastage_stage.webp') }}" class="img-fluid rounded" alt="Pie Chart">
            </div>
        </div>

        {{-- SUPPLY CHAIN ISSUES --}}
        <div class="section-title-area mb-40">
            <h2 class="section-title">Major Issues in Today’s Supply Chain</h2>
        </div>

        <ul class="ltn__list-item-1 mb-40">
            <li>Farmers go unattended</li>
            <li>Lack of sufficient and usable storage</li>
            <li>Poor management systems</li>
            <li>Unregulated middlemen causing price distortion</li>
            <li>Inflation due to illegal stockpiling</li>
        </ul>

        {{-- STORAGE ISSUE --}}
        <h3 class="mb-20">Lack of Sufficient & Usable Storage</h3>
        <img src="{{ asset('frontend/img/about_us/storage_images.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- MANAGEMENT ISSUE --}}
        <h3 class="mb-20">Lack of Proper Management</h3>
        <img src="{{ asset('frontend/img/about_us/management_images_01.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- MIDDLEMEN ISSUE --}}
        <h3 class="mb-20">Unregulated Middlemen Activity</h3>
        <p>Current supply chain structure:</p>
        <div class="p-3 bg-white rounded shadow-sm mb-40">
<pre class="mb-0">
Producer  
   ↓
Small Local Buyers
   ↓
Major Local Buyers
   ↓
Urban Wholesale Market
   ↓
Retail Seller
   ↓
Consumer
</pre>
        </div>

        {{-- ILLEGAL STOCKPILING --}}
        <h3 class="mb-20">Inflation Due to Illegal Stockpiling</h3>
        <img src="{{ asset('frontend/img/about_us/inflation_images.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- FARMERS --}}
        <h3 class="mb-20">Farmers Go Unattended</h3>
        <img src="{{ asset('frontend/img/about_us/farmers_unattended_images.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- SOLUTION --}}
        <div class="section-title-area mt-60 mb-30">
            <h2 class="section-title">Our Solution: The Food Hub</h2>
        </div>

        <p>A nationwide one-step supply chain to eliminate food wastage.</p>
        <img src="{{ asset('frontend/img/about_us/food_hub_images_01.webp') }}" class="img-fluid mb-30 rounded shadow">

        <p>Our simplified supply chain:</p>
        <div class="p-3 bg-white rounded shadow-sm mb-40">
<pre class="mb-0">
Producer  
   ↓
Local Food Hub
   ↓
Consumer
</pre>
        </div>

        <h4>Only 3 Manual Steps</h4>
        <ul class="ltn__list-item-1 mb-40">
            <li>Collection</li>
            <li>Storing</li>
            <li>Delivering</li>
        </ul>
        <img src="{{ asset('frontend/img/about_us/collection_storing_delivering.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- DIGITAL PLATFORM --}}
        <h4>Digital Platform Execution</h4>
        <p>
            Website + Mobile App to track prices, delivery time, booking transport, and real-time tracking.
        </p>
        <img src="{{ asset('frontend/img/about_us/website_app_image.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- MIDDLEMEN REMOVED --}}
        <h2 class="section-title mb-20">Eliminating Middlemen</h2>
        <p>
            Only one intermediary — Hubli — ensuring transparency, fair pricing & national efficiency.
        </p>
        <img src="{{ asset('frontend/img/about_us/graph_image.webp') }}" class="img-fluid mb-40 rounded shadow">

        {{-- TRANSPORT --}}
        <h2 class="section-title mb-20">Modern & Advanced Transport</h2>

        <h4>Refrigerated Trucks</h4>
        <ul class="ltn__list-item-1 mb-20">
            <li>Prevents spoilage</li>
            <li>Longer shelf life</li>
            <li>Higher profits for farmers</li>
        </ul>
        <img src="{{ asset('frontend/img/about_us/refrigerated_trucks.webp') }}" class="img-fluid mb-40 rounded shadow">

        <h4>Smart Apps</h4>
        <ul class="ltn__list-item-1 mb-20">
            <li>Farmers book transport directly</li>
            <li>Check prices, delivery times</li>
            <li>Real-time truck tracking</li>
        </ul>
        <img src="{{ asset('frontend/img/about_us/smart_apps.webp') }}" class="img-fluid mb-40 rounded shadow">

    </div>
</section>

@endsection
