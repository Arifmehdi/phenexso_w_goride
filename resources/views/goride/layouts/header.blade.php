<!-- ── HEADER ── -->
<header>
    <div class="nav-container">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh"></a></div>
        <button class="mobile-menu-btn" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Fleet</a></li>
                <li><a href="#">Tours</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="nav-right">
            <a href="#" class="lang-toggle">বাংলা</a>
            @if(Auth::check())
                <a href="{{ route('user.dashboard') }}" class="login-btn">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="login-btn">Login</a>
            @endif
        </div>
    </div>
</header>
